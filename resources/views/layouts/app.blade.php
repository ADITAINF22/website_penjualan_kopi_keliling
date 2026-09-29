<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kopi Keliling</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    <nav class="site-nav">
        <div class="max-w-5xl mx-auto px-5 py-4 flex justify-between items-center">
            <a href="{{ route('home') }}" class="brand"><span class="dot"></span>Kopi Keliling</a>
            <a href="{{ route('cart.index') }}" class="cartbtn">
                Keranjang · {{ array_sum(session('cart', [])) }}
            </a>
        </div>
    </nav>

    @if (session('success'))
        <div class="max-w-5xl mx-auto px-5 mt-5">
            <div class="success-box">{{ session('success') }}</div>
        </div>
    @endif

    @yield('content')

    <footer class="text-center text-sm py-10" style="color:var(--mute)">
        © {{ date('Y') }} Kopi Keliling
    </footer>
</body>
</html>