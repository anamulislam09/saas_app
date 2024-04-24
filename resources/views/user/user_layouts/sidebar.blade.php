<aside class="main-sidebar sidebar-dark-primary elevation-4 p-0">
    <!-- Brand Logo -->
    <a href="{{ route('user.Profile') }}" class="brand-link">
        <img src="{{ asset('admin//dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        @if (Auth::user()->role_id == 0)
            <span class="brand-text font-weight-light"> User Dashboard</span>
        @else
            <span class="brand-text font-weight-light">Manager dashboard</span>
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
                <a href="{{ route('user.Profile') }}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>
        <!-- Sidebar Menu -->
        <!-- Category start here -->
        <nav class=" mb-5">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                @if (Auth::user()->role_id == 0)
                    <li
                        class="nav-item {{ Request::routeIs('singleUser.paid') || Request::routeIs('singleUser.due') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Transactions
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('singleUser.paid') }}"
                                    class="nav-link {{ Request::routeIs('singleUser.paid') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Total Paid</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('singleUser.due') }}"
                                    class="nav-link {{ Request::routeIs('singleUser.due') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Total Due</p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    {{-- expense category start here --}}
                    <li class="nav-item">
                        <a href="{{ route('user.password.reset') }}"
                            class="nav-link {{ Request::routeIs('user.password.reset') || Request::routeIs('user.password.reset.store') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Reset Password</p>
                        </a>
                    </li>
                    {{-- expense category ends here --}}
                @endif

                @if (Auth::user()->role_id == 1)
                    {{-- flat Management ends here --}}
                    <li class="nav-item {{ Request::routeIs('manager.flat.index') ? 'menu-open active' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Flat Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('manager.flat.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.flat.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Flat</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- flat Management ends here --}}

                    {{-- User management start here --}}
                    <li class="nav-item {{ Request::routeIs('manager.users.index') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                User Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            {{-- <li class="nav-item">
                                <a href="{{ route('users.create') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Create User</p>
                                </a>
                            </li> --}}
                            <li class="nav-item">
                                <a href="{{ route('manager.users.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.users.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Users</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- User management ends here --}}

                    {{-- Expense management ends here --}}
                    <li
                        class="nav-item {{ Request::routeIs('manager.expense.create') || Request::routeIs('manager.expense-summary.index') || Request::routeIs('expense.voucher.create') || Request::routeIs('manager.expense.voucher.create') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Expense Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('manager.expense.create') }}"
                                    class="nav-link {{ Request::routeIs('manager.expense.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Entry</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.expense-summary.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.expense-summary.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Summary</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Expenses Management start here --}}

                    {{-- Income Management start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('manager.income.create') || Request::routeIs('manager.income.collection') || Request::routeIs('manager.income.collection.index') || Request::routeIs('others.income.create') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Income Management
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('manager.income.create') }}"
                                    class="nav-link {{ Request::routeIs('manager.income.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Generate Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.income.collection') }}"
                                    class="nav-link {{ Request::routeIs('manager.income.collection') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Collection </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.income.collection.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.income.collection.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Collection Voucher</p>
                                </a>
                            </li>

                            {{-- <li class="nav-item">
                                <a href="{{route('others.income.create')}}"
                                    class="nav-link {{ Request::routeIs('others.income.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Others Income</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- Income Management start here --}}

                    {{-- Accounts  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('manager.account.expense.all') || Request::routeIs('manager.ledgerPosting.index') || Request::routeIs('manager.account.expense.index') || Request::routeIs('manager.account.balancesheet') || Request::routeIs('manager.opening.balance.create') || Request::routeIs('manager.income.statement') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Accounts<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            {{-- <li class="nav-item">
                                <a href="{{ route('opening.balance.create') }}"
                                    class="nav-link {{ Request::routeIs('opening.balance.create') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Opening Balance Entry</p>
                                </a>
                            </li> --}}

                            <li class="nav-item">
                                <a href="{{ route('manager.ledgerPosting.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.ledgerPosting.index') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Ledger Posting </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.account.expense.index') }}"
                                    class="nav-link {{ Request::routeIs('manager.account.expense.index') || Request::routeIs('manager.account.expense.all') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Expense Voucher </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.income.statement') }}"
                                    class="nav-link {{ Request::routeIs('manager.income.statement') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Income Statement </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.account.balancesheet') }}"
                                    class="nav-link {{ Request::routeIs('manager.account.balancesheet') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Balance Sheet </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Accounts ends here --}}

                    {{-- Report  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('manager.expenses.month') || Request::routeIs('manager.expenses.year') || Request::routeIs('manager.incomes.month') || Request::routeIs('manager.incomes.year') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Report<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('manager.expenses.month') }}"
                                    class="nav-link {{ Request::routeIs('manager.expenses.month') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.expenses.year') }}"
                                    class="nav-link {{ Request::routeIs('manager.expenses.year') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Expense</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.incomes.month') }}"
                                    class="nav-link {{ Request::routeIs('manager.incomes.month') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Monthly Income</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('manager.incomes.year') }}"
                                    class="nav-link {{ Request::routeIs('manager.incomes.year') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Yearly Income</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    {{-- Report ends here --}}

                    {{-- All Setup  start here --}}
                    <li
                        class="nav-item {{ Request::routeIs('manager.flat.singlecreate') || Request::routeIs('manager.user.create') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>Setup<i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="{{ route('manager.flat.singlecreate') }}"
                                    class="nav-link {{ Request::routeIs('manager.flat.singlecreate') ? 'active' : '' }}">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add More Flat</p>
                                </a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="{{ route('user.create') }}" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>Add More User</p>
                                </a>
                            </li> --}}
                        </ul>
                    </li>
                    {{-- All Setup ends here --}}

                    {{-- Roles & Parmission start here --}}
                    {{-- <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-circle"></i>
                            <p>
                                Roles & Permission
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview ml-3">
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-dot-circle nav-icon"></i>
                                    <p>All Permission</p>
                                </a>
                            </li>
                        </ul>
                    </li> --}}
                    {{-- Roles & Parmission ends here --}}
                @endif
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
