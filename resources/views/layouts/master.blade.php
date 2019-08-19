<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    @include('partials.css')
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
    @include('partials.scripts')
</body>
</html>