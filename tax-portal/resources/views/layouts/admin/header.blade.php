 <!--begin::Header-->
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
           
 
            
           
            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <span class="d-none d-md-inline">{{ auth()->user()->name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <!--begin::User Image-->
                <li class="user-header text-bg-primary">
                  <img
                    src="../assets/img/user2-160x160.jpg"
                    class="rounded-circle shadow"
                    alt="User Image"
                  />
                  <p>
                    {{ auth()->user()->name }}
                    <small>{{ auth()->user()->email }}</small>
                  </p>
                </li>
                <!--end::User Image-->
                
                <!--begin::Menu Footer-->
                <li class="user-footer">
                  <a href="/profile" class="btn btn-default btn-flat">Profile</a>
                  <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                    @csrf
                    <button type="submit" class="btn btn-default btn-flat float-end" style="border: none; background: none; cursor: pointer;">Sign out</button>
                  </form>
                </li>
                <!--end::Menu Footer-->
              </ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>
      <!--end::Header-->