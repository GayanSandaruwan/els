<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{ config('app.name') }} - @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!--Date Picker-->
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin-lte/dist/css/AdminLTE.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin-lte/bower_components/select2/dist/css/select2.min.css')}}">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{asset('admin-lte/dist/css/skins/skin-blue.min.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <style>
        .cont-shadow{
            background-image: url('/images/resize.png');
            background-repeat: repeat-y; /* for vertical repeat */
            background-repeat: repeat-x; /* for horizontal repeat */
            height:500px;
        }
    </style>
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
    <header class="main-header">

        <!-- Logo -->
        <a href="{{route('home')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>ELS</b></span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>E-Learning</b> sys</span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>
            <!-- Navbar Right Menu -->
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <!-- Notifications Menu -->
                    <li class="dropdown notifications-menu">
                        <!-- Menu toggle button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-warning">0</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 0 notifications</li>
                            <li>
                                <!-- Inner Menu: contains the notifications -->
                                <ul class="menu">
                                    <li><!-- start notification -->
                                        <a href="#">
                                            <i class="fa fa-users text-aqua"></i> Nothing important
                                        </a>
                                    </li>
                                    <!-- end notification -->
                                </ul>
                            </li>
                            <li class="footer"><a href="#">View all</a></li>
                        </ul>
                    </li>

                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
{{--                            <img src="{{Auth::user()->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="user-image" alt="User Image">--}}
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{Auth::user()->name}}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
{{--                                <img src="{{Auth::user()->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="img-circle" alt="User Image">--}}

                                <p>
                                    {{Auth::user()->name}}
                                    <small>Member Since {{Auth::user()->created_at}}</small>
                                </p>
                            </li>

                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"> </i> <span>Logout</span>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>                                </div>
                            </li>
                        </ul>
                    </li>
                    {{--<!-- Control Sidebar Toggle Button -->--}}
                    {{--<li>--}}
                        {{--<a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>--}}
                    {{--</li>--}}
                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

            <!-- Sidebar user panel (optional) -->
            <div class="user-panel">
                <div class="pull-left image">
                    {{--<img src="{{Auth::user()->getFirstMediaUrl('profile_pictures', 'thumb') }}" class="img-circle" alt="User Image">--}}
                </div>
                <div class="pull-left info">
                    <p>{{Auth::user()->name}}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- search form (Optional) -->
            <form action="#" method="get" class="sidebar-form">
                <div class="input-group">
                    <input type="text" name="q" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
                </div>
            </form>
            <!-- /.search form -->

            <!-- Sidebar Menu -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menue</li>
                <!-- Optionally, you can add icons to the links -->
                {{--<li class="active"><a href="{{route('mobile')}}"><i class="fa fa-mobile-phone"></i> <span>Mobile App Data</span></a></li>--}}
                {{--<li><a href="{{route('device')}}"><i class="fa fa-line-chart"></i> <span>GPS Data</span></a></li>--}}
                <li class="treeview">
                    <a href="#"><i class="fa fa-gears"></i> <span>Account</span>
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                            </a>
                            <ul class="treeview-menu">
                                {{--<li><a href="{{route('updatePasswordForm')}}"><i class="fa fa-user-secret"></i> <span>Change Password</span> </a></li>--}}
                                {{--<li><a href="{{route('updateAccountForm')}}"><i class="fa fa-pencil"> </i> <span>Update Account</span></a></li>--}}
                                <li><a href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"> </i> <span>Logout</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                </li>
                            </ul>
                     </li>
            @if(Auth::user()->type == 'admin')
                    <li class="treeview">
                        <a href="#"><i class="fa fa-user"></i> <span>Users</span>
                            <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                      </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{route('addTeacherForm')}}"><i class="fa fa-plus"></i> <span>Register Teacher</span></a></li>
                            <li><a href="{{route('geteditDeleteTeacherForm')}}"><i class="fa fa-edit"></i> <span>Edit Teacher</span></a></li>
                            <li><a href="{{route('addStudentForm')}}"><i class="fa fa-plus"></i> <span>Register Student</span></a></li>
                            <li><a href="{{route('geteditDeleteStudentForm')}}"><i class="fa fa-edit"></i> <span>Edit Student</span></a></li>
                            <li><a href="{{route('addParentForm')}}"><i class="fa fa-edit"></i> <span>Register Parent</span></a></li>
                            <li><a href="{{route('studentToParentForm')}}"><i class="fa fa-plus"></i> <span>Assign Student to Parent</span></a></li>

                        </ul>
                    </li>
                    <li><a href="{{route('addTimeSlotForm')}}"><i class="fa fa-plus"></i> <span>Create a Live Session</span></a></li>
                    <li><a href="{{route('studentToSlot')}}"><i class="fa fa-plus"></i> <span>Assign Academics</span></a></li>
                    <li><a href="{{route('viewTimeSlotRequests')}}"><i class="fa fa-eye"></i> <span>View Requests</span></a></li>
                    <li><a href="{{route('adminviewLessons')}}"><i class="fa fa-eye"></i> <span>View Lessons</span></a></li>
{{--                    <li><a href="{{route('editTeacher')}}"><i class="fa fa-eye"></i> <span>Edit Teacher</span></a></li>--}}
{{--                    <li><a href="{{route('editStudent')}}"><i class="fa fa-eye"></i> <span>View Student</span></a></li>--}}

                    {{--<li><a href="{{route('viewUserForm')}}"><i class="fa fa-eye-slash"></i> <span>View Users</span></a></li>--}}
            @elseif(Auth::user()->type == 'teacher')
                    <li><a href="{{route('uploadQuiz')}}"><i class="fa fa-plus"></i> <span>Upload Quiz</span></a></li>
                    <li><a href="{{route('uploadAss')}}"><i class="fa fa-plus"></i> <span>Upload Assignment</span></a></li>
                    <li><a href="{{route('uploadLesson')}}"><i class="fa fa-eye"></i> <span>Upload Lessons</span></a></li>
                    <li><a href="{{route('teacherviewAssignment')}}"><i class="fa fa-eye"></i> <span>View Assignment</span></a></li>
                    <li><a href="{{route('viewQuizzes')}}"><i class="fa fa-eye"></i> <span>View Quizzes</span></a></li>
                    <li><a href="{{route('teacherviewLessons')}}"><i class="fa fa-eye"></i> <span>View Lessons</span></a></li>
                    <li><a href="{{route('viewmyslots')}}"><i class="fa fa-eye"></i> <span>View My Live Sessions</span></a></li>

                    {{--                @endif--}}
            @elseif(Auth::user()->type == 'student')
                <li><a href="{{route('requestTime')}}"><i class="fa fa-plus"></i> <span>Request a Live Session</span></a></li>
                    <li><a href="{{route('viewQuizes')}}"><i class="fa fa-eye"></i> <span>viewQuizes</span></a></li>
                    <li><a href="{{route('viewAssignment')}}"><i class="fa fa-eye"></i> <span>View My Assignments</span></a></li>
                    <li><a href="{{route('getStudentSlots')}}"><i class="fa fa-eye"></i> <span>View Live Sessions</span></a></li>
                    <li><a href="{{route('viewLiveQuizzes')}}"><i class="fa fa-eye"></i> <span>View Live Session Quizzes</span></a></li>
                    <li><a href="{{route('viewLessons')}}"><i class="fa fa-eye"></i> <span>View Lessons</span></a></li>

                @elseif(Auth::user()->type == 'parent')
                    <li><a href="{{route('viewmystudents')}}"><i class="fa fa-eye"></i> <span>View My Students</span></a></li>
                    {{--<li><a href="{{route('viewUserForm')}}"><i class="fa fa-eye-slash"></i> <span>View Users</span></a></li>--}}
            @endif
            </ul>

            <!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper" style="overflow: hidden;" >

        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('page-header')
                <small>@yield('optional-header')</small>
            </h1>
            @yield('level')
        </section>

        <!-- Main content -->
        <section class="content container-fluid container-fluid cont-shadow">

            <!--------------------------
              | Your Page Content Here |
              -------------------------->
            @yield('content')

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="pull-right hidden-xs">

            ELS - E learning System
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2019 <a href="#">E Learning System</a>.</strong>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
            <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
            <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <!-- Home tab content -->
            <div class="tab-pane active" id="control-sidebar-home-tab">
                <h3 class="control-sidebar-heading">Recent Activity</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <i class="menu-icon fa fa-birthday-cake bg-red"></i>

                            <div class="menu-info">
                                <h4 class="control-sidebar-subheading">Langdon's Birthday</h4>

                                <p>Will be 23 on April 24th</p>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

                <h3 class="control-sidebar-heading">Tasks Progress</h3>
                <ul class="control-sidebar-menu">
                    <li>
                        <a href="javascript:;">
                            <h4 class="control-sidebar-subheading">
                                Custom Template Design
                                <span class="pull-right-container">
                    <span class="label label-danger pull-right">70%</span>
                  </span>
                            </h4>

                            <div class="progress progress-xxs">
                                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
                            </div>
                        </a>
                    </li>
                </ul>
                <!-- /.control-sidebar-menu -->

            </div>
        </div>
    </aside>
    <!-- /.control-sidebar -->
    <!-- Add the sidebar's background. This div must be placed
    immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 3 -->
<script src="{{asset('admin-lte/bower_components/jquery/dist/jquery.min.js')}}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{asset('admin-lte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('admin-lte/dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('admin-lte/plugins/input-mask/jquery.inputmask.js')}}"></script>
<script src="{{asset('admin-lte/plugins/input-mask/jquery.inputmask.date.extensions.js')}}"></script>
<script src="{{asset('admin-lte/plugins/input-mask/jquery.inputmask.extensions.js')}}"></script>
<script src="{{asset('admin-lte/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('admin-lte/bower_components/select2/dist/js/select2.full.min.js')}}"></script>

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. -->

@yield('additional-scripts')
</body>
</html>
                                                                                                                                       