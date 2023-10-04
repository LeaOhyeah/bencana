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
                <div class="flex-1 px-2 mx-2 font-semibold text-white">Bencana</div>
                <div class="flex-none hidden lg:block">
                  <ul class="menu menu-horizontal font-semibold text-white">
                    <!-- Navbar menu content here -->
                    <li><a>Navbar Item 1</a></li>
                    <li><a>Navbar Item 2</a></li>
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
                        <p class="text-xl font-semibold text-white">Sistem Informasi Geografis</p>
                        <h1 class="text-4xl font-bold text-white">Posko Bencana</h1>
                        <p class="py-6 text-white lg:w-1/2">Provident cupiditate voluptatem et in. Quaerat fugiat ut assumenda excepturi exercitationem quasi. In deleniti eaque aut repudiandae et a id nisi.</p>
                        <button class="btn btn-outline text-white hover:text-stone-500">Lebih Lanjut</button>
                      </div>
                  </div>
                </div>
              </div>

              <div id="lokasiPosko">
                <div class="px-10 py-10 bg-stone-100 justify-center content-center content-around">
                        <h1 class="text-3xl text-center text-black font-semibold">Lokasi Posko</h1>       
                </div>
            </div>
            
      
              <!-- Isi web End -->
            </div> 
            <div class="drawer-side">
              <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label> 
              <ul class="menu p-4 w-80 min-h-full bg-base-300 backdrop-blur-md">
                <!-- Sidebar content here -->
                <li><a>Sidebar Item 1</a></li>
                <li><a>Sidebar Item 2</a></li>
              </ul>
            </div>
          </div>
    </body>
</html>