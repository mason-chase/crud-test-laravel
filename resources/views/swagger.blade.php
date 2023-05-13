<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Swagger Ui</title>
</head>
<body>

<script type="text/javascript">
    var OPENAPI_URL="{{ route('openapi') }}"
</script>

<div id="swagger-api"></div>

@vite(['resources/js/swagger.js'])
</body>
</html>
