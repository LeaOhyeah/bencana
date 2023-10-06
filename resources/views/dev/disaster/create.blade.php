@extends('layouts.main')

        <!-- Main -->
          @section('container')
          <div class="container bg-background2">
            <h1 class="text-3xl font-semibold pt-3 items-center">Create Disaster</h1>
            <div class="text-sm breadcrumbs">
              <ul>
                <li><a>Disaster</a></li> 
                <li><a>Dev Disaster</a></li> 
                <li>Add Disaster</li>
              </ul>
            </div>
            <div class="mt-3">
              
            <form method="POST" action="{{ route('disaster.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 ">
                  
                  <label class="block" for="code">Code
                   @error('code')
                  {{ $message }}
                  @enderror
                  <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="text" id="code" name="code" placeholder="Type here" required>
                  </label>
                
                  <label class="block" for="name">Name
                  <span class="inline">
                  @error('name')
                  {{ $message }}
                  @enderror
                  </span>
                  <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="text" id="name" name="name" placeholder="Type here" required><br>
                  <br>
                  </label>
                </div>
                
                <label class="block" for="description"><span>Description</span>
                @error('description')
                {{ $message }}
                @enderror
                <textarea class="mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" name="description" id="description" cols="30" rows="10" placeholder="Enter description (optional)"></textarea>
                <br>
                </label>
                <br>
              
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <label class="block" for="start_date"><span>Start Date</span>
                 @error('start_date')
                {{ $message }}
                @enderror
                <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="date" id="start_date" name="start_date"  required>
                </label>
              
                
      
                <label class="block" for="end_date"><span>End Date</span>
                 @error('end_date')
                {{ $message }}
                @enderror
                <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="date" id="end_date" name="end_date">
                </label>
                
    
                <label class="block" for="closed_date"><span>Closed Date</span>
                @error('closed_date')
                {{ $message }}
                @enderror
                 <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="date" id="closed_date" name="closed_date">
                </label>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
                <label class="block" for="lat"><span>Lat</span>
                @error('lat')
                {{ $message }}
                @enderror
                <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="text" id="lat" name="lat" placeholder="Enter Latitude" required><br>
                <br>
                </label>
    
                <label class="block" for="long"><span>Long</span>
                @error('long')
                {{ $message }}
                @enderror
                <input class="mt-1 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" type="text" id="long" name="long" placeholder="Enter Longitude" required><br>
                <br>
                </label>
               </div>
                <button type="submit" class="btn bg-accent2 hover:bg-accent2/80 font-semibold text-main mb-8">
                Save Data
                </button>
              
              </form>
            </div>
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
            

          </div>
        
        @endsection
