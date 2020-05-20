<!DOCTYPE html>
<html>

<head>
    <title>Page Title</title>
    <script src="{{ asset('inspinia/js/jquery-3.1.1.min.js') }}"></script>
</head>

<body>

    <h1>This is a Heading</h1>
    <p>This is a paragraph.</p>

</body>
<script>
    $(document).ready(function() {
        (function worker() {
            var url = '{{asset("movil/driver_moto/movimientos_arqui2")}}';
            jQuery.ajax({
                url: url,
                type: "GET",
                dataType: "json",
                headers: {

                },
                data: {

                },
                success: function(data) {
                    console.log(data);
                    setTimeout(worker, 1000);
                },
                error: function(error) {
                    console.log('Se ha producido un error, por favor comunicate con Picapino.', '¡ERROR!');
                }
            });
        })();
    });
</script>

</html>