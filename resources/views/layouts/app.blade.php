<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Galleria</title>

<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="css/app.css">

</head>
<body class="has-navbar-fixed-top" spellcheck="false">

@include('components.navbar')

@yield('content')

<script type="text/javascript" src="js/app.js"></script>

</body>
</html>
