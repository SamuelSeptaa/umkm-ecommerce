<script>
    let lat = "-2.2136";
    let long = "113.9108";


    @if ($profile->member->latitude)
        lat = "{{ $profile->member->latitude }}";
        long = "{{ $profile->member->longitude }}";
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


    @if ($profile->member->latitude)
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
        $("#latitude").val(e.lngLat.lat);
        $("#longitude").val(e.lngLat.lng);
        generateAddress(e.lngLat.lat, e.lngLat.lng);
    });

    geolocateControl.on('geolocate', (e) => {
        if (marker)
            marker.remove();
        marker = new mapboxgl.Marker()
            .setLngLat([e.coords.longitude, e.coords.latitude])
            .addTo(map);
        $("#latitude").val(e.coords.latitude);
        $("#longitude").val(e.coords.longitude);
        generateAddress(e.coords.latitude, e.coords.longitude);
    });

    const generateAddress = (lat, long) => {
        $.ajax({
            type: "post",
            url: `{{ route('address') }}`,
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: {
                lat: lat,
                long: long,
            },
            processData: true,
            beforeSend: function() {
                showLoading();
            },
            success: function(response) {
                $("#address").val(response.data.address);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                const statusCode = jqXHR.status;
                switch (statusCode) {
                    default:
                        Swal.fire(
                            textStatus,
                            jqXHR.responseJSON.message,
                            'error'
                        );
                }

            },
            complete: function() {
                hideLoading();
            }
        });
    }
</script>
