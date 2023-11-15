@extends('layouts.app')

@section('template_title')
    {{ $bar->name ?? __('Detalle del Bar') }}
@endsection

@section('content')
    <section class="content container-fluid h-100" style="margin-top: 20px;">

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5" data-bar-id="{{ $bar->id }}">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <strong>{{ __('Detalle del Bar') }}</strong>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-group mb-1">
                            <strong>Nombre: </strong>
                            <strong> {{ $bar->name }} </strong>
                        </div>
                        <div class="form-group mb-1">
                            <strong>Descripción: </strong>
                            {{ $bar->description }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Dirección: </strong>
                            {{ $bar->address }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Teléfono: </strong>
                            {{ $bar->phone }}
                        </div>
                        <div class="form-group mb-1">
                            <strong>Horario: </strong>
                            {{ $bar->opening_hours }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row h-100 justify-content-center align-items-center mt-3">
            <div class="col-md-5">
                <div id="myMap" style="height: 400px; width: 100%;"></div>
            </div>
        </div>

        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-5 mb-3">
                <div class="d-flex justify-content-start align-items-center mt-3 ml-3">
                    <a class="btn" style="background-color: var(--bs-blue); color: white;"
                        href="{{ route('bar.index') }}"><i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        {{ __('Regresar') }}</a>
                </div>
            </div>
        </div>
    </section>

    <script>
        const titleProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';

        const barId = document.querySelector('.col-md-5').dataset.barId;

        // Obtener las coordenadas del bar desde el backend (supongamos que hay una ruta bar.coordinates)
        fetch(`/bar/${barId}/coordinates`)
            .then(response => response.json())
            .then(data => {
                let myMap = L.map('myMap').setView([data.latitude, data.longitude], 18);
                L.tileLayer(titleProvider, {
                    maxZoom: 19,
                    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">RutaDeLaTapa</a>'
                }).addTo(myMap);

                // Agregar marcador en la ubicación del bar
                L.marker([data.latitude, data.longitude]).addTo(myMap);
            })
            .catch(error => console.error('Error:', error));
    </script>
@endsection
