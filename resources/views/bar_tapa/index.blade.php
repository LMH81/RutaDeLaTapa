@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('RutaDeLaTapa') }}</div>

                <div class="card-body">

                    <a href="{{ route('bar_tapa.create') }}" class="btn btn-primary mb-3">Asigna Tapa</a>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Tapas</th>
                                <th>Bares</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                           {{-- @if(isset($bar_tapas))   --}}
                        
                           @foreach ($bar_tapa as $tapa)
                           <tr>
                               <td>{{ $tapa->id }}</td>
                               <td>{{ $tapa->bar_id }}</td>
                           </tr>
                       @endforeach

                        {{-- @endif  --}}
                                                        
                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection