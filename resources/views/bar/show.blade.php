@extends('layouts.app')

@section('template_title')
    {{ $bar->name ?? "{{ __('Detalle') Bar" }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">{{ __('Detalle') }} Bar</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('bars') }}"> {{ __('Regresar') }}</a>
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
 