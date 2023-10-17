@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalles de la relación Bar-Tapa</h1>
        <p>ID de la relación: {{ $barTapa->id }}</p>
        <p>Nombre de la Tapa: {{ $barTapa->tapa_id }}</p>
        <p>Nombre del Bar: {{ $barTapa->bar_id  }}</p>
    </div>
@endsection
