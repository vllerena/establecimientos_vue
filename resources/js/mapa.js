import { OpenStreetMapProvider } from 'leaflet-geosearch';
const provider = new OpenStreetMapProvider();

document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('#mapa')){
        const latdefault = document.querySelector('#lat').value;
        const lngdefault = document.querySelector('#lng').value;
        const lat = latdefault === '' ? -7.1523579 : latdefault;
        const lng = lngdefault === '' ? -78.5083376 : lngdefault;
        const mapa = L.map('mapa').setView([lat, lng], 16);
        let markers = new L.FeatureGroup().addTo(mapa);
        const apiKey = "AAPKd1c1d75e7c3b43268c60963e5d11ec24NAJj70ELzlQ_ojimFljeMuycnu1qp7BZSh53M-OxJeaZMg6ESJ-lvC8ZNnY5qo0E";

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mapa);

        let marker;
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true,
        }).addTo(mapa);
        markers.addLayer(marker);

        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: apiKey
        });

        const buscador = document.querySelector('#formbuscador');
        buscador.addEventListener('blur', buscarDireccion);

        reubicarPin(marker);

        function reubicarPin(marker) {
            marker.on('moveend', function (e){
                marker = e.target;
                const posicion = marker.getLatLng();
                mapa.panTo(new L.LatLng(posicion.lat, posicion.lng));
                geocodeService.reverse().latlng(posicion, 16).run(function (error, result, response){
                    marker.bindPopup(result.address.LongLabel);
                    marker.openPopup();
                    llenarInputs(result);
                });
            });
        }

        function buscarDireccion(e){
            if (e.target.value.length > 3) {
                provider.search({query: e.target.value})
                    .then(result => {
                        if(result){
                            markers.clearLayers();
                            geocodeService.reverse().latlng(result[0].bounds[0], 16).run(function (error, result, response){
                                llenarInputs(result);
                                mapa.setView(result.latlng);
                                marker = new L.marker(result.latlng, {
                                    draggable: true,
                                    autoPan: true,
                                }).addTo(mapa);
                                markers.addLayer(marker);
                                reubicarPin(marker);
                            });
                        }
                    }).catch(error => {
                    console.error(error)
                })
            }
        }

        function llenarInputs(result){
            document.querySelector('#direccion').value = result.address.Address || '';
            document.querySelector('#colonia').value = result.address.City + ' - ' + result.address.Postal || '';
            document.querySelector('#lat').value = result.latlng.lat || '';
            document.querySelector('#lng').value = result.latlng.lng || '';
        }

    }
});
