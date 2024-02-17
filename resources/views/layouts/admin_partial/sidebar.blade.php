<aside class="main-sidebar sidebar-dark-primary elevation-4 p-0">
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
    <div class="sidebar mt-3">
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
        <nav class=" mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::guard('admin')->user()->role == 0)
                    <li
                        class="nav-item {{ Request::routeIs('customers.all') || Request::routeIs('customers.create') || Request::routeIs('customers.edit') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Customers
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('customers.all') }}"
                                    class="nav-link {{ Request::routeIs('customers.all') || Request::routeIs('customers.create') || Request::routeIs('customers.edit') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Customers</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- expense category start here --}}
                    <li class="nav-item">
                        <a href="{{ route('category.index') }}"
                            class="nav-link {{ Request::routeIs('category.index') || Request::routeIs('category.create') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Expense Category</p>
                        </a>
                    </li>
                    {{-- expense category ends here --}}
                @endif

                @if (Auth::guard('admin')->user()->role == 1)
                    {{-- Products start here --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('users.index') }}"
                            class="nav-link {{ Request::routeIs('users.index') || Request::routeIs('users.create') || Request::routeIs('users.edit') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Users</p>
                        </a>
                    </li> --}}



                    {{-- flat Management ends here --}}
                    <li
                        class="nav-item {{ Request::routeIs('flat.index') || Request::routeIs('flat.create') ? 'menu-open active' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Flat Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('flat.create') }}"
                                    class="nav-link {{ Request::routeIs('flat.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Create Flat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('flat.index') }}"
                                    class="nav-link {{ Request::routeIs('flat.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Flat</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- flat Management ends here --}}


                    {{-- User management start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('users.index') || Request::routeIs('users.create') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('users.index') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- User management ends here --}}

                    {{-- Flat  start here --}}
                    {{-- <li class="nav-item">
                        <a href="{{ route('flat.index') }}"
                        class="nav-link {{ Request::routeIs('flat.index') || Request::routeIs('flat.create') || Request::routeIs('flat.singlecreate') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-circle"></i>
                        <p>Manage flat</p>
                    </a>
                </li> --}}

                    {{-- Expense management ends here --}}
                    <li
                        class="nav-item {{ Request::routeIs('expense.create') || Request::routeIs('expense-summary.index') ? 'menu-open active' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Expense Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('expense.create') }}"
                                    class="nav-link {{ Request::routeIs('expense.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Entry</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('expense-summary.index') }}"
                                    class="nav-link {{ Request::routeIs('expense-summary.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Summary</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('expenses.process') }}"
                                    class="nav-link {{ Request::routeIs('expenses.process') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Process & Generete data</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- Expenses Management start here --}}

                    {{-- Income Management start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('income.create') || Request::routeIs('income.collection') || Request::routeIs('income.collection.index') || Request::routeIs('income.collection.all') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Income Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('income.create') }}"
                                    class="nav-link {{ Request::routeIs('income.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Generate Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('income.collection') }}"
                                    class="nav-link {{ Request::routeIs('income.collection') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Collection </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('income.collection.index')}}"
                                    class="nav-link ">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Collection Voucher</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Income Management start here --}}

                    {{-- Accounts  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('monthly.blance.index') || Request::routeIs('ledgerPosting.index') || Request::routeIs('account.expense.index') || Request::routeIs('yearly.blance.index') || Request::routeIs('opening.balance.create') || Request::routeIs('income.statement') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Accounts<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('opening.balance.create') }}"
                                    class="nav-link {{ Request::routeIs('opening.balance.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Opening Balance Entry</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ route('ledgerPosting.index') }}"
                                    class="nav-link {{ Request::routeIs('ledgerPosting.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Ledger Posting </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('account.expense.index')}}"
                                    class="nav-link {{ Request::routeIs('account.expense.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Voucher </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('income.statement')}}"
                                    class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Income Statement </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="}"
                                    class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Balance Sheet </p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="{{ route('monthly.blance.index') }}"
                                    class="nav-link {{ Request::routeIs('monthly.blance.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Balance</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('yearly.blance.index') }}"
                                    class="nav-link {{ Request::routeIs('yearly.blance.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Balance </p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- Accounts ends here --}}

                    {{-- Report  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('expenses.month') || Request::routeIs('expense-all.index') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Report<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('expenses.month') }}"
                                    class="nav-link {{ Request::routeIs('expenses.month') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=""
                                    class="nav-link ">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href=""
                                    class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Income</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Report ends here --}}

                    {{-- All Setup  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('flat.singlecreate') || Request::routeIs('user.create') || Request::routeIs('income.all') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Setup<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('flat.singlecreate') }}"
                                    class="nav-link {{ Request::routeIs('flat.singlecreate') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add More Flat</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add More User</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- All Setup ends here --}}

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
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
