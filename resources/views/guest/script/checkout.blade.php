<script>
    let checkOut = new Vue({
        el: '#form-checkout',
        data: {
            selectedCourier: "",
            lat: "{{ $profile->member->latitude }}",
            long: "{{ $profile->member->longitude }}",
            rate: 0,
            rateIDR: "Rp 0",
            rates: [],
            type: "",
            counter: 0
        },
        methods: {
            checkRates: function() {
                const self = this;
                const courier = self.selectedCourier;
                const lat = self.lat;
                const long = self.long;

                $.ajax({
                    type: "post",
                    url: `{{ route('rates') }}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        courier: courier,
                        lat: lat,
                        long: long,
                    },
                    processData: true,
                    beforeSend: function() {
                        self.type = "";
                        showLoading();
                    },
                    success: function(response) {
                        self.rates = response.data.pricing;
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
            },
            applyRate: function() {
                const selectedValue = event.target.value;
                const selectedOption = this.rates.find(rate => rate.courier_service_code === selectedValue);
                const price = selectedOption.price;
                this.rate = price;
                this.rateIDR = currencyIDR(price);
                // Use the dataAttribute value as needed
                console.log(this.rateIDR);
            }
        },
    });
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
        checkOut.$data.lat = e.lngLat.lat
        checkOut.$data.long = e.lngLat.lng
        // $("#latitude").val(e.lngLat.lat);
        // $("#longitude").val(e.lngLat.lng);
    });

    geolocateControl.on('geolocate', (e) => {
        if (marker)
            marker.remove();
        marker = new mapboxgl.Marker()
            .setLngLat([e.coords.longitude, e.coords.latitude])
            .addTo(map);
        checkOut.$data.lat = e.coords.latitude
        checkOut.$data.long = e.coords.longitude
        // $("#latitude").val(e.coords.latitude);
        // $("#longitude").val(e.coords.longitude);
    });
</script>
