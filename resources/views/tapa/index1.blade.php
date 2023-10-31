@extends('layouts.app')

@section('content')
<div class="container">
    <!-- Alerta mensaje -->
    @if (Session::has('mensaje'))
    <div id="alerta" class="alert alert-success alert-dismissible" role="alert">
        {{ Session::get('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="cerrarAlerta()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <script>
        function cerrarAlerta() {
            document.getElementById("alerta").style.display = "none";
        }
    </script>
    @endif

    <a href="{{ url('tapa/create') }}" class="btn btn-primary">Registrar nueva tapa</a>&nbsp;&nbsp;
    <a href="{{ url('tapa/pdf') }}" class="btn btn-success float-right">PDF</a>&nbsp;&nbsp;
    <a href="{{ url('tapa/chartbar') }}" class="btn btn-warning float-right">Gráfica</a><br /><br />
    <div class="table-responsive">
        <table class="table table-striped table-hover table-borderless table-secondary align-middle">
            <thead class="table-light">
                <caption>Lista de tapas</caption>
                <tr>
                    <th scope="col">Foto</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($tapas as $tapa)
                <tr class="table-light">
                    <td>
                        <img class="img-fluid img-thumbnail" src="{{ asset('storage'.'/'.$tapa->img) }}" width="200px"
                            alt="">
                    </td>
                    <td><strong>{{ $tapa->name }}</strong></td>
                    <td>{{ $tapa->description }}</td>
                    <td>{{ $tapa->price }} € </td>
                    <td>
                        <a href="{{ url('/tapa/' . $tapa->id . '/edit') }}" class="btn btn-success">Editar</a> |
                        <button class="btn btn-danger" onclick="confirmDelete('{{ url('/tapa/' . $tapa->id) }}')">Borrar
                        </button> | <form action="{{ url('/tapa/' . $tapa->id) }}" class="d-inline" method="get">
                            @csrf
                            <input class="btn btn-warning" type="submit" value="Mostrar">
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        <div class="pagination">
            {{ $tapas->links() }}
        </div>
    </div>
</div>
<script>
    function confirmDelete(url) {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            window.location.href = url;
        }
    }
</script>
@endsection
