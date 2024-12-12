<!DOCTYPE html>
<html>

<head>
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <!-- Make sure you put this AFTER Leaflet's CSS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin="">
    </script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script rel="text/javascript" src="{{ asset('js/maps.js') }}"></script>
</head>

<body>
    <h1>Admin Panel</h1>
    <a href="/admin/add_parking">Add Parking</a>
</body>

</html>
