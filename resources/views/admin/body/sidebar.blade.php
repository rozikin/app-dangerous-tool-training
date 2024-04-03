<!-- partial:partials/_sidebar.html -->
<nav class="sidebar">
    <div class="sidebar-header">
        <a href="#" class="sidebar-brand">
            E -<span> TIMW</span>
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

            {{-- <li class="nav-item nav-category">RealEstate</li>

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
            @endif --}}



            @if (Auth::user()->can('permission.menu'))
                <li class="nav-item nav-category">Role & Permission</li>
                <li class="nav-item {{ request()->is('*/permission') || request()->is('*/roles') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#uiComponents" role="button"
                        aria-expanded="false" aria-controls="uiComponents">
                        <i class="link-icon" data-feather="feather"></i>
                        <span class="link-title">Role & Permission</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>

                    </a>
                    <div class="{{ request()->is('edit/permission/*') || request()->is('all/permission') || request()->is('add/permission') || request()->is('add/roles/permission') || request()->is('all/roles/permission') || request()->is('*/roles') || request()->is('admin/edit/roles/*') || request()->is('edit/roles/*') ? 'show' : 'collapse' }}"
                        id="uiComponents">
                        <ul class="nav sub-menu">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}"
                                    class="nav-link {{ request()->is('all/permission') || request()->is('edit/permission/*') ? 'active' : '' }}">All
                                    Permission</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('all.roles') }}"
                                    class="nav-link {{ request()->is('*/roles') || request()->is('edit/roles/*') ? 'active' : '' }}">All
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
                                    class="nav-link {{ request()->is('*/admin') || 'edit/admin/*' ? 'active' : '' }}">All
                                    Admin</a>
                            </li>

                        </ul>
                    </div>
                </li>
            @endif


            <li class="nav-item nav-category">Master</li>

           

            @if (Auth::user()->can('color.menu'))
                <li class="nav-item {{ request()->is('*/color') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emailsy" role="button" aria-expanded="false"
                        aria-controls="emailsy">
                        <i class="link-icon" data-feather="layers"></i>
                        <span class="link-title">Color</span>
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

            @if (Auth::user()->can('category.menu'))
                <li class="nav-item {{ request()->is('*/category') ? 'active' : '' }}">
                    <a class="nav-link" data-bs-toggle="collapse" href="#emailsz" role="button"
                        aria-expanded="false" aria-controls="emailsz">
                        <i class="link-icon" data-feather="database"></i>
                        <span class="link-title">Category</span>
                        <i class="link-arrow" data-feather="chevron-down"></i>
                    </a>
                    <div class="{{ request()->is('*/category') || request()->is('*/category/*') || request()->is('*/category') ? 'show' : 'collapse' }}"
                        id="emailsz">
                        <ul class="nav sub-menu">


                            @if (Auth::user()->can('all.category'))
                                <li class="nav-item">
                                    <a href="{{ route('all.category') }}"
                                        class="nav-link {{ request()->is('all/category') || request()->is('edit/category/*') ? 'active' : '' }}">All
                                        Category</a>
                                </li>
                            @endif

                        </ul>
                    </div>
                </li>
            @endif

            @if (Auth::user()->can('product.menu'))
            <li class="nav-item {{ request()->is('*/product') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsx" role="button" aria-expanded="false"
                    aria-controls="emailsx">
                    <i class="link-icon" data-feather="server"></i>
                    <span class="link-title">Product</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/product') || request()->is('*/product_allocation') || request()->is('*/product/*') || request()->is('*/product_allocation/*') ? 'show' : 'collapse' }}"
                    id="emailsx">
                    <ul class="nav sub-menu">
                        @if (Auth::user()->can('all.product'))
                            <li class="nav-item">
                                <a href="{{ route('all.product') }}"
                                    class="nav-link {{ request()->is('all/product') || request()->is('add/product') || request()->is('edit/product/*') ? 'active' : '' }}">Product</a>
                            </li>
                        @endif

                        @if (Auth::user()->can('all.product_allocation'))
                            <li class="nav-item">
                                <a href="{{ route('all.product_allocation') }}"
                                    class="nav-link {{ request()->is('all/product_allocation') || request()->is('edit/product_allocation/*') ? 'active' : '' }}">Product
                                    Allocation</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif

        
        @if (Auth::user()->can('supplier.menu'))
        <li class="nav-item {{ request()->is('*/supplier') ? 'active' : '' }}">
            <a class="nav-link" data-bs-toggle="collapse" href="#emailsxs" role="button" aria-expanded="false"
                aria-controls="emailsxs">
                <i class="link-icon" data-feather="server"></i>
                <span class="link-title">Supplier</span>
                <i class="link-arrow" data-feather="chevron-down"></i>
            </a>
            <div class="{{ request()->is('*/supplier') || request()->is('*/supplier/*') ? 'show' : 'collapse' }}"
                id="emailsxs">
                <ul class="nav sub-menu">
                    @if (Auth::user()->can('all.supplier'))
                        <li class="nav-item">
                            <a href="{{ route('all.supplier') }}"
                                class="nav-link {{ request()->is('all/supplier') || request()->is('add/supplier') || request()->is('edit/product/*') ? 'active' : '' }}">All Supplier</a>
                        </li>
                    @endif
                </ul>
            </div>
        </li>
    @endif

            <li class="nav-item nav-category">Transaction</li>
            {{-- @if (Auth::user()->can('Transaction.menu')) --}}
            <li class="nav-item {{ request()->is('*/productin') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsyin" role="button" aria-expanded="false"
                    aria-controls="emailsyin">
                    <i class="link-icon" data-feather="corner-right-down"></i>
                    <span class="link-title">IN</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/productin') || request()->is('*/productin/*') || request()->is('*/productin') ? 'show' : 'collapse' }}"
                    id="emailsyin">
                    <ul class="nav sub-menu">


                        @if (Auth::user()->can('all.productin'))
                            <li class="nav-item">
                                <a href="{{route('all.productin')}}"
                                    class="nav-link {{ request()->is('*/productin') || request()->is('*/productin/*') || request()->is('*/productin') ? 'active' : '' }}">All
                                    Product In</a>
                            </li>
                        @endif

                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->is('*/Transaction') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsyout" role="button" aria-expanded="false"
                    aria-controls="emailsyout">
                    <i class="link-icon" data-feather="corner-right-up"></i>
                    <span class="link-title">OUT</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/Transaction') || request()->is('*/Transaction/*') || request()->is('*/Transaction') ? 'show' : 'collapse' }}"
                    id="emailsyout">
                    <ul class="nav sub-menu">


                        {{-- @if (Auth::user()->can('all.Transaction')) --}}
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->is('all/Transaction') || request()->is('edit/Transaction/*') ? 'active' : '' }}">All
                                    Transaction</a>
                            </li>
                        {{-- @endif --}}

                    </ul>
                </div>
            </li>
            <li class="nav-item {{ request()->is('*/Transaction') ? 'active' : '' }}">
                <a class="nav-link" data-bs-toggle="collapse" href="#emailsyr" role="button" aria-expanded="false"
                    aria-controls="emailsyr">
                    <i class="link-icon" data-feather="corner-up-left"></i>
                    <span class="link-title">Return</span>
                    <i class="link-arrow" data-feather="chevron-down"></i>
                </a>
                <div class="{{ request()->is('*/Transaction') || request()->is('*/Transaction/*') || request()->is('*/Transaction') ? 'show' : 'collapse' }}"
                    id="emailsyr">
                    <ul class="nav sub-menu">


                        {{-- @if (Auth::user()->can('all.Transaction')) --}}
                            <li class="nav-item">
                                <a href="#"
                                    class="nav-link {{ request()->is('all/Transaction') || request()->is('edit/Transaction/*') ? 'active' : '' }}">All
                                    Transaction</a>
                            </li>
                        {{-- @endif --}}

                    </ul>
                </div>
            </li>
        {{-- @endif --}}





        </ul>
    </div>
</nav>
