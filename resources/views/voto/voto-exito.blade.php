@extends('layouts.app')

@section('content')
    <div class="alert alert-success">
        Voto registrado con éxito. ¡Gracias por tu opinión!
    </div>
    <div class="d-flex justify-content">
        <a href="{{ route('voto.index') }}" class="btn btn-primary mb-3 mt-3">Regresar</a>&nbsp;&nbsp;
        
    </div>
    <!-- Otras partes de la vista si es necesario -->
@endsection
