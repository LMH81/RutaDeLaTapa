@extends('layouts.app')

@section('template_title')
    {{ $tapa->name ?? __('Detalle') }}
@endsection


@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalle') }} Tapa </span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('tapa') }}"> {{ __('Regresar') }}</a>
                        </div>
                    </div>
                    

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Bar_id:</strong>
                            {{ $tapa->id }}
                        </div>

                        <div class="form-group">
                            
                        
                        <img class="img-fluid img-thumbnail" src="{{ asset('storage'.'/'.$tapa->img)}}"  width="200px" alt=""> 
                             
                        </div>
                        <div class="form-group">
                            <strong>Nombre: </strong>
                            {{ $tapa->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción: </strong>
                            {{ $tapa->description }}
                        </div>
                        <div class="form-group">
                            <strong>Precio: </strong>
                            {{$tapa->price}} €
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
 