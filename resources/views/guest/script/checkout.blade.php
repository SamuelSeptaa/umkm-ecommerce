<script>
    let checkOut = new Vue({
        el: '#form-checkout',
        data: {
            selectedCourier: "",
            lat: "{{ $profile->member->latitude }}",
            long: "{{ $profile->member->longitude }}",
            rate: 0,
            rateIDR: "",
            original_total: {{ $cart_total }},
            total: {{ $cart_total }},
            totalIDR: "",
            rates: [],
            type: "",
            counter: 0,
            coupon: "",
            discount: 0,
            disountIDR: "",
            successMessage: "",
            errorMessage: "",
            payment_code: ""
        },
        created() {
            this.rateIDR = currencyIDR(this.rate);
            this.totalIDR = currencyIDR(this.total);
            this.disountIDR = currencyIDR(this.discount);
        },
        methods: {
            resetRate: function() {
                if (this.selectedCourier !== "") {
                    this.checkRates();
                }
            },
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
                        self.total = self.total - self.discount + self.rate;
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
                this.total = this.original_total;
                this.total = this.total - this.discount + this.rate;
                this.totalIDR = currencyIDR(this.total);
            },
            applyCoupon: function() {
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
                        purchase_value: purchase_value,
                    },
                    processData: true,
                    beforeSend: function() {
                        self.resetCoupon();
                        showLoading();
                    },
                    success: function(response) {
                        self.successMessage = response.message;
                        self.discount = response.data.discount;
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
                        self.total = self.total - self.discount + self.rate;
                        self.totalIDR = currencyIDR(self.total);
                        self.disountIDR = currencyIDR(self.discount);
                        hideLoading();
                    }
                });
            },
            resetCoupon: function() {
                this.total = this.original_total;
                this.totalIDR = currencyIDR(this.total);
                this.discount = 0;
                this.errorMessage = "";
                this.successMessage = "";

                this.total = this.total - this.discount + this.rate;
                this.totalIDR = currencyIDR(this.total);
                this.disountIDR = currencyIDR(this.discount);
            },
            selectPaymentMethod: function(payment_code) {
                this.payment_code = payment_code;
                const container = $(event.target).closest('div.icon-payment-container');
                $('div.icon-payment-container').removeClass('active');
                container.addClass("active")
            },
            onSubmit: function() {
                const formContainer = event.target;
                let formData = new FormData(formContainer)
                formData.append('total', this.total);
                formData.append('shipping_fee', this.rate);
                formData.append('payment_channel', this.payment_code);
                formData.append('sub_total', this.original_total);
                formData.append('total_products', cartAndFavorite.$data.counterCart);
                formData.append('voucher_discount', this.discount);
                formData.append('coupon', this.coupon)

                $.ajax({
                    url: "{{ route('make-transaction') }}",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                    data: formData,
                    processData: false,
                    contentType: false,
                    dataType: 'json',
                    beforeSend: function() {
                        showLoading();
                    },
                    success: function(response) {
                        console.log(response);
                    },
                    error: function(jqXHR, status, error) {
                        const response = jqXHR.responseJSON;
                        if (jqXHR.status == 422) {
                            let result = Object.entries(response.errors);
                            result.forEach(function([field, message], index) {
                                $(`div[for="${field}"]`).html(message);
                                $(`#${field}`).addClass('is-invalid');
                            });
                        }
                    },
                    complete: function() {
                        hideLoading();
                    }
                });
            }
        },
    });
    $(document).on('keyup change', '#form-checkout input, #form-checkout textarea, #form-checkout select', function() {
        $(this).removeClass('is-invalid');
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
        checkOut.resetRate();
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
        checkOut.resetRate();
        // $("#latitude").val(e.coords.latitude);
        // $("#longitude").val(e.coords.longitude);
    });
</script>
