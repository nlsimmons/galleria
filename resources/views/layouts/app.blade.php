<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="is-clipped">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ !empty($album_title) ? $album_title : config('app.name') }}</title>

<link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="/css/app.css">

</head>
<body class="is-clipped" spellcheck="false">

	@include('comps.navbar')

	@yield('content')

	@include('comps.notification')

<script type="text/javascript" src="/js/app.js"></script>

</body>
</html>
