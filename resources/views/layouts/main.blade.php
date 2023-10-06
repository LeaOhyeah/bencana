<!DOCTYPE html>
<html>

<head>
    <title>Create Disaster</title>
    @vite('public/css/style.css')
</head>

<body>
    <div class="drawer lg:drawer-open">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" /> 
        <div class="drawer-content flex flex-col">
          <!-- Navbar -->
          <nav class="w-full navbar bg-background2">
            <div class="flex-none">
              <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
              </label>
            </div> 
            <div class="flex-1 px-2 mx-2 font-semibold">Bencana</div>
            <div class="flex-none hidden lg:block">
                
              <ul class="menu menu-horizontal">
                <!-- Menu Navbar -->
                <li><a>Navbar Item 1</a></li>
                <li><a>Navbar Item 2</a></li>
              </ul>
            </div>
            <!-- Profile -->
            <div class="dropdown dropdown-end">
                <label tabindex="0" class="btn btn-ghost btn-circle avatar">
                  <div class="w-10 rounded-full">
                    <img src="https://media.istockphoto.com/id/1386479313/photo/happy-millennial-afro-american-business-woman-posing-isolated-on-white.jpg?s=612x612&w=0&k=20&c=8ssXDNTp1XAPan8Bg6mJRwG7EXHshFO5o0v9SIj96nY=" />
                    <ul tabindex="0" class="menu menu-sm dropdown-content mt-5 z-[1] p-2 shadow bg-secondary2 text-main rounded-box w-52">
                        <li>
                          <a class="justify-between  hover:text-main/50">
                            Profile
                            <span class="badge bg-accent2">Admin</span>
                          </a>
                        </li>
                            <li><a class="hover:text-main/10">Settings</a></li>
                            <li><a class="hover:text-main/10">Logout</a></li>
                    </ul>
            </div>
        </nav>
        <!-- End of navbar -->

        <!-- Main -->
        <div class="container bg-background2">
            @yield('container')
        </div>
        <!-- End of main -->

        <div class="drawer-side">
          <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label> 
          <ul class="menu p-4 w-80 min-h-full bg-primary2 font-semibold">
            
            <!-- Sidebar content here -->
            <li class="py-8"><a class="text-xl" href="#">Dashboard</a></li>
            <p class="text-sm px-4">Navigation</p>
            <li class="mt-2">
            <details close>
              <summary>User</summary>
               <ul>
                  <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev User</a></li>
                  <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash User</a></li>
                </ul>
              </details>
            </li>

              <li class="mt-3">
                <details close>
                <summary>Disaster</summary>
                 <ul>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev Disaster</a></li>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash Disaster</a></li>
                  </ul>
                </details>
              </li>

              <li class="mt-3">
                <details close>
                <summary>Post</summary>
                 <ul>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev Post</a></li>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash Post</a></li>
                  </ul>
                </details>
              </li>

              <li class="mt-3">
                <details close>
                <summary>Request</summary>
                 <ul>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev Post</a></li>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash Post</a></li>
                  </ul>
                </details>
              </li>

              <li class="mt-3">
                <details close>
                <summary>Aid</summary>
                 <ul>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev Aid</a></li>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash Aid</a></li>
                  </ul>
                </details>
              </li>

              <li class="mt-3">
                <details close>
                <summary>Category</summary>
                 <ul>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Dev Category</a></li>
                    <li class="hover:bg-secondary2 hover:text-main rounded-md"><a href="#">Trash Category</a></li>
                  </ul>
                </details>
              </li>
              
          </ul>
        </div>
        </div>
  
</body>

</html>
