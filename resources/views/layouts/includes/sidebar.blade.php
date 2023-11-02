<div id="sidebar" class="app-sidebar">
    <!-- BEGIN scrollbar -->
    <div class="app-sidebar-content" data-scrollbar="true" data-height="100%">
        <!-- BEGIN menu -->
        <div class="menu">
            <div class="menu-search mb-n3">
                <input type="text" class="form-control" placeholder="Sidebar menu filter..." data-sidebar-search="true">
              </div>
            <div class="menu-header">Navigation</div>
            <div class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{route('dashboard')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fab fa-simplybuilt"></i>
                    </div>
                    <div class="menu-text">dashboard </div>
                </a>
            </div>
            <div class="menu-item {{ request()->routeIs('contact.index') ? 'active' : '' }}">
                <a href="{{route('contact.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="menu-text">Get In Touch</div>
                </a>
            </div>
            {{-- @if(Auth::user()->is_admin == '1')
            <div class="menu-item {{ request()->routeIs('user.index') ? 'active' : '' }}">
                <a href="{{route('user.index')}}" class="menu-link">
                    <div class="menu-icon">
                        <i class="fa fa-calendar"></i>
                    </div>
                    <div class="menu-text">Add User</div>
                </a>
            </div>
            @endif --}}

        </div>
        <!-- BEGIN minify-button -->
        <div class="menu-item d-flex">
            <a href="javascript:;" class="app-sidebar-minify-btn ms-auto" data-toggle="app-sidebar-minify"><i
                    class="fa fa-angle-double-left"></i></a>
        </div>
        <!-- END minify-button -->
    </div>
    <!-- END scrollbar -->
</div>
<div class="app-sidebar-bg"></div>
<div class="app-sidebar-mobile-backdrop"><a href="#" data-dismiss="app-sidebar-mobile" class="stretched-link"></a>
</div>
