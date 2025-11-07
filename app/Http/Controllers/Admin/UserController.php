<?php

namespace App\Http\Controllers\Admin;

use Form;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\UserCustomDetail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    private $data = array(
        'route' => 'admin.user.',
        'title' => 'User',
        'menu' => 'user',
        'submenu' => '',
    );
    public function __construct()
    {
        // $this->middleware('auth');
    }
    private function _validate($request, $id = null)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required',
        ]);
    }

    public function index(Request $request)
    {

        if ($request->ajax()) {
            $records = User::select('*');

            if (!empty($request->gender)) {
                $records->where('gender', $request->gender);
            }
            if ($request->filled('custom_search')) {
                $search = $request->custom_search;
                $records->whereHas('customDetail', function ($q) use ($search) {
                    $q->where('custom_detail', 'like', "%{$search}%");
                });
            }


            return DataTables::of($records)
                ->editColumn('created_at', function ($record) {
                    return $record->created_at->format(config('setting.DATE_FORMAT'));
                })
                ->addColumn('status', function ($record) {
                    $class = $record->status == "Active" ? "border-success badge-flat text-success" : "border-danger  text-danger";
                    return Form::select('status', ['Active' => 'Active', 'Inactive' => 'Inactive'], $record->status, ['data-id' => $record->id, 'class' => "custom-select chk_status p-1  min-width-150 $class"]);
                })
                ->addColumn('action', function ($record) {
                    return '<td class="text-center">
                        <div class="d-inline-flex">
							<div class="dropdown">
								<a href="#" class="text-body" data-bs-toggle="dropdown">
									<i class="ph-list"></i>
								</a>
							<div class="dropdown-menu dropdown-menu-end">
								<a href="javascript:void(0)" class="dropdown-item text-success editRecord" data-id="' . $record->id . '"><i class="ph-pencil-line me-2"></i>Edit</a>
								<button  class="dropdown-item text-danger data-delete" data-id="' . $record->id . '">
									<i class="ph-trash me-2 " ></i>
									Delete
								</button>
							</div>
							</div>
						</div>
					</td>';
                })
                ->rawColumns(['status', 'action'])
                ->make(true);
        }
        return view('admin.user.index', $this->data);
    }

    public function create()
    {
        return view('admin.user.create', $this->data);
    }

    public function store(Request $request)
    {

        $this->_validate($request);
        $request['status'] = 'Active';
        $record = new User($request->all());
        $record['image'] = $this->uploadFile($request, null, 'image', 'user_image', true);
        $record['profile_image'] = $this->uploadFile($request, null, 'profile_image', 'profile_image', true);
        $record->save();

        $customData = [];

        if ($request->has('custom_label')) {
            foreach ($request->custom_label as $index => $label) {
                if (!empty($label) || !empty($request->custom_value[$index])) {
                    $customData[] = [
                        'label' => $label,
                        'value' => $request->custom_value[$index] ?? null,
                    ];
                }
            }
        }
        //save custom details
        if (!empty($customData)) {
            UserCustomDetail::create([
                'user_id' => $record->id,
                'custom_detail' => json_encode($customData),
            ]);
        }

        Session::flash('success', $this->data['title'] . ' inserted successfully.');
        return redirect()->route($this->data['route'] . 'index');
    }

    public function show($id)
    {
        $this->data['record'] = User::findOrFail($id);
        return view('admin.user.show', $this->data);
    }

    public function edit($id)
    {
        $this->data['record'] = User::with('customDetail')->findOrFail($id);

        $customFields = [];
        if ($this->data['record']->customDetail && !empty($this->data['record']->customDetail->custom_detail)) {
            $customFields = json_decode($this->data['record']->customDetail->custom_detail, true);
        }

        //decode code
        $this->data['customFields'] = $customFields;
        return view('admin.user.create', $this->data);
    }

    public function update(Request $request, $id)
    {
        $record = User::findOrFail($id);
        if ($request->ajax()) {
            $inputs = $request->all();
            $inputs['image'] = $this->uploadFile($request, $record, 'image', 'user_image');
            if (empty($inputs['image'])) {
                unset($inputs['image']);
            }
            $inputs['profile_image'] = $this->uploadFile($request, $record, 'profile_image', 'profile_image');
            if (empty($inputs['profile_image'])) {
                unset($inputs['profile_image']);
            }
            // return $inputs;
            $record->update($inputs);

            // Handle custom fields JSON
            if ($request->has('custom_label') && $request->has('custom_value')) {
                $customData = [];
                foreach ($request->custom_label as $index => $label) {
                    if (!empty($label) || !empty($request->custom_value[$index])) {
                        $customData[] = [
                            'label' => $label,
                            'value' => $request->custom_value[$index] ?? '',
                        ];
                    }
                }
                // return $customData;
                UserCustomDetail::updateOrCreate(
                    ['user_id' => $record->id],
                    ['custom_detail' => json_encode($customData)]
                );
            }

            return \Illuminate\Support\Facades\Response::json(['message' => 'Status changed Successfully']);
        }
        return redirect()->route($this->data['route'] . 'index');
    }


    public function merge(Request $request)
    {
        $masterId = $request->masterId;
        $userIds = $request->userIds;

        $master = User::find($masterId);
        if (!$master) {
            return response()->json(['message' => 'Master user not found!'], 404);
        }

        // Get master custom_detail or initialize empty array
        $masterCustomDetail = UserCustomDetail::firstOrCreate(['user_id' => $masterId]);
        $customData = json_decode($masterCustomDetail->custom_detail ?? '[]', true);

        foreach ($userIds as $id) {
            if ($id == $masterId) continue;

            $user = User::find($id);
            if (!$user) continue;

            // Add user basic info in label/value format
            $customData[] = ['label' => 'email', 'value' => $user->email];
            $customData[] = ['label' => 'contact', 'value' => $user->contact];

            // Merge user's existing custom_detail if exists
            $userCustomDetail = UserCustomDetail::where('user_id', $id)->first();
            if (!empty($userCustomDetail->custom_detail)) {
                $userDataArray = json_decode($userCustomDetail->custom_detail, true);
                if (is_array($userDataArray)) {
                    $customData = array_merge($customData, $userDataArray);
                }
            }

            // Delete the user
            $user->delete();
        }

        // Save merged data back
        $masterCustomDetail->custom_detail = json_encode($customData);
        $masterCustomDetail->save();


        return response()->json([
            'message' => 'Selected users merged into master successfully!',
            'masterId' => $masterId,
            'mergedUsers' => $userIds
        ]);
    }


    public function destroy($id)
    {
        $record = User::findOrFail($id);
        $record->delete();
        return \Illuminate\Support\Facades\Response::json(['result' => 'success', 'message' => 'Deleted Data successfully!']);
    }
}
