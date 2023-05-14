@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">¡Atención!</h4>
            <p>Para continuar navegando en esta página es necesario aceptar el uso de cookies.</p>
            <hr>
            <p class="mb-0">Haz clic en el botón de abajo para aceptar las cookies y acceder al dashboard.</p>
            <a href="{{ route('setCookie') }}" class="btn btn-primary mt-3">Aceptar cookies</a>
        </div>
    </div>
@endsection
