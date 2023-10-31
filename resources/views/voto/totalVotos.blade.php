@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Total de Votos por Bar y Tapa</h2>
        @if (count($barTapaWithTotalVotos) === 0)
            <p>No hay votos registrados aún.</p>
        @else
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-secondary align-middle">
                    <thead class="table-light">
                        <tr>
                            <th class="text-center">Foto</th>
                            <th class="text-center">Tapa</th>
                            <th class="text-center">Bar</th>                            
                            <th class="text-center">Total Votos</th>
                            {{-- <th class="text-center">Puntuación</th> --}}
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach ($barTapaWithTotalVotos as $data)
                            <tr class="table-light">
                                <td class="text-center">
                                    <img src="{{ asset('storage/' . $data['img']) }}" alt="{{ $data['tapa'] }}" class="img-fluid img-thumbnail" style="max-width: 100px; border: 1px solid #ddd;">
                                </td>
                                <td class="text-center">{{ $data['tapa'] }}</td>
                                <td class="text-center">{{ $data['bar'] }}</td>                               
                                <td class="text-center"><strong>{{ $data['totalVotos'] }}</strong></td>
                                {{-- <td class="text-center">{{ $data['stars'] }}</td> --}}
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center">
                {{ $barTapas->links() }}
            </div>
        @endif
    </div>
@endsection
