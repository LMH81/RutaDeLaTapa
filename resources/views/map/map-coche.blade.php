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
            <button type="button" id="currentLocation" class="btn mt-3 shadow flex-fill"
                style="background-color: var(--bs-green); color: white; border: none; outline: none; border-radius: 3px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                Mi Ubicación Actual
            </button>

            <div class="d-flex">
                <a href="{{ route('cookies.dashboard') }}" class="btn btn-secondary mt-3 shadow flex-fill"
                    style="border-radius: 3px;">
                    <i class="fa fa-fw fa-lg fa-arrow-left"></i>Tapas
                </a>&nbsp;&nbsp;&nbsp;&nbsp;
                <button type="submit" class="btn mt-3 shadow flex-fill"
                    style="background-color: var(--bs-blue); color: white; border: none; outline: none; border-radius: 3px; box-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);">
                    Mostrar Ruta
                </button>
            </div>
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

        let marker = L.marker(initialPoint, {
            icon: L.icon({
                iconUrl: 'http://localhost/RutaDeLaTapa/public/assets/img/position-point/red.png',
                iconSize: [32, 32],
                iconAnchor: [16, 32],
                popupAnchor: [1, -34]
            })
        }).addTo(map);

        function togglePopup() {
            if (marker.isPopupOpen()) {
                marker.closePopup();
            } else {
                marker.bindPopup(getPopupContent()).openPopup();
            }
        }

        function getPopupContent() {
            const startPointAddress = document.getElementById('start').value;
            return `
                <div>
                    <h5><strong>{{ $bar->name }}</strong></h5>
                    <p><strong>{{ $bar->address }}</strong></p>
                
                    
                </div>
            `;
        } //<p><strong>${startPointAddress}</strong></p>

        marker.on('click', togglePopup);
        marker.bindPopup(getPopupContent()).openPopup();

        const routeControl = L.Routing.control({
            waypoints: [
                initialPoint,
                initialPoint
            ],
            routeWhileDragging: true
        }).addTo(map);

        document.getElementById('form').addEventListener('submit', function(event) {
            event.preventDefault();

            const startPointAddress = document.getElementById('start').value;

            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${startPointAddress}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.length > 0) {
                        const startPointCoordinates = L.latLng(data[0].lat, data[0].lon);

                        routeControl.setWaypoints([
                            startPointCoordinates,
                            initialPoint
                        ]);

                        marker.getPopup().setContent(getPopupContent());
                    } else {
                        console.error('No se encontraron coordenadas para la dirección ingresada.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        map.on('click', function(e) {
            const startPointCoordinates = e.latlng;

            fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${startPointCoordinates.lat}&lon=${startPointCoordinates.lng}`
                    )
                .then(response => response.json())
                .then(data => {
                    if (data && data.address) {
                        const streetAddress = data.address.road || '';
                        const number = data.address.house_number || '';
                        const fullAddress = `${streetAddress} ${number}`.trim();
                        document.getElementById('start').value = fullAddress;

                        fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${fullAddress}`)
                            .then(response => response.json())
                            .then(data => {
                                if (data && data.length > 0) {
                                    const startPointCoordinates = L.latLng(data[0].lat, data[0].lon);

                                    routeControl.setWaypoints([
                                        startPointCoordinates,
                                        initialPoint
                                    ]);

                                    marker.getPopup().setContent(getPopupContent());
                                } else {
                                    console.error(
                                        'No se encontraron coordenadas para la dirección ingresada.');
                                }
                            })
                            .catch(error => console.error('Error:', error));
                    } else {
                        console.error('No se pudo obtener la dirección para las coordenadas dadas.');
                    }
                })
                .catch(error => console.error('Error:', error));
        });

        routeControl.on('routesfound', function(e) {
            const routes = e.routes;
            const coords = routes[0].coordinates;
            let index = 0;
            const moveMarker = setInterval(() => {
                marker.setLatLng(coords[index]);
                index++;
                if (index === coords.length) {
                    clearInterval(moveMarker);
                }
            }, 100);
        });

        marker.on('popupclose', function() {
            marker.unbindPopup().bindPopup(getPopupContent());
        });

        marker.on('popupopen', function() {
            marker.unbindPopup().bindPopup(getPopupContent());
        });

        document.getElementById('currentLocation').addEventListener('click', function() {
            const options = {
                enableHighAccuracy: true,
                timeout: 5000,
                maximumAge: 0
            };

            const success = function(position) {
                const userLocation = L.latLng(position.coords.latitude, position.coords.longitude);

                routeControl.setWaypoints([
                    userLocation,
                    initialPoint
                ]);

                marker.getPopup().setContent(getPopupContent(position.coords.latitude, position.coords
                    .longitude));
            };

            const error = function(error) {
                console.error('Error obteniendo la ubicación:', error.message);
            };

            const watchId = navigator.geolocation.watchPosition(success, error, options);
        });
    </script>
@endsection
