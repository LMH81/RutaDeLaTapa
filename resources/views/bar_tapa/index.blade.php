@extends('layouts.app')

@section('content')

@role('admin') 

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

                <a href="{{ route('bar_tapa.create') }}" class="btn btn-primary mb-3 mt-3">Asigna Tapa</a>
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
                            @if (isset($grouped_tapas))
                                @foreach ($grouped_tapas as $bar => $tapas)
                                    <tr class="table-light">
                                        {{-- <td>{{ $tapa->id }} </td> --}}
                                        <td><img class="img-fluid img-thumbnail"
                                                src="{{ asset('storage' . '/' . $tapas[0]['tapa']->img) }}" width="200px"
                                                alt="{{ $tapas[0]['tapa']->name }}"></td>
                                        <td><strong>{{ $tapas[0]['tapa']->name }}</strong></td>
                                        <td><strong>{{ $bar }}</strong> <br></td>
                                        <td>
                                            @foreach ($tapas as $tapaItem)
                                            <form action="{{ route('bar_tapa.edit', $tapaItem['bartapa_Id']) }}" class="d-inline" method="get">
                                                @csrf
                                                <button type="submit" class="btn btn-success">Editar</button>
                                                &nbsp;|&nbsp;
                                            </form>
                                                <form action="{{ route('bar_tapa.destroy', $tapaItem['bartapa_Id']) }}"
                                                    method="post" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger"
                                                        onclick="return confirm('¿Estás seguro de eliminar este registro?')">Borrar</button>
                                                </form>
                                                &nbsp;|&nbsp;
                                              
                                                <form action="{{ route('bar_tapa.show', $tapaItem['bartapa_Id']) }}"
                                                    class="d-inline" method="get">
                                                    @csrf
                                                    <input class="btn btn-warning" type="submit" value="Mostrar">
                                                </form>
                                            @endforeach
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                    <div class="pagination">
                        {{ $bar_tapas->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@endrole
