<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>WTI — Dashboard</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.4.1/chart.umd.js"></script>
<link rel="stylesheet" href="{{ asset('backend-asset/css/style.css') }}">
</head>
<body>

    @include('backend.components.navbars.aside')

    <div class="main">
        <div class="page">
            @yield('main')
        </div>
    </div>

    <script src="{{ asset('backend-asset/js/script.js') }}"></script>

</body>
</html>