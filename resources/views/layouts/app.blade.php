<!DOCTYPE html>
<html lang="id" class="scroll-smooth scroll-pt-24">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'JUNES')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body { font-family: 'Poppins', sans-serif; }
        .font-serif-elegant { font-family: 'Playfair Display', serif; }
    </style>
</head>
@php $isHome = Request::routeIs('home'); @endphp
<body class="bg-gray-50 text-gray-800">

    {{-- ===== NAVBAR ===== --}}
    <nav id="navbar" class="{{ $isHome ? 'fixed top-0 left-0 w-full z-50 bg-transparent text-white transition-all duration-300' : 'sticky top-0 z-50 bg-slate-900 text-white' }}">
        <div class="max-w-7xl mx-auto px-6 py-5 flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2">
                <span class="text-xl tracking-wide font-serif-elegant">JUNES</span>
            </a>
            <div class="hidden md:flex items-center space-x-8 text-sm uppercase tracking-wide">
                <a href="{{ route('home') }}" class="hover:text-blue-300 transition">Produk</a>
                <a href="{{ route('home') }}#tentang" class="hover:text-blue-300 transition">Tentang Kami</a>
                <a href="{{ route('home') }}#produk" class="hover:text-blue-300 transition">Kamar & Harga</a>
                <a href="{{ route('pesanan.create') }}"
                   class="border border-white/70 px-4 py-2 rounded-full hover:bg-white hover:text-slate-900 transition">
                   Pesan Kamar
                </a>
            </div>
        </div>
    </nav>

    {{-- ===== FLASH MESSAGE ===== --}}
    @if(session('success'))
        <div class="max-w-7xl mx-auto px-6 {{ $isHome ? 'absolute top-24 left-0 right-0 z-30' : 'pt-4' }}">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
                {{ session('success') }}
            </div>
        </div>
    @endif

    {{-- ===== KONTEN UTAMA ===== --}}
    <main>
        @yield('content')
    </main>

    {{-- ===== FOOTER ===== --}}
    <footer class="bg-slate-900 text-gray-400 text-center py-6 mt-0 text-sm">
        &copy; {{ date('Y') }} JUNES<a href="{{ route('pesanan.riwayat') }}" class="hover:text-blue-300 transition">.</a>
    </footer>

    @yield('scripts')

    @if($isHome)
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const navbar = document.getElementById('navbar');

                function handleScroll() {
                    if (window.scrollY > 50) {
                        navbar.classList.remove('bg-transparent');
                        navbar.classList.add('bg-slate-900', 'shadow-lg');
                    } else {
                        navbar.classList.remove('bg-slate-900', 'shadow-lg');
                        navbar.classList.add('bg-transparent');
                    }
                }

                handleScroll();
                window.addEventListener('scroll', handleScroll);
            });
        </script>
    @endif
</body>
</html>