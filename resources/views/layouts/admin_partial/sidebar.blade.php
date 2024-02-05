<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.dashboard') }}" class="brand-link">
        <img src="{{ asset('admin//dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        @if (Auth::guard('admin')->user()->role == 0)
            <span class="brand-text font-weight-light">Super Admin</span>
        @else
            <span class="brand-text font-weight-light">Admin dashboard</span>
        @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin//dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="{{ route('admin.dashboard') }}" class="d-block">{{ Auth::guard('admin')->user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <!-- Category start here -->
        <nav class="">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::guard('admin')->user()->role == 0)
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('customers.all') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Customers</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- expense category start here --}}
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Expense Category</p>
                        </a>
                    </li>
                    {{-- expense category ends here --}}
                @endif

                @if (Auth::guard('admin')->user()->role == 1)
                    {{-- Products start here --}}
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Users</p>
                        </a>
                    </li>
                    {{-- Products start here --}}
                    {{-- Roles & Parmission start here --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Roles & Parmission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('all.permission') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Parmission</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Roles & Parmission ends here --}}
                    {{-- Flat  start here --}}
                    <li class="nav-item">
                        <a href="{{ route('flat.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Manage flat</p>
                        </a>
                    </li>
                    {{-- flat ends here --}}
                    {{-- Expenses start here --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Expenses
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('expense-details.index') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense details</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('expenses.index') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('expenses.process') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Process & Generete data</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p> Expense log</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Expenses start here --}}

                    {{-- Income start here --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Incomes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('income.create') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('income.collection') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Collection </p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('income.collection') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Ending Balance </p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- Income start here --}}
                    {{-- Blance  start here --}}
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Balance<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('monthly.blance.index') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Balance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('yearly.blance.index') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Balance </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Blance ends here --}}
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
