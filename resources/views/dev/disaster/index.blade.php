@extends('layouts.main')

<script src="{{ asset('js/jquery.js') }}"></script>
<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>



@section('container')
<div class="container bg-background2">
    <h1 class="text-3xl font-semibold pt-3 items-center">Disaster List</h1>
    <h2>
        <a href="{{ route('disaster.create') }}" class="underline">Create
        </a>
    </h2>
    <h2>
        <a href="{{ route('dashboard') }}" class="underline">Back
        </a>
    </h2>
    <input type="text" placeholder="Type here" class="mt-3 rounded-md w-full border-gray-300 shadow-sm focus:border-accent2 focus:ring focus:ring-accent2/50 focus:ring-opacity-50" />
    <div class="mt-6 overflow x-auto  stripe hover w-full border">
        
    <table id="myDataTable" border="1" class="table table-zebra">
        <thead>
            <tr>
                <th>ID</th>
                <th>Code</th>
                <th>Name</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Close Date</th>
                <th>Lat</th>
                <th>Long</th>
                <th>Deleted At</th>
                <th>Created By</th>
                <th>Edited By</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($disasters as $disaster)
                <tr>
                    <td>{{ $disaster->id }}</td>
                    <td>{{ $disaster->code }}</td>
                    <td>{{ $disaster->name }}</td>
                    <td>{{ $disaster->description }}</td>
                    <td>{{ $disaster->start_date }}</td>
                    <td>{{ $disaster->end_date }}</td>
                    <td>{{ $disaster->closed_date }}</td>
                    <td>{{ $disaster->lat }}</td>
                    <td>{{ $disaster->long }}</td>
                    <td>{{ $disaster->deleted_at }}</td>
                    <td>{{ $disaster->created_by }}</td>
                    <td>{{ $disaster->edited_by }}</td>
                    <td><a href="{{ route('disaster.edit', $disaster->id) }}" class="underline">Edit</a></td>
                </tr>
            @endforeach
        </tbody>
    </table>
    </div>
</div>
    <div class="drawer-side">
        <label for="my-drawer-3" aria-label="close sidebar" class="drawer-overlay"></label> 
        <ul class="menu p-2 w-80 min-h-full bg-primary2 font-semibold">
          
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


    <script>
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            // DataTables options and configuration here
        });
    });
    </script>
@endsection