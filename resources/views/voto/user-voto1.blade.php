@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Tus Votos</h2>
        @if($votosWithNames->isEmpty())
            <p>No has realizado ningún voto aún.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Foto</th>
                        <th>Tapa</th>
                        <th>Bar</th>                
                        <th>Puntuación</th>
                        <th>Comentario</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($votosWithNames as $votoData)
                        <tr>
                            <td>
                            <img src="{{ asset('storage/' . $votoData['img']) }}" alt="{{ $votoData['tapa'] }}" class="img-fluid img-thumbnail" style="max-width: 100px; border: 1px solid #ddd;">
                             </td>
                             <td>{{ $votoData['tapa'] }}</td>
                            <td>{{ $votoData['bar'] }}</td>                           
                            
                            <td>{{ $votoData['voto']->rating }}</td>
                            <td>{{ $votoData['voto']->comment ?: 'N/A' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
