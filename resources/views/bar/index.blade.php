
@extends('layouts.app')

@section('content')

<div class="container">

<!--Alerta mensaje --------------------------------------------->

    @if(Session::has('mensaje'))
    <div id="alerta" class="alert alert-success alert-dismissible" role="alert">
       
                 {{Session::get('mensaje')}}       
    
        <button type="button" class="close" data-dismiss="alert" aria-label="Close" onclick="cerrarAlerta()">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>    
    <script>
        function cerrarAlerta() {
            document.getElementById("alerta").style.display = "none";        }
    </script>
     @endif
    

<a href="{{ url('bar/create')}}" class="btn btn-primary">Registrar nuevo bar</a>&nbsp;&nbsp;
<a href="{{ url('bar/pdf')}}" class="btn btn-success float-right">PDF</a>
<br/><br/>
<div class="table-responsive">
    <table class="table table-striped
    table-hover	
    table-borderless
    table-secondary
    align-middle">
        <thead class="table-light">
            <caption>Lista de bares</caption>
            <tr>
                <th scope="col">Bar_id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción </th>                
                <th scope="col">Dirección</th>
                <th scope="col">Teléfono</th>
                <th scope="col">Horario</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>

            <tbody class="table-group-divider">

                @foreach ($bars as $bar)        
               
               
                <tr class="table-light" >
                    <td>{{$bar->id}}</td>
                    <td>{{$bar->name}}</td>
                    <td>{{$bar->description}}</td>
                    <td> {{$bar->address}}</td>
                    <td>{{$bar->phone}} </td>
                    <td>{{$bar->opening_hours }} </td>
                    <td>
                        @if(Auth::check())
                        <div class="btn-group" role="group" aria-label="Acciones">
                            <a href="{{ url('/bars/'.$bar->id.'/edit')}}" class="btn btn-success ">Editar</a>&nbsp;&nbsp;|&nbsp;&nbsp;

                             
                            <form action="{{ url('/bars/'.$bar->id)}}" class= "d-inline" method="post">
                                @csrf
                                {{method_field('DELETE')}}
                                <input class="btn btn-danger" type="submit" onclick= "return confirm('¿Confirmar?')" value="Borrar">
                            </form>
                            &nbsp;|&nbsp;
                            <form action="{{ url('/bars/'.$bar->id)}}" class= "d-inline" method="get">
                                @csrf                              
        
                                <input class="btn btn-warning" type="submit"  value="Mostrar">
        
                            </form>
                            
                        </div> 
                       

                        
                        @endif
                       
                    
                    
                    </td>
                </tr>

                @endforeach
                
            </tbody>
            <tfoot>
                
            </tfoot>
    </table>

    {!! $bars->links()!!}
</div>
</div>
@endsection
