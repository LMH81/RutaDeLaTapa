@extends('layouts.app')

@section('template_title')
    {{ $tapa->name ?? __('Detalle de la Tapa') }}
@endsection

@section('content')
    <div class="container" style="margin-top: 20px;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <strong>Tapa - Bar</strong>
                    </div>

                    <div class="card-body">
                        <!-- Detalles de la Tapa -->
                        <p><strong>Tapa ID:</strong> {{ $tapa->id }}</p>
                        <p><strong>Nombre Tapa:</strong> {{ $tapa->name }}</p>
                        <p><strong>Descripción:</strong> {{ $tapa->description }}</p>
                        <p><strong>Precio:</strong> {{ $tapa->price }} €</p>
                        <p><strong>Imagen tapa:</strong></p>
                        <img class="img-fluid img-thumbnail" src="{{ asset('storage/' . $tapa->img) }}"
                            alt="{{ $tapa->name }}" style="max-width: 200px; border: 1px solid #ddd;" />

                        <!-- Detalles del Bar (si está presente) -->
                        @if (isset($bar))
                            <p style="margin-top: 20px" class="idMapa" id="barId" data-bar-id="{{ $bar->id }}">
                                <strong>Bar ID:</strong> {{ $bar->id }}
                            </p>
                            <p><strong>Nombre Bar:</strong> {{ $bar->name }}</p>
                            <p><strong>Descripción:</strong> {{ $bar->description }}</p>
                            <p><strong>Dirección:</strong> {{ $bar->address }}</p>
                            <p><strong>Horario:</strong> {{ $bar->opening_hours }}</p>

                            <!-- Agregar el contenedor del mapa -->
                            <div id="barMap" style="height: 300px; width: 100%;"></div>

                            <!-- Script para inicializar el mapa -->
                            <script>
                                const titleProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
                                const barId = document.querySelector('.idMapa').dataset.barId;

                                // Obtener las coordenadas del bar desde el backend
                                fetch(`/bar/${barId}/coordinates`)
                                    .then(response => response.json())
                                    .then(data => {
                                        let barMap = L.map('barMap').setView([data.latitude, data.longitude], 18);
                                        L.tileLayer(titleProvider, {
                                            maxZoom: 20,
                                            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">RutaDeLaTapa</a>'
                                        }).addTo(barMap);

                                        // Agregar marcador en la ubicación del bar
                                        L.marker([data.latitude, data.longitude]).addTo(barMap);
                                    })
                                    .catch(error => console.error('Error:', error));
                            </script>
                        @endif

                    </div>
                </div>
                <div class="col-md-5 mt-3 mb-3">
                    <a class="btn" style="background-color: var(--bs-blue); color: white;"
                        href="{{ route('bar_tapa.index') }}">
                        <i class="fa fa-fw fa-lg fa-arrow-left"></i>
                        Regresar
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
