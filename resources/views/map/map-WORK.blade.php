@extends('layouts.app')

@section('content')
    <!-- Leaflet CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Leaflet Routing Machine CSS CDN -->
    <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/styleMap.css') }}">

    <div id='map'></div>

    <div class="formBlock" style="margin-top: 50px;">
        <form id="form">
            <input type="text" name="start" class="input" id="start"
                placeholder="Ingrese la dirección de partida" />
            <button type="submit"
                style="background-color: var(--bs-blue); color: white; border: none; outline: none; border-radius: 3px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">Calcular
                Ruta</button>
        </form>
    </div>

    <!-- Leaflet JS CDN -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <!-- Leaflet Routing Machine JS CDN -->
    <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>

    <script>
        const tileProvider = 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png';
        const initialPoint = L.latLng({{ $bar->latitude }}, {{ $bar->longitude }}); // Coordenadas del bar

        let map = L.map('map').setView(initialPoint, 13);

        L.tileLayer(tileProvider, {
            maxZoom: 18,
            attribution: 'Leafletjs&copy; <a href="https://www.openstreetmap.org/copyright">RutaDeLaTapa</a> contributors'
        }).addTo(map);

        let marker = L.marker(initialPoint).addTo(map); // Marcador en la ubicación del bar

        const routeControl = L.Routing.control({
            waypoints: [
                initialPoint, // Punto de partida inicializado con la ubicación del bar
                initialPoint // Punto de destino inicializado con la ubicación del bar
            ],
            routeWhileDragging: true // Para mostrar la ruta mientras se arrastra el punto en el mapa
        }).addTo(map);

        // Evento para manejar el formulario y trazar la ruta
        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío del formulario por defecto

            const startPointAddress = document.getElementById('start')
            .value; // Obtén la dirección de inicio desde el formulario

            // Realiza la solicitud a Nominatim API para obtener las coordenadas de la dirección
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${startPointAddress}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const startPointCoordinates = L.latLng(data[0].lat, data[0]
                        .lon); // Coordenadas del punto de inicio

                        // Actualiza la ruta en el mapa
                        routeControl.setWaypoints([
                            startPointCoordinates,
                            initialPoint // Ubicación del bar
                        ]);
                    } else {
                        console.error('No se encontraron coordenadas para la dirección ingresada.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });
    </script>
@endsection
