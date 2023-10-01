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
                                <th>Bar</th>
                                <th>Tapa</th>
                                
                            </tr>
                        </thead>
                        <tbody>                           
                        @if(isset($bars))                         
                            @foreach ($bars as $bar)
                            <tr>
                                <td>{{ $bar->name }}</td>
                                
                                <td>
                                    @foreach ($bar->tapas as $tapa)
                                    {{$tapa->name}} <br>
                                    @endforeach
                                </td>
                            </tr>
                            @endforeach
                        @endif                                                        
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        

    </div>
</div>
@endsection
