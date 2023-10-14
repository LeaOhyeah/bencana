@extends('layouts.main2')
@section('title', 'Bencana')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-default-primary" role="alert">
            <b> {{ session('success') }} </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                    aria-hidden="true">&times;</span> </button>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="alert alert-default-danger" role="alert">
            <b> {{ session('error') }} </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span
                    aria-hidden="true">&times;</span> </button>
        </div>
    @endif
    <div class="card">
        <div class="card-header">
            <small>
                Klik data untuk mengedit*
            </small>
            <a class="btn btn-primary float-right" href="{{ route('disaster.create') }}">Tamba Data</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th class="d-none d-lg-block">Deskripsi</th>
                        <th>Tanggal Mulai</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($disasters as $disaster)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a class="text-dark"
                                    href="{{ route('disaster.edit', $disaster->id) }}">{{ $disaster->code }}</a></td>
                            <td><a class="text-dark"
                                    href="{{ route('disaster.edit', $disaster->id) }}">{{ $disaster->name }}</a></td>
                            <td class="d-none d-lg-block"><a class="text-dark"
                                    href="{{ route('disaster.edit', $disaster->id) }}">{{ $disaster->description }}</a></td>
                            <td><a class="text-dark"
                                    href="{{ route('disaster.edit', $disaster->id) }}"{{ $disaster->start_date() }}></a>
                            </td>
                            <td>
                                {{-- <a href="{{ route('disaster.edit', $disaster->id) }}"
                                    class="btn btn-sm btn-primary d-inline mx-3"><svg class="svg-edit"
                                        xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 512 512">
                                        <style>
                                            .svg-edit {
                                                fill: #ffffff
                                            }
                                        </style>
                                        <path
                                            d="M471.6 21.7c-21.9-21.9-57.3-21.9-79.2 0L362.3 51.7l97.9 97.9 30.1-30.1c21.9-21.9 21.9-57.3 0-79.2L471.6 21.7zm-299.2 220c-6.1 6.1-10.8 13.6-13.5 21.9l-29.6 88.8c-2.9 8.6-.6 18.1 5.8 24.6s15.9 8.7 24.6 5.8l88.8-29.6c8.2-2.7 15.7-7.4 21.9-13.5L437.7 172.3 339.7 74.3 172.4 241.7zM96 64C43 64 0 107 0 160V416c0 53 43 96 96 96H352c53 0 96-43 96-96V320c0-17.7-14.3-32-32-32s-32 14.3-32 32v96c0 17.7-14.3 32-32 32H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h96c17.7 0 32-14.3 32-32s-14.3-32-32-32H96z" />
                                    </svg>
                                </a> --}}
                                {{-- button modal --}}
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                    data-target="#modal_{{ $disaster->id }}">
                                    <svg class="svg-trash" xmlns="http://www.w3.org/2000/svg" height="1em"
                                        viewBox="0 0 448 512"><!--! Font Awesome Free 6.4.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2023 Fonticons, Inc. -->
                                        <style>
                                            .svg-trash {
                                                fill: #ff0000
                                            }
                                        </style>
                                        <path
                                            d="M135.2 17.7C140.6 6.8 151.7 0 163.8 0H284.2c12.1 0 23.2 6.8 28.6 17.7L320 32h96c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 96 0 81.7 0 64S14.3 32 32 32h96l7.2-14.3zM32 128H416V448c0 35.3-28.7 64-64 64H96c-35.3 0-64-28.7-64-64V128zm96 64c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16zm96 0c-8.8 0-16 7.2-16 16V432c0 8.8 7.2 16 16 16s16-7.2 16-16V208c0-8.8-7.2-16-16-16z" />
                                    </svg>
                                </button>
                                {{-- end button modal --}}
                                <div class="modal fade" id="modal_{{ $disaster->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel_{{ $disaster->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel_{{ $disaster->id }}">Hapus Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" class="d-inline"
                                                action="{{ route('disaster.destroy', $disaster->id) }}">
                                                <div class="modal-body">
                                                    @method('delete')
                                                    @csrf
                                                    Yakin ingin menghapuus data {{ $disaster->name }}!
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-secondary">Lanjutkan</button>
                                                    <button type="button" class="btn btn-primary"
                                                        data-dismiss="modal">Batal</button>
                                                </div>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Nama</th>
                        <th class="d-none d-lg-block">Deskripsi</th>
                        <th>Tanggal Mulai</th>
                        <th>Hapus</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection

@push('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "autoWidth": false,
            });

        });
    </script>
@endpush
