<script>
    new Vue({
        el: '#product-list',
        methods: {
            say: function(product_id) {
                console.log(product_id)
            }
        }
    })

    function fetch(url, callback) {
        var xhr = new XMLHttpRequest();
        xhr.open('GET', url, true);
        xhr.onreadystatechange = function() {
            if (xhr.readyState === 4 && xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                callback(data);
            }
        };
        xhr.send();
    }

    fetch('{{ route('shop') }}', function(data) {
        // Use the parsed data here
        console.log(data);
    });
</script>
