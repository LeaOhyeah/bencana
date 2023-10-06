<!DOCTYPE html>
<html>

<head>
    <title>Create Disaster</title>
    @vite('public/css/style.css')
    @yield('css')
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle"/> 
        <div class="drawer-content flex flex-col">
          
          @include('layouts.navbar')

        <!-- Main -->
        <div class="container bg-background2">
            @yield('container')
        </div>
        <!-- End of main -->

        @include('layouts.sidebar')
        </div>
  
</body>
@stack('js')

</html>
