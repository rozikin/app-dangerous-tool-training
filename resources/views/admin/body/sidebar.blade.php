<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            Invent<span> TIMW</span>
        </a>
        <div class="sidebar-toggler not-active">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
    <div class="sidebar-body">
        <ul class="nav">
            <li class="nav-item nav-category">Main</li>
            <li class="nav-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}" class="nav-link">
                    <i class="link-icon" data-feather="box"></i>
                    <span class="link-title">Dashboard</span>
                </a>
            </li>

            <li class="nav-item nav-category">RealEstate</li>

            @if (Auth::user()->can('type.menu'))
            <li class="nav-item {{ request()->is('*/type') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsw" role="button" aria-expanded="false"
                    aria-controls="emailsx">
                    <i class="link-icon" data-feather="mail"></i>
                    <span class="link-title">Property Type</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/type') || request()->is('*/type/*') ? 'show' : 'collapse' }}"
                    id="emailsw">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.type'))
                        <li class="nav-item">
                            <a href="{{ route('all.type') }}"
                                class="nav-link {{ request()->is('all/type')? 'active' : '' }}">All
                                Type</a>
                        </li>
                        @endif
                        @if (Auth::user()->can('add.type'))
                        <li class="nav-item">
                            <a href="{{ route('add.type') }}"
                                class="nav-link {{ request()->is('add/type') ? 'active' : '' }}">Add Type</a>
                        </li>
                        @endif

                    </ul>
                </div>
            </li>
            @endif



            @if (Auth::user()->can('permission.menu'))
            <li class="nav-item nav-category">Role & Permission</li>
            <li class="nav-item {{ request()->is('*/permission') || request()->is('*/roles') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button" aria-expanded="false"
                    aria-controls="uiComponents">
                    <i class="link-icon" data-feather="feather"></i>
                    <span class="link-title">Role & Permission</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>

                </a>
                <div class="{{ request()->is('edit/permission/*') || request()->is('all/permission') || request()->is('add/permission') || request()->is('add/roles/permission') || request()->is('all/roles/permission')|| request()->is('*/roles') || request()->is('admin/edit/roles/*') || request()->is('edit/roles/*') ? 'show' : 'collapse' }}"
                    id="uiComponents">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.permission') }}"
                                class="nav-link {{ request()->is('all/permission') || request()->is('edit/permission/*')  ? 'active' : '' }}">All
                                Permission</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles') }}"
                                class="nav-link {{ request()->is('*/roles') || request()->is('edit/roles/*')  ? 'active' : '' }}">All
                                Roles</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('add.roles.permission') }}"
                                class="nav-link {{ request()->is('add/roles/permission') ? 'active' : '' }}">Add
                                Role in Permission</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('all.roles.permission') }}"
                                class="nav-link {{ request()->is('all/roles/permission') || request()->is('admin/edit/roles/*') ? 'active' : '' }}">All
                                Role in Permission</a>
                        </li>

                    </ul>
                </div>
            </li>
            @endif

            @if (Auth::user()->can('admin.menu'))
            <li class="nav-item {{ request()->is('admin') ? 'active' : '' }}">

                <a class="nav-link" data-bs-toggle="collapse" href="#forms" role="button" aria-expanded="false"
                    aria-controls="forms">
                    <i class="link-icon" data-feather="inbox"></i>
                    <span class="link-title">Manage Admin</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>

                <div class="{{ request()->is('*/admin') | request()->is('*/admin/*') ? 'show' : 'collapse' }}"
                    id="forms">
                    <ul class="nav sub-menu">
                        <li class="nav-item">
                            <a href="{{ route('all.admin') }}"
                                class="nav-link {{ request()->is('*/admin') || ('edit/admin/*') ? 'active' : '' }}">All
                                Admin</a>
                        </li>

                    </ul>
                </div>
            </li>
            @endif


            <li class="nav-item nav-category">Master</li>

            @if (Auth::user()->can('product.menu'))
            <li class="nav-item {{ request()->is('*/product') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsx" role="button" aria-expanded="false"
                    aria-controls="emailsx">
                    <i class="link-icon" data-feather="server"></i>
                    <span class="link-title">Product</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/product') || request()->is('*/product/*') ? 'show' : 'collapse' }}"
                    id="emailsx">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.product'))
                        <li class="nav-item">
                            <a href="{{ route('all.product') }}"
                                class="nav-link {{ request()->is('all/product') || request()->is('edit/product/*') ? 'active' : '' }}">All
                                product</a>
                        </li>
                
                        @endif
                    </ul>
                </div>
            </li>
            @endif

            @if (Auth::user()->can('color.menu'))
            <li class="nav-item {{ request()->is('*/color') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsy" role="button" aria-expanded="false"
                    aria-controls="emailsx">
                    <i class="link-icon" data-feather="cloud"></i>
                    <span class="link-title">color</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/color') || request()->is('*/color/*') || request()->is('*/color') ? 'show' : 'collapse' }}"
                    id="emailsy">
                    <ul class="nav sub-menu">
            

                        @if (Auth::user()->can('all.color'))
                        <li class="nav-item">
                            <a href="{{ route('all.color') }}"
                                class="nav-link {{ request()->is('all/color') || request()->is('edit/color/*') ? 'active' : '' }}">All
                                Color</a>
                        </li>

                        @endif

                    </ul>
                </div>
            </li>
            @endif




        </ul>
    </div>
</nav>