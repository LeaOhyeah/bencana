@extends('layouts.main2')
@section('title', 'Posko')

@section('content')
    @if (session()->has('success'))
        <div class="alert alert-default-primary" role="alert">
            <b>
                {{ session('success') }}
            </b>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
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
            <a class="btn btn-primary float-right" href="{{ route('post.create') }}">Tamba Data</a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-sm table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Kode</th>
                        <th>Pusat Bencana</th>
                        <th>Nama</th>
                        <th class="d-none d-lg-block">Deskripsi</th>
                        <th>Hapus</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td><a class="text-dark" href="{{ route('post.edit', $post->id) }}">{{ $post->id }}</a></td>
                            <td><a class="text-dark" href="{{ route('post.edit', $post->id) }}">{{ $post->code }}</a></td>
                            <td><a class="text-dark" href="{{ route('post.edit', $post->id) }}">{{ $post->disaster_id }}</a></td>
                            <td><a class="text-dark" href="{{ route('post.edit', $post->id) }}">{{ $post->name }}</a></td>
                            <td class="d-none d-lg-block"><a class="text-dark"
                                    href="{{ route('post.edit', $post->id) }}">{{ $post->description }}</a></td>
                            <td>
                                <button type="button" class="btn btn-sm btn-outline-danger" data-toggle="modal"
                                    data-target="#modal_{{ $post->id }}">
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
                                <div class="modal fade" id="modal_{{ $post->id }}" tabindex="-1" role="dialog"
                                    aria-labelledby="modalLabel_{{ $post->id }}" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel_{{ $post->id }}">Hapus Data</h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form method="post" class="d-inline"
                                                action="{{ route('post.destroy', $post->id) }}">
                                                <div class="modal-body">
                                                    @method('delete')
                                                    @csrf
                                                    Yakin ingin menghapuus data {{ $post->name }}!
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
                        <th>Pusat Bencana</th>
                        <th>Nama</th>
                        <th class="d-none d-lg-block">Deskripsi</th>
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
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endpush
