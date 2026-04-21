<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $app_name ?? 'SIMONIK-MIKRO' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Custom Style --}}
    <style>
        body{
    background: url('/assets/login.jpg') no-repeat center center/cover;
    min-height:100vh;
    font-family:'Segoe UI', sans-serif;
}

        .sidebar{
    background: rgba(0,60,113,0.95);
    backdrop-filter: blur(6px);
    min-height:100vh;
    color:white;
}

        .sidebar a{
    color:white;
    text-decoration:none;
    display:block;
    padding:12px 15px;
    border-radius:10px;
    margin-bottom:6px;
    transition:0.25s;
    font-weight:500;
}

.sidebar a:hover{
    background: rgba(255,255,255,0.15);
    transform: translateX(4px);
}

        .brand-title {
            font-weight: 700;
            letter-spacing: 1px;
        }
.navbar{
    background: rgba(255,255,255,0.85) !important;
    backdrop-filter: blur(6px);
}
.logo-navbar{
    height:60px;
    width:auto;
}
        .content-area{
    min-height:100vh;
    background: rgba(255,255,255,0.15);
}

        .card-kpi {
            border: none;
            border-radius: 15px;
            padding: 20px;
            background: white;
            box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        }
.modern-kpi{
    background: linear-gradient(135deg,#ffffff,#f8fbff);
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.06);
    transition: 0.3s;
}

.modern-kpi:hover{
    transform: translateY(-5px);
    box-shadow: 0 15px 30px rgba(0,0,0,0.12);
}

.progress-modern{
    height: 12px;
    border-radius: 10px;
}
        .btn-mandiri {
            background-color: #FFC72C;
            color: #003C71;
            font-weight: 600;
            border: none;
        }

        .btn-mandiri:hover {
            background-color: #ffb700;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <div class="col-md-2 sidebar p-4">
            <div class="brand-title mb-4">
                SIMONIK-MIKRO
            </div>

            @if(auth()->user()->role == 'manager')
                @include('layout.side_manager')
            @elseif(auth()->user()->role == 'marketing')
                @include('layout.side_marketing')
            @elseif(auth()->user()->role == 'analyst')
                @include('layout.side_analyst')
            @endif
        </div>

        {{-- MAIN CONTENT --}}
        <div class="col-md-10 p-0 content-area">

            {{-- NAVBAR --}}
            @include('layout.navbar')

           <div class="p-4">
    <div class="content-wrapper">
        @include('components.alert')
        @yield('content')
    </div>
</div>

        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/chart.js') }}"></script>
@yield('scripts')  <!-- <-- tambahkan ini -->
</body>
</html>
