<script>
    let checkOut = new Vue({
        el: '#form-checkout',
        data: {
            selectedCourier: "",
            lat: "{{ $profile->member->latitude }}",
            long: "{{ $profile->member->longitude }}",
            rate: 0,
            rateIDR: "",
            original_total:{{$cart_total}},
            total: {{$cart_total}},
            totalIDR: "",
            rates: [],
            type: "",
            counter: 0,
            coupon: "",
            discount: 0,
            disountIDR: "",
            successMessage: "",
            errorMessage: "",
        },
        created() {
            this.rateIDR = currencyIDR(this.rate);
            this.totalIDR = currencyIDR(this.total);
            this.disountIDR = currencyIDR(this.discount);
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
                        self.total = self.original_total;
                        self.type = "";
                        self.coupon = "";

                        self.rate = 0;
                        self.rateIDR = currencyIDR(self.rate);
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
                        self.totalIDR = currencyIDR(self.total);
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
                this.total = this.total + this.rate;
                this.totalIDR = currencyIDR(this.total);
            },
            applyCoupon:function(){
                const self = this;
                const coupon = self.coupon;
                const purchase_value = self.total;
                $.ajax({
                    type: "post",
                    url: `{{ route('apply-coupon') }}`,
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: {
                        coupon: coupon,
                        purchase_value : purchase_value,
                    },
                    processData: true,
                    beforeSend: function() {
                        self.total = self.original_total;
                        self.totalIDR = currencyIDR(self.total);
                        self.errorMessage ="";
                        self.successMessage ="";
                        showLoading();
                    },
                    success: function(response) {
                        self.successMessage = response.message;
                        self.discount = response.data.discount;
                        self.total = self.total - self.discount;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        const statusCode = jqXHR.status;
                        switch (statusCode) {
                            case 404:
                                self.errorMessage = jqXHR.responseJSON.message
                                break;
                            default:
                                Swal.fire(
                                    textStatus,
                                    jqXHR.responseJSON.message,
                                    'error'
                                );
                        }

                    },
                    complete: function() {
                        self.totalIDR = currencyIDR(self.total);
                        hideLoading();
                    }
                });
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