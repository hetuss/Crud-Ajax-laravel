<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{

    private $data = array(
        'route' => 'admin.home.',
        'title' => 'Dashboard',
        'menu' => 'dashboard',
        'submenu' => '',
    );

    public function dashboard()
    {
        return view('admin.dashboard.dashboard', $this->data);
    }

    
  
}