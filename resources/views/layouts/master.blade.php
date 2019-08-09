<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @section('css')
       <!-- BEGIN GLOBAL MANDATORY STYLES -->
       <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
       <link href="{{asset('/')}}/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
       <link href="{{asset('/')}}/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
       <link href="{{asset('/')}}/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
       <link href="{{asset('/')}}/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
       <!-- END GLOBAL MANDATORY STYLES -->
       <!-- BEGIN THEME GLOBAL STYLES -->
       <link href="{{asset('/')}}/assets/global/css/components.min.css" rel="stylesheet" id="style_components" type="text/css" />
       <link href="{{asset('/')}}/assets/global/css/plugins.min.css" rel="stylesheet" type="text/css" />
       <!-- END THEME GLOBAL STYLES -->
       <!-- BEGIN THEME LAYOUT STYLES -->
       <link href="{{asset('/')}}/assets/layouts/layout4/css/layout.min.css" rel="stylesheet" type="text/css" />
       <link href="{{asset('/')}}/assets/layouts/layout4/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
       <link href="{{asset('/')}}/assets/layouts/layout4/css/custom.min.css" rel="stylesheet" type="text/css" />
       <!-- END THEME LAYOUT STYLES -->
    @show
</head>
<body class="page-container-bg-solid page-header-fixed page-sidebar-closed-hide-logo">
        <div id="app">
            <div class="page-container">
                <header-component></header-component>
                <nav-component></nav-component>
                <div class="page-content-wrapper">
                    <div class="page-content">
                        <keep-alive>
                                <router-view></router-view>
                        </keep-alive>
                    </div>
                </div>
             </div>
        </div>
    @section('js')
        <!-- BEGIN CORE PLUGINS -->
        <script src="{{asset('/')}}assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN THEME GLOBAL SCRIPTS -->
        <script src="{{asset('/')}}assets/global/scripts/app.min.js" type="text/javascript"></script>
        <!-- END THEME GLOBAL SCRIPTS -->
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="{{asset('/')}}assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="{{asset('/')}}assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="{{ asset('js/app.js') }}"></script>
    @show
</body>
</html>