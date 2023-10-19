<div class="main-wrapper">
    <div class="header">
        <div class="header-left">
            <a href="index-2.html" class="logo">
                <img src="{{ asset('assets/img/logo.png') }}" alt="Logo">
            </a>
            <a href="index-2.html" class="logo logo-small">
                <img src="{{ asset('assets/img/logo-small.png') }}" alt="Logo" width="30" height="30">
            </a>
        </div>

        <div class="menu-toggle">
            <a href="javascript:void(0);" id="toggle_btn">
                <i class="fas fa-bars"></i>
            </a>
        </div>

        <ul class="nav user-menu">
            <li class="nav-item zoom-screen me-2">
                <a href="#" class="nav-link header-nav-list win-maximize">
                    <img src="{{ asset('assets/img/icons/header-icon-04.svg') }}" alt>
                </a>
            </li>

            <li class="nav-item dropdown has-arrow new-user-menus">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <span class="user-img">
                        <img class="rounded-circle" src="{{ asset('uploads/' . Auth::user()->avatar) }}" width="31"
                            alt="Ryan Taylor">
                        <div class="user-text">
                            <h6>{{ Auth::user()->name }}</h6>
                            @foreach (Auth::user()->roles as $role)
                                <p class="text-muted mb-0">{{ $role->name }}</p>
                            @endforeach
                        </div>
                    </span>
                </a>
                <div class="dropdown-menu">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img src="{{ asset('uploads/' . Auth::user()->avatar) }}" alt="User Image"
                                class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                            <h6>{{ Auth::user()->name }}</h6>
                            @foreach (Auth::user()->roles as $role)
                                <p class="text-muted mb-0">{{ $role->name }}</p>
                            @endforeach
                        </div>
                    </div>
                    <a class="dropdown-item" href="profile.html">My Profile</a>
                    <a class="dropdown-item"href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </li>
        </ul>
    </div>

    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>
                    @hasrole('Admin')
                        <li class="submenu {{ Request::is('admin*') || Request::is('teacher*') || Request::is('student*') ? 'active' : '' }}">
                            <a href="#" class="{{ Request::is('admin*') || Request::is('teacher*') || Request::is('student*') ? 'active' : '' }}"><i class="feather-grid"></i> <span> Dashboard</span><span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li class="{{ Request::is('admin*') ? 'active' : '' }}">
                                    <a href="{{ route('admin.index') }}">Admin Dashboard</a>
                                </li>
                                <li class="{{ Request::is('teacher*') ? 'active' : '' }}">
                                    <a href="{{ route('teacher.index') }}">Teacher Dashboard</a>
                                </li>
                                <li class="{{ Request::is('student*') ? 'active' : '' }}">
                                    <a href="{{ route('student.index') }}">Student Dashboard</a>
                                </li>
                            </ul>
                        </li>
                    @endhasrole
                    <li class="submenu {{ Request::is('add-student*') ? 'active' : '' }}">
                        <a href="#" class="{{ Request::is('add-student*') ? 'active' : '' }}"><i
                                class="fas fa-graduation-cap"></i> <span> Students</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::is('add-student') ? 'active' : '' }}"><a
                                    href="{{ route('add-student.index') }}">Student List</a></li>
                            <li class="{{ Request::is('add-student/create') ? 'active' : '' }}"><a
                                    href="{{ route('add-student.create') }}">Student Add</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="teachers.html">Teacher List</a></li>
                            <li><a href="teacher-details.html">Teacher View</a></li>
                            <li><a href="add-teacher.html">Teacher Add</a></li>
                        </ul>
                    </li>
                    <li class="submenu {{ Request::is('add-class*') ? 'active' : '' }}">
                        <a href="#" class="{{ Request::is('add-class*') ? 'active' : '' }}"><i
                                class="fas fa-building"></i> <span> Classes</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::is('add-class') ? 'active' : '' }}"><a
                                    href="{{ route('add-class.index') }}">Class List</a></li>
                            <li class="{{ Request::is('add-class/create*') ? 'active' : '' }}"><a
                                    href="{{ route('add-class.create') }}">Class Add</a></li>
                        </ul>
                    </li>
                    <li class="submenu">
                        <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="subjects.html">Subject List</a></li>
                            <li><a href="add-subject.html">Subject Add</a></li>
                        </ul>
                    </li>
                    <li class="menu-title">
                        <span>Management</span>
                    </li>
                    <li>
                        <a href="event.html"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                    </li>
                    <li>
                        <a href="holiday.html"><i class="fas fa-holly-berry"></i> <span>Holiday</span></a>
                    </li>
                    <li>
                        <a href="time-table.html"><i class="fas fa-table"></i> <span>Time Table</span></a>
                    </li>
                    <li>
                        <a href="settings.html"><i class="fas fa-cog"></i> <span>Settings</span></a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

