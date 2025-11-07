  <!-- Demo config -->
	<div class="offcanvas offcanvas-end" tabindex="-1" id="demo_config">
		<div class="position-absolute top-50 end-100 visible">
			<button type="button" class="btn btn-primary btn-icon translate-middle-y rounded-end-0" data-bs-toggle="offcanvas" data-bs-target="#demo_config">
				<i class="ph-gear"></i>
			</button>
		</div>

		<div class="offcanvas-header border-bottom py-0">
			<h5 class="offcanvas-title py-3">Change Color Mode</h5>
			<button type="button" class="btn btn-light btn-sm btn-icon border-transparent rounded-pill" data-bs-dismiss="offcanvas">
				<i class="ph-x"></i>
			</button>
		</div>

		<div class="offcanvas-body">
			<div class="fw-semibold mb-2">Color mode</div>
			<div class="list-group mb-3">
				<label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
					<div class="d-flex flex-fill my-1">
						<div class="form-check-label d-flex me-2">
							<i class="ph-sun ph-lg me-3"></i>
							<div>
								<span class="fw-bold">Light theme</span>
								<div class="fs-sm text-muted">Set light theme or reset to default</div>
							</div>
						</div>
						<input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="light" checked>
					</div>
				</label>

				<label class="list-group-item list-group-item-action form-check border-width-1 rounded mb-2">
					<div class="d-flex flex-fill my-1">
						<div class="form-check-label d-flex me-2">
							<i class="ph-moon ph-lg me-3"></i>
							<div>
								<span class="fw-bold">Dark theme</span>
								<div class="fs-sm text-muted">Switch to dark theme</div>
							</div>
						</div>
						<input type="radio" class="form-check-input cursor-pointer ms-auto" name="main-theme" value="dark">
					</div>
				</label>


			</div>



		</div>


	</div>
	<!-- /demo config -->
  <div class="navbar navbar-sm navbar-footer border-top">
      <div class="container-fluid">
          <span>&copy; <script>document.write(/\d{4}/.exec(Date())[0])</script> <a
                  href="#">Hetu Patel</a></span>

          <ul class="nav">
              <li class="nav-item">
                  <a href="" class="navbar-nav-link navbar-nav-link-icon rounded"
                      target="_blank">
                      <div class="d-flex align-items-center mx-md-1">
                          <i class="ph-lifebuoy"></i>
                          <span class="d-none d-md-inline-block ms-2">Support</span>
                      </div>
                  </a>
              </li>
          </ul>
      </div>
  </div>

   <script>

 	$(document).ready(function() {
        $.fn.dataTable.ext.errMode = 'none';
    });

    @if (Session::has('success'))
                toastr_message('success', '{{ Session::get('success') }}');
            @elseif (Session::has('info'))
                toastr_message('info', '{{ Session::get('info') }}');
            @elseif (Session::has('danger'))
                toastr_message('danger', '{{ Session::get('danger') }}');
            @elseif (Session::has('warning'))
                toastr_message('warning', '{{ Session::get('warning') }}');
    @endif
  </script>
  <!-- /footer -->

  <!-- /page content -->
