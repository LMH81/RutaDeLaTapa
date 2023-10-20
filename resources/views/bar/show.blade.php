@extends('layouts.app')

@section('template_title')
    {{ $bar->name ?? "{{ __('Detalle') Bar" }}
@endsection

@section('content')
    <section class="content container-fluid h-100 ">
        <div class="row h-100 justify-content-center align-items-center"> 
             <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-2 ml-2">
                    <a class="btn btn-primary" href="{{ route('bars') }}"> {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ __('Detalle') }} Bar </strong> 
                        </div>
                        
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Bar Id:</strong>
                            {{ $bar->id }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre: </strong>
                            {{ $bar->name }}
                        </div>
                        <div class="form-group">
                            <strong>Descripción: </strong>
                            {{ $bar->description }}
                        </div>
                        <div class="form-group">
                            <strong>Dirección: </strong>
                            {{ $bar->address }}
                        </div>
                        <div class="form-group">
                            <strong>Teléfono: </strong>
                            {{ $bar->phone }}
                        </div>
                        <div class="form-group">
                            <strong>Horario: </strong>
                            {{ $bar->opening_hours }}
                        </div>
                        
                    </div>
                   
                </div>
            </div>
            
        </div>
    </section>
@endsection
 