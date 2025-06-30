@include('templates.header')
<body>
    @include('templates.flash-message')
    @include('templates.nav')
    @yield('content')
    @include('templates.footer')
    @include('templates.foot')
    @yield('script')
<body>

