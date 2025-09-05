    <aside class="sidebar-wrapper" data-simplebar="true">
        <div class="sidebar-header">
            {{-- <div class="logo-icon">
                <img src="assets/images/logo-icon.png" class="logo-img" alt="">
            </div> --}}
            <div class="logo-name flex-grow-1">
                <h5 class="mb-0">Admin Dashboard</h5>
            </div>
            <div class="sidebar-close">
                <span class="material-icons-outlined">close</span>
            </div>
        </div>
        <div class="sidebar-nav">
            <!--navigation-->
            <ul class="metismenu" id="sidenav">
                <li>
                    <a href="{{ route('admin-dashboard') }}">
                        <div class="parent-icon"><i class="material-icons-outlined">home</i>
                        </div>
                        <div class="menu-title">Dashboard</div>
                    </a>

                </li>
                <li class="menu-label">Team Members</li>
                <li>
                    <a href="javascript:;" class="has-arrow">
                        <div class="parent-icon"><i class="material-icons-outlined">person</i>
                        </div>
                        <div class="menu-title">Team</div>
                    </a>
                    <ul>
                        <li><a href="{{ route('admin-add') }}"><i class="material-icons-outlined">arrow_right</i>Add Team</a>
                        </li>
                        <li><a href="widgets-static.html"><i class="material-icons-outlined">arrow_right</i>All Team</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!--end navigation-->


        </div>
    </aside>
