@extends('layouts.app')

@section('content')
<div class="container" style="margin-top: 20px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <strong>Tapa - Bar</strong>
                </div>

                <div class="card-body">
                    <p><strong>Tapa ID:</strong> {{ $tapa->id }}</p>
                    <p><strong>Nombre Tapa:</strong> {{ $tapa->name }}</p>
                    <p><strong>Descripción:</strong> {{ $tapa->description }}</p>
                    <p><strong>Precio:</strong> {{ $tapa->price }} €</p>
                    <p><strong>Imagen tapa:</strong></p>
                    <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $tapa->img) }}" alt="{{ $tapa->name }}" style="max-width: 200px; border: 1px solid #ddd;" />

                    
                    @if(isset($bar))
                        
                        <p style="margin-top: 20px"><strong>Bar ID:</strong> {{ $bar->id }}</p>
                        <p><strong>Nombre Bar:</strong> {{ $bar->name }}</p>
                        <p><strong>Descripción:</strong> {{ $bar->description }}</p>
                        <p><strong>Dirección:</strong> {{ $bar->address }}</p>
                        <p><strong>Horario:</strong> {{ $bar->opening_hours }}</p>
                    @endif

                    
                </div>
            </div>
            <a class="btn btn-primary mb-3 mt-3" href="{{ route('bar_tapa.index') }}">
                <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                Regresar
            </a>
        </div>
    </div>
</div>
@endsection


