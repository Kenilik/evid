@extends('layouts.app')

@section('body')
    <div id="wrapper">
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="{{ url ('/invs') }}">{{ config('app.name', 'Evidentialiser') }}</a>
            </div>
            <!-- /.navbar-header -->
            <ul class="nav navbar-top-links navbar-left">
                <li class="dropdown">
                    <a href="{{ url ('invs') }}"><i class="fa fa-eye fa-fw"></i> Investigations</a>
                </li>
            </ul>

            <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a href="{{ url ('forms') }}"><i class="fa fa-edit fa-fw"></i></a>
            </li>
            <li class="dropdown">
                <a href="{{ url ('tables') }}"><i class="fa fa-table fa-fw"></i></a>
            </li>
            <li class="dropdown">
                <a href="{{ url ('documentation') }}"><i class="fa fa-file-word-o fa-fw"></i></a>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-wrench fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li {{ (Request::is('*panels') ? 'class="active"' : '') }}>
                        <a href="{{ url ('panels') }}">Panels and Collapsibles</a>
                    </li>
                    <li {{ (Request::is('*buttons') ? 'class="active"' : '') }}>
                        <a href="{{ url ('buttons' ) }}">Buttons</a>
                    </li>
                    <li {{ (Request::is('*notifications') ? 'class="active"' : '') }}>
                        <a href="{{ url('notifications') }}">Alerts</a>
                    </li>
                    <li {{ (Request::is('*typography') ? 'class="active"' : '') }}>
                        <a href="{{ url ('typography') }}">Typography</a>
                    </li>
                    <li {{ (Request::is('*icons') ? 'class="active"' : '') }}>
                        <a href="{{ url ('icons') }}"> Icons</a>
                    </li>
                    <li {{ (Request::is('*grid') ? 'class="active"' : '') }}>
                        <a href="{{ url ('grid') }}">Grid</a>
                    </li>
                    <li {{ (Request::is('*progressbars') ? 'class="active"' : '') }}>
                        <a href="{{ url ('progressbars') }}">Progressbars</a>
                    </li>
                    <li {{ (Request::is('*collapse') ? 'class="active"' : '') }}>
                        <a href="{{ url ('collapse') }}">Collapse</a>
                    </li>
                    <li {{ (Request::is('*stats') ? 'class="active"' : '') }}>
                        <a href="{{ url ('stats') }}">Stats</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                            <a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <!--<a href="{{ url('logout') }}"> -->
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                <i class="fa fa-sign-out fa-fw"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">@yield('page_heading')</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                @yield('section')
            </div>
            <!-- /#page-wrapper -->
        </div>
    </div>
@endsection