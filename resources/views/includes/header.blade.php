<header>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                        data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                @if(Auth::user())
                    <a class="navbar-brand" href="{{ route('dashboard') }}">Dashboard</a>
                @else
                    <a class="navbar-brand" href="{{ route('createUser') }}">Register</a>
                    <a class="navbar-brand" href="{{ route('login') }}">Login</a>
                @endif
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                @if(Auth::user())
                    <ul class="nav navbar-nav">
                        @if(Auth::user()->type == 'ADMIN')
                            <li @if(Request::path() == 'users') class="active" @endif><a
                                        href="{{ route('users') }}">Users</a></li>
                            <li @if(Request::path() == 'pages') class="active" @endif><a
                                        href="{{ route('pages') }}">Pages</a></li>
                            <li @if(Request::path() == 'pages/create') class="active" @endif><a
                                        href="{{ route('createPage') }}">Create Page</a></li>
                            <li @if(Request::path() == 'groups') class="active" @endif><a
                                        href="{{ route('groups') }}">Groups</a></li>
                            <li @if(Request::path() == 'groups/create') class="active" @endif><a
                                        href="{{ route('createGroup') }}">Create Group</a></li>
                            <li @if(Request::path() == 'members') class="active" @endif><a
                                        href="{{ route('members') }}">Members</a></li>
                            <li @if(Request::path() == 'members/create') class="active" @endif><a
                                        href="{{ route('createMember') }}">Create Member</a></li>
                        @elseif(Auth::user()->type == 'MEMBER')
                            <li @if(Request::path() == 'members/logs') class="active" @endif><a
                                        href="{{ route('memberLogs') }}">Logs</a></li>
                        @endif


                    </ul>
                @endif
                <ul class="nav navbar-nav navbar-right">
                    @if(Auth::user())
                        @if(Auth::user()->type == "USER")
                            <li><a href="{{ route('showUser',['user' => Auth::user()->id]) }}">Profile</a></li>
                            <li><a href="{{ route('editUser',['user' => Auth::user()->id]) }}">Edit Account</a></li>
                        @elseif(Auth::user()->type == "MEMBER")
                            <li><a href="{{ route('showMember',['user' => Auth::user()->id]) }}">Profile</a></li>
                            <li><a href="{{ route('editMember',['user' => Auth::user()->id]) }}">Edit Account</a></li>
                        @endif
                        <li><a href="{{ route('logout') }}">Logout</a></li>
                    @endif
                </ul>
            </div><!-- /.navbar-collapse -->
        </div><!-- /.container-fluid -->
    </nav>
</header>