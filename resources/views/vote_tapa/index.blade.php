@extends('layouts.app')

@section('content')
@unlessrole('admin')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible">
                        {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible">
                        {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <a href="{{ route('bar_tapa.create') }}" class="btn btn-primary mb-3 mt-3">Vota Tapa</a>
                <div class="table-responsive">
                    <table
                        class="table table-striped 
                table-hover table-borderless 
                table-secondary 
                align-middle">
                        <thead class="table-light">
                            <caption>Lista de tapas asociadas a bares</caption>
                            <tr>
                                {{-- <th scope="col">ID</th> --}}
                                <th scope="col">Foto</th>
                                <th scope="col">Tapa</th>
                                <th scope="col">Bar</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="table-group-divider">
                           
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{-- {{ $bar_tapas->links() }} --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endunless
@endsection
