<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
        @vite('./public/css/style.css')
    </head>
    <body>
        <div class="drawer">
            <input id="my-drawer-3" type="checkbox" class="drawer-toggle" /> 
            <div class="drawer-content flex flex-col">
              <!-- Navbar -->
              <div class="w-full navbar bg-transparent backdrop-blur-md absolute">
                <div class="flex-none">
                  <label for="my-drawer-3" aria-label="open sidebar" class="btn btn-square btn-ghost">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                  </label>
                </div> 
                <div class="flex-1 px-2 mx-2 font-semibold text-main">Bencana</div>
                <div class="flex-none hidden lg:block">
                  <ul class="menu menu-horizontal font-semibold">
                    <!-- Navbar menu content here -->
                    <li><a class="font-semibold text-main hover:text-slate-600 hover:underline">Login</a></li>
                    <li><a class="font-semibold text-main hover:text-slate-600 hover:underline">Register</a></li>
                  </ul>
                </div>
              </div>
              <!-- Isi web -->
              <div class="hero min-h-screen"
                    style="background-image: url(https://www.unhcr.org/th/wp-content/uploads/sites/91/2020/06/What-we-do_BasicNeeds-Shelter-RF234229.jpg);">
                <div class="hero-overlay bg-opacity-20"></div>
                <div class="hero-content text-neutral-content">
                  <div class="flex-col lg:flex-row-reverse">
                    <div>
                        <p class="text-xl font-semibold text-main">Sistem Informasi Geografis</p>
                        <h1 class="text-4xl font-bold text-main">Posko Bencana</h1>
                        <p class="py-6 text-main lg:w-1/2">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                        <button class="btn btn-outline text-main hover:text-stone-500">Lebih Lanjut</button>
                      </div>
                  </div>
                </div>
              </div>

            <div id="lamanInformasi">
              <div class="container">         
                <div class="px-10 py-10 bg-stone-100 justify-center">
                      <h1 class="text-3xl text-center text-black font-semibold">Lokasi Posko <br> <span class="text-xl font-medium">Jangkauan Peta</span></h1>       
                      <!-- Insert Gmaps  -->
                      <h1 class="text-3xl text-center text-black font-semibold">Jumlah Bencana<br> <span class="text-2xl font-bold">13</span></h1>     
                  </div>
              </div>
            </div>

                
            
      
              <!-- Isi web End -->
            </div> 
            <div class="drawer-side">
              <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label> 
              <ul class="menu p-4 w-80 min-h-full bg-base-300 backdrop-blur-md">
                <!-- Sidebar content here -->
                <li><a class="text-main font-semibold hover:text-stone-500">Sidebar Item 1</a></li>
                <li><a class="text-main font-semibold hover:text-stone-500">Sidebar Item 2</a></li>
              </ul>
            </div>
          </div>
    </body>
</html>