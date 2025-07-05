@props(['role'])

<nav class="sidebar close"> 
    <header> 
        <div class="image-text"> 
            <span class="image"> 
                <svg width="40" height="30" viewBox="0 0 50 40" fill="none" xmlns="http://www.w3.org/2000/svg"> 
                    <path d="M43 31L31 40H5L7 35L12 31H29L32 35L40 11L45 7H50L43 31ZM43 5L38 9H21L18 5L10 29L5 33H0L7 9L19 0H45L43 5ZM24 13H35L29 31L26 27H15L21 9L24 13Z" fill="#297AFF"></path> 
                </svg>
            </span> 

            <div class="text logo-text"> 
                <span class="name">School MS</span> 
                <span class="profession">{{ ucfirst($role) }}</span> 
            </div> 
        </div> 

        <i class='bx bx-chevron-right toggle'></i> 
    </header> 

    <div class="menu-bar"> 
        <div class="menu"> 
           

            <ul class="menu-links"> 
                <li class="nav-link"> 
                    <a href="{{ route('dashboard') }}"> 
                        <i class='bx bx-home-alt icon'></i> 
                        <span class="text nav-text">Dashboard</span> 
                    </a> 
                </li> 

                @if($role === 'admin')
                    <li class="nav-link"> 
                        <a href="{{ route('admin.teachers.index') }}"> 
                            <i class='bx bx-user icon'></i> 
                            <span class="text nav-text">Teachers</span> 
                        </a> 
                    </li> 

                    <li class="nav-link"> 
                        <a href="{{ route('admin.students.index') }}"> 
                            <i class='bx bx-group icon'></i> 
                            <span class="text nav-text">Students</span> 
                        </a> 
                    </li> 

                    <li class="nav-link"> 
                        <a href="{{ route('admin.timetables.index') }}"> 
                            <i class='bx bx-calendar icon'></i> 
                            <span class="text nav-text">Timetables</span> 
                        </a> 
                    </li> 
                @elseif($role === 'teacher')
                    <li class="nav-link"> 
                        <a href="#"> 
                            <i class='bx bx-group icon'></i> 
                            <span class="text nav-text">My Students</span> 
                        </a> 
                    </li> 

                    <li class="nav-link"> 
                        <a href="#"> 
                            <i class='bx bx-calendar icon'></i> 
                            <span class="text nav-text">My Schedule</span> 
                        </a> 
                    </li> 
                @elseif($role === 'student')
                    <li class="nav-link"> 
                        <a href="#"> 
                            <i class='bx bx-calendar icon'></i> 
                            <span class="text nav-text">My Schedule</span> 
                        </a> 
                    </li> 

                    <li class="nav-link"> 
                        <a href="#"> 
                            <i class='bx bx-book icon'></i> 
                            <span class="text nav-text">Assignments</span> 
                        </a> 
                    </li> 
                @endif

                <li class="nav-link"> 
                    <a href="{{ route('profile.show') }}"> 
                        <i class='bx bx-user-circle icon'></i> 
                        <span class="text nav-text">Profile</span> 
                    </a> 
                </li> 
            </ul> 
        </div> 

        <div class="bottom-content"> 
            <li> 
                <form method="POST" action="{{ route('logout') }}" x-data>
                    @csrf
                    <a href="{{ route('logout') }}" @click.prevent="$root.submit();"> 
                        <i class='bx bx-log-out icon'></i> 
                        <span class="text nav-text">Logout</span> 
                    </a> 
                </form>
            </li> 

            <li class="mode"> 
                <div class="sun-moon"> 
                    <i class='bx bx-moon icon moon'></i> 
                    <i class='bx bx-sun icon sun'></i> 
                </div> 
                <span class="mode-text text">Dark mode</span> 

                <div class="toggle-switch"> 
                    <span class="switch"></span> 
                </div> 
            </li> 
        </div> 
    </div> 
</nav>

