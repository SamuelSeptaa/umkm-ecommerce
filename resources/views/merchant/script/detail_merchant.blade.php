<script>
    let lat = "-2.2136";
    let long = "113.9108";
    @if ($shop->lat)
        lat = "{{ $shop->lat }}";
        long = "{{ $shop->long }}";
    @endif

    mapboxgl.accessToken = mapboxKey;
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v12', // style URL
        center: [long, lat], // starting position [lng, lat]
        zoom: 12 // starting zoom
    });

    let geolocateControl = new mapboxgl.GeolocateControl({
        positionOptions: {
            enableHighAccuracy: true
        },
        trackUserLocation: false,
        showUserHeading: true
    });
    map.addControl(geolocateControl);
    let marker;


    @if ($shop->lat)
        marker = new mapboxgl.Marker()
            .setLngLat([long, lat])
            .addTo(map);
    @endif


    map.on('click', (e) => {
        if (marker)
            marker.remove();
        marker = new mapboxgl.Marker()
            .setLngLat([e.lngLat.lng, e.lngLat.lat])
            .addTo(map);
        $("#lat").val(e.lngLat.lat);
        $("#long").val(e.lngLat.lng);
    });

    geolocateControl.on('geolocate', (e) => {
        if (marker)
            marker.remove();
        marker = new mapboxgl.Marker()
            .setLngLat([e.coords.longitude, e.coords.latitude])
            .addTo(map);
        $("#lat").val(e.coords.latitude);
        $("#long").val(e.coords.longitude);
    });
</script>
