@extends('layouts.app')

@section('title', 'Beranda - JUNES')

@section('content')

    {{-- ============================================================= --}}
    {{-- ===== HERO SECTION (full image + headline + search bar) ===== --}}
    {{-- ============================================================= --}}
    <section class="relative h-[650px] md:h-[720px] w-full overflow-hidden">
        {{-- Background image hero --}}
        <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=1600&q=80"
             alt="JUNES" class="absolute inset-0 w-full h-full object-cover">
        {{-- Overlay gelap agar teks terbaca --}}
        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 via-slate-900/30 to-slate-900/40"></div>

        {{-- Thumbnail kolase kecil kanan atas (seperti referensi) --}}
        <div class="hidden lg:grid grid-cols-2 gap-2 absolute top-28 right-10 z-10 w-64">
            <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=300&q=80" class="rounded shadow-lg h-24 w-full object-cover col-span-2">
            <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=300&q=80" class="rounded shadow-lg h-24 w-full object-cover">
            <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=300&q=80" class="rounded shadow-lg h-24 w-full object-cover">
        </div>

        {{-- Konten Headline --}}
        <div class="relative z-10 max-w-7xl mx-auto px-6 h-full flex flex-col justify-center">

            {{-- Eyebrow: garis memanjang + label --}}
            <div class="hero-fade flex items-center gap-3 mb-5" style="animation-delay:.1s">
                <span class="hero-line"></span>
                <span class="text-amber-300 text-xs uppercase tracking-[0.35em]">Hotel JUNES</span>
            </div>

            {{-- Headline: tiap baris naik dari balik masker --}}
            <h1 class="font-serif-elegant text-white leading-tight mb-6">
                <span class="hero-mask block text-5xl md:text-7xl">
                    <span class="hero-rise" style="animation-delay:.3s">Selamat Datang</span>
                </span>
                <span class="hero-mask block text-4xl md:text-6xl mt-1">
                    <span class="hero-rise" style="animation-delay:.65s">
                        <span class="hero-shimmer italic">Sugeng Rawuh</span>
                    </span>
                </span>
            </h1>

            <p class="hero-fade text-white/90 max-w-md mb-8 text-sm leading-relaxed" style="animation-delay:1s">
                Hotel kami hadir sebagai destinasi menginap modern dengan desain elegan,
                pelayanan hangat, dan pengalaman menginap yang autentik bagi setiap tamu.
            </p>

            <a href="#tentang"
            class="hero-fade inline-block border border-white text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full hover:bg-white hover:text-slate-900 transition w-fit"
            style="animation-delay:1.25s">
                Info Selengkapnya
            </a>
        </div>

        <style>
            .hero-mask { overflow: hidden; padding-bottom: .15em; }
            .hero-rise {
                display: inline-block;
                transform: translateY(110%);
                opacity: 0;
                animation: heroRise 1s cubic-bezier(.2, .8, .2, 1) forwards;
            }
            @keyframes heroRise { to { transform: translateY(0); opacity: 1; } }

            .hero-fade {
                opacity: 0;
                transform: translateY(16px);
                animation: heroFade .9s ease forwards;
            }
            @keyframes heroFade { to { opacity: 1; transform: none; } }

            .hero-line {
                display: block;
                height: 1px;
                width: 0;
                background: #fcd34d;
                animation: heroLine .9s ease .2s forwards;
            }
            @keyframes heroLine { to { width: 3.5rem; } }

            .hero-shimmer {
                display: inline-block;
                padding-right: .12em;
                padding-bottom: .12em;
                background: linear-gradient(90deg, #fde68a, #ffffff, #fbbf24, #ffffff, #fde68a);
                background-size: 200% auto;
                -webkit-background-clip: text;
                background-clip: text;
                color: transparent;
                animation: heroShimmer 5s linear 1.6s infinite;
            }
            @keyframes heroShimmer { to { background-position: 200% center; } }

            /* Hormati pengguna yang mematikan animasi */
            @media (prefers-reduced-motion: reduce) {
                .hero-rise, .hero-fade, .hero-shimmer { animation: none; opacity: 1; transform: none; }
                .hero-line { animation: none; width: 3.5rem; }
            }
        </style>

        {{-- ===== SEARCH BAR OVERLAY (mengambang di bawah hero) ===== --}}
        {{-- <div class="absolute bottom-0 left-0 w-full z-20">
            <form action="{{ route('pesanan.create') }}" method="GET"
                class="max-w-7xl mx-auto flex flex-col md:flex-row bg-slate-900/95 text-white">

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Check-in</label>
                    <input type="date" name="tanggal_pesan" id="search_checkin" required
                        value="{{ request('tanggal_pesan', date('Y-m-d')) }}"
                        class="bg-transparent outline-none text-sm w-full placeholder-white/50 text-white cursor-pointer">
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Check-out</label>
                    <input type="date" name="tanggal_checkout" id="search_checkout" required
                        value="{{ request('tanggal_checkout') }}"
                        class="bg-transparent outline-none text-sm w-full placeholder-white/50 text-white cursor-pointer">
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Dewasa</label>
                    <select name="dewasa" class="bg-transparent outline-none text-sm w-full text-white cursor-pointer">
                        <option value="1" {{ request('dewasa') == 1 ? 'selected' : '' }} class="text-slate-900">1 Orang</option>
                        <option value="2" {{ request('dewasa') == 2 ? 'selected' : '' }} class="text-slate-900">2 Orang</option>
                        <option value="3" {{ request('dewasa') == 3 ? 'selected' : '' }} class="text-slate-900">3 Orang</option>
                    </select>
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Anak</label>
                    <select name="anak" class="bg-transparent outline-none text-sm w-full text-white cursor-pointer">
                        <option value="0" {{ request('anak') == 0 ? 'selected' : '' }} class="text-slate-900">0 Anak</option>
                        <option value="1" {{ request('anak') == 1 ? 'selected' : '' }} class="text-slate-900">1 Anak</option>
                        <option value="2" {{ request('anak') == 2 ? 'selected' : '' }} class="text-slate-900">2 Anak</option>
                    </select>
                </div>

                <button type="submit"
                        class="bg-sky-500 hover:bg-sky-600 transition text-white uppercase text-sm tracking-widest px-10 py-5 font-medium flex items-center justify-center">
                    Cari Kamar
                </button>
            </form>
        </div> --}}
    </section>

    {{-- ============================================================= --}}
    {{-- ===== TENTANG KAMI & KONTAK (digabung) ===== --}}
    {{-- ============================================================= --}}
    <section id="tentang" class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        {{-- Kolase foto --}}
        <div class="relative h-[480px]">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80"
                 class="absolute top-0 left-0 w-3/5 h-64 object-cover rounded shadow-lg" alt="Kolam renang hotel">
            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=500&q=80"
                 class="absolute bottom-0 right-0 w-3/5 h-64 object-cover rounded shadow-lg border-4 border-white" alt="Pemandangan hotel">
            <div class="absolute bottom-6 left-0 bg-amber-500 text-white rounded-2xl shadow-lg p-5 w-40 text-center">
                <p class="text-3xl font-serif-elegant">16</p>
                <p class="text-xs uppercase tracking-widest mt-1">Tahun Melayani Tamu</p>
            </div>
        </div>

        {{-- Teks tentang kami + kontak --}}
        <div>
            <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-2">Kenyamanan Kelas Atas</p>
            <h2 class="font-serif-elegant text-3xl md:text-4xl text-slate-800 mb-4">Selamat Datang di JUNES</h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                JUNES adalah hotel bintang lima yang berlokasi strategis di pusat kota,
                menawarkan perpaduan kenyamanan, keindahan, dan pelayanan ramah
                untuk kebutuhan bisnis maupun liburan Anda.
            </p>
            <p class="text-gray-600 text-sm leading-relaxed mb-8">
                Kamar-kamar kami tersedia dalam tiga tipe pilihan: Standar, Deluxe, dan Executive,
                masing-masing dirancang untuk memberikan pengalaman menginap terbaik bagi setiap tamu.
            </p>

            {{-- Info kontak --}}
            <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-3">Hubungi Kami</p>
            <div class="space-y-3 mb-8">
                <div class="flex items-start gap-4 bg-white rounded-lg shadow-sm p-4">
                    <div class="p-2 bg-sky-50 rounded-lg text-sky-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-sm text-slate-800">Alamat</p>
                        <p class="text-sm text-gray-500">10 Bayfront Avenue, Singapura 018956 (Marina Bay).</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 bg-white rounded-lg shadow-sm p-4">
                    <div class="p-2 bg-sky-50 rounded-lg text-sky-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-sm text-slate-800">Telepon</p>
                        <p class="text-sm text-gray-500">+65 6688 8868</p>
                    </div>
                </div>
                <div class="flex items-start gap-4 bg-white rounded-lg shadow-sm p-4">
                    <div class="p-2 bg-sky-50 rounded-lg text-sky-600 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    </div>
                    <div>
                        <p class="font-semibold text-sm text-slate-800">Email</p>
                        <p class="text-sm text-gray-500">info@junes.co.id</p>
                    </div>
                </div>
            </div>

            <a href="#produk"
               class="inline-block bg-amber-500 hover:bg-amber-600 transition text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full">
                Lihat Kamar
            </a>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- ===== AMENITIES SECTION (gambar kiri, box gelap kanan) ===== --}}
    {{-- ============================================================= --}}
    <section class="grid grid-cols-1 md:grid-cols-2">
        <div class="h-96 md:h-[480px]">
            <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?auto=format&fit=crop&w=1000&q=80"
                 class="w-full h-full object-cover" alt="Kolam infinity hotel">
        </div>

        <div class="bg-sky-700 text-white h-96 md:h-[480px] flex flex-col justify-center px-10 md:px-16 py-10">
            <h3 class="font-serif-elegant text-3xl mb-4">Fasilitas Kami</h3>
            <p class="text-white/85 text-sm leading-relaxed mb-6">
                Hotel kami dilengkapi berbagai fasilitas penunjang kenyamanan tamu,
                mulai dari area rekreasi hingga layanan bisnis.
            </p>
            <div class="grid grid-cols-2 gap-y-3 text-sm">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 6a2 2 0 100-4 2 2 0 000 4zm-7.5 4.5L12 8l4.5 2.5M2 17c2.5 0 3.5-2 6-2s3.5 2 6 2 3.5-2 6-2M2 21c2.5 0 3.5-2 6-2s3.5 2 6 2 3.5-2 6-2"/></svg>
                    <span>Kolam Renang</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M6.5 6.5h-1a2 2 0 00-2 2v7a2 2 0 002 2h1m11-11h1a2 2 0 012 2v7a2 2 0 01-2 2h-1M6.5 5v14M17.5 5v14M9.5 9v6M14.5 9v6M9.5 12h5"/></svg>
                    <span>Gym & Yoga</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 2c-.8 1.2-1.5 2.5-1.5 3.5A1.5 1.5 0 0012 7a1.5 1.5 0 001.5-1.5C13.5 4.5 12.8 3.2 12 2zM7 10h10v11H7V10z"/></svg>
                    <span>Spa & Pijat</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3 15a4 4 0 004 4h10a4 4 0 004-4M3 15l2-8h14l2 8M3 15h18M9 11h6"/></svg>
                    <span>Wisata Perahu</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                    <span>Kursus Selancar</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5m0 0h4m-4 0V11m0 0V8m0 3h4m-4 0H9"/></svg>
                    <span>Ruang Konferensi</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M2 20c4-4 8-1 12-4s4-8 8-8c0 5-3 8-7 10s-7 1-13 2z"/></svg>
                    <span>Diving & Snorkeling</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-2.25l-1.591 1.591M5.25 12H3m.386-6.364l1.591 1.591M12 15a3 3 0 100-6 3 3 0 000 6z"/></svg>
                    <span>Pantai Pribadi</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- ===== SECTION PRODUK / JENIS KAMAR ===== --}}
    {{-- ============================================================= --}}
    <section id="produk" class="max-w-7xl mx-auto px-6 py-20">
        <div class="text-center mb-12">
            <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-2">Pilihan Menginap</p>
            <h2 class="font-serif-elegant text-3xl md:text-4xl text-slate-800">Kamar & Harga</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Kamar Standar --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group flex flex-col">
                <button type="button" onclick="openRoom('standar')" class="text-left overflow-hidden relative block" aria-label="Lihat detail Kamar Standar">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80"
                        alt="Kamar Standar" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </button>
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-amber-400 text-sm mb-1" aria-label="1 dari 3 bintang">★<span class="text-gray-300">★★</span></div>
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Standar</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar nyaman dengan fasilitas dasar, cocok untuk perjalanan singkat.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• 1 Kasur Queen</li>
                        <li>• AC & TV</li>
                        <li>• Kamar mandi dalam</li>
                    </ul>
                    <p class="font-semibold text-sky-700 mb-4">Rp 500.000 <span class="text-gray-400 font-normal">/ malam</span></p>
                    <button type="button" onclick="openRoom('standar')"
                            class="mt-auto w-full border border-sky-600 text-sky-700 hover:bg-sky-600 hover:text-white transition text-xs uppercase tracking-widest py-3 rounded-full">
                        Lihat Detail Kamar
                    </button>
                </div>
            </div>

            {{-- Kamar Deluxe --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group flex flex-col">
                <button type="button" onclick="openRoom('deluxe')" class="text-left overflow-hidden relative block" aria-label="Lihat detail Kamar Deluxe">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80"
                        alt="Kamar Deluxe" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </button>
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-amber-400 text-sm mb-1" aria-label="2 dari 3 bintang">★★<span class="text-gray-300">★</span></div>
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Deluxe</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar lebih luas dengan pemandangan kota dan fasilitas tambahan.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• 1 Kasur King</li>
                        <li>• AC, TV, Minibar</li>
                        <li>• Balkon pribadi</li>
                    </ul>
                    <p class="font-semibold text-sky-700 mb-4">Rp 800.000 <span class="text-gray-400 font-normal">/ malam</span></p>
                    <button type="button" onclick="openRoom('deluxe')"
                            class="mt-auto w-full border border-sky-600 text-sky-700 hover:bg-sky-600 hover:text-white transition text-xs uppercase tracking-widest py-3 rounded-full">
                        Lihat Detail Kamar
                    </button>
                </div>
            </div>

            {{-- Kamar Executive --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group flex flex-col">
                <button type="button" onclick="openRoom('executive')" class="text-left overflow-hidden relative block" aria-label="Lihat detail Kamar Executive">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80"
                        alt="Kamar Executive" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </button>
                <div class="p-6 flex flex-col flex-1">
                    <div class="text-amber-400 text-sm mb-1" aria-label="3 dari 3 bintang">★★★</div>
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Executive</h3>
                    <p class="text-sm text-gray-600 mb-3">Suite mewah dengan ruang tamu terpisah dan layanan premium.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• Ruang tamu terpisah</li>
                        <li>• Bathtub & shower</li>
                        <li>• Akses lounge eksekutif</li>
                    </ul>
                    <p class="font-semibold text-sky-700 mb-4">Rp 1.200.000 <span class="text-gray-400 font-normal">/ malam</span></p>
                    <button type="button" onclick="openRoom('executive')"
                            class="mt-auto w-full border border-sky-600 text-sky-700 hover:bg-sky-600 hover:text-white transition text-xs uppercase tracking-widest py-3 rounded-full">
                        Lihat Detail Kamar
                    </button>
                </div>
            </div>
        </div>

        {{-- ============================================================= --}}
        {{-- ===== GALERI FOTO KAMAR ===== --}}
        {{-- ============================================================= --}}
        <div class="mt-20">
            <div class="text-center mb-10">
                <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-2">Jelajahi Setiap Sudut</p>
                <h3 class="font-serif-elegant text-3xl text-slate-800">Galeri Foto Kamar</h3>
            </div>

            {{-- Layout mosaic: 1 foto besar + beberapa foto kecil, meniru gaya galeri resort --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-3 auto-rows-[160px]">
                <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=700&q=80"
                     class="col-span-2 row-span-2 w-full h-full object-cover rounded-lg shadow-md hover:opacity-90 transition" alt="Kamar Deluxe tampak dalam">
                <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=400&q=80"
                     class="w-full h-full object-cover rounded-lg shadow-md hover:opacity-90 transition" alt="Kamar Standar">
                <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=400&q=80"
                     class="w-full h-full object-cover rounded-lg shadow-md hover:opacity-90 transition" alt="Kamar Executive">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=400&q=80"
                     class="w-full h-full object-cover rounded-lg shadow-md hover:opacity-90 transition" alt="Kamar mandi hotel">
                <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?auto=format&fit=crop&w=400&q=80"
                     class="w-full h-full object-cover rounded-lg shadow-md hover:opacity-90 transition" alt="Suasana balkon kamar">
            </div>
        </div>

        {{-- ============================================================= --}}
        {{-- ===== VIDEO TOUR HOTEL ===== --}}
        {{-- ============================================================= --}}
        <div class="mt-20 bg-slate-900 rounded-2xl overflow-hidden md:grid md:grid-cols-2 items-center shadow-xl">
            {{-- Kolom teks --}}
            <div class="p-10 md:p-14 text-white">
                <p class="text-sky-400 text-xs uppercase tracking-widest font-semibold mb-2">Rasakan Suasananya</p>
                <h3 class="font-serif-elegant text-3xl mb-4">Video Tour Hotel</h3>
                <p class="text-white/70 text-sm leading-relaxed mb-6">
                    Saksikan keindahan setiap sudut JUNES — dari kenyamanan kamar,
                    kolam renang, hingga pemandangan matahari terbenam yang memukau.
                </p>
                <a href="#produk"
                   class="inline-block border border-white/60 text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full hover:bg-white hover:text-slate-900 transition">
                    Lihat Kamar Kami
                </a>
            </div>

            {{-- Kolom video --}}
            <div class="aspect-video">
                <iframe class="w-full h-full"
                        src="https://www.youtube.com/embed/n6ri-KvuwIo"
                        title="Video Tour JUNES" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    {{-- ===== TOMBOL SCROLL TO TOP ===== --}}
    <a href="#" 
       class="fixed bottom-6 right-6 bg-amber-500 hover:bg-amber-600 text-white p-3 rounded-full shadow-lg transition-all duration-300 z-50 flex items-center justify-center hover:scale-110"
       title="Kembali ke atas">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"/>
        </svg>
    </a>


    {{-- ===== MODAL PREVIEW KAMAR ===== --}}
    <div id="roomModal" class="fixed inset-0 z-[60] hidden" role="dialog" aria-modal="true" aria-labelledby="rm-name">
        <div class="absolute inset-0 bg-slate-900/80 backdrop-blur-sm" onclick="closeRoom()"></div>

        <div class="relative h-full overflow-y-auto flex items-start md:items-center justify-center p-4">
            <div class="relative bg-white rounded-2xl shadow-2xl w-full max-w-5xl overflow-hidden md:grid md:grid-cols-2 my-4">

                <button type="button" onclick="closeRoom()" aria-label="Tutup"
                        class="absolute top-3 right-3 z-10 bg-white/90 hover:bg-white text-slate-700 w-9 h-9 rounded-full shadow flex items-center justify-center text-xl leading-none">&times;</button>

                {{-- Galeri --}}
                <div class="bg-slate-100">
                    <div class="relative">
                        <img id="rm-main" src="" alt="" class="w-full h-64 md:h-[420px] object-cover">
                        <button type="button" onclick="stepRoomImg(-1)" aria-label="Foto sebelumnya"
                                class="absolute left-3 top-1/2 -translate-y-1/2 bg-white/85 hover:bg-white w-9 h-9 rounded-full shadow flex items-center justify-center">‹</button>
                        <button type="button" onclick="stepRoomImg(1)" aria-label="Foto berikutnya"
                                class="absolute right-3 top-1/2 -translate-y-1/2 bg-white/85 hover:bg-white w-9 h-9 rounded-full shadow flex items-center justify-center">›</button>
                        <span id="rm-badge" class="absolute bottom-3 left-3 text-white text-[10px] uppercase tracking-widest px-3 py-1 rounded-full"></span>
                    </div>
                    <div id="rm-thumbs" class="grid grid-cols-4 gap-2 p-3"></div>
                </div>

                {{-- Detail --}}
                <div class="p-6 md:p-8 md:max-h-[640px] md:overflow-y-auto">
                    <div id="rm-stars" class="text-amber-400 text-lg mb-1"></div>
                    <h3 id="rm-name" class="font-serif-elegant text-3xl text-slate-800 mb-2"></h3>
                    <p id="rm-desc" class="text-sm text-gray-600 leading-relaxed mb-5"></p>

                    {{-- Spesifikasi singkat --}}
                    <div id="rm-specs" class="grid grid-cols-2 gap-3 mb-6"></div>

                    {{-- Fasilitas --}}
                    <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-3">Isi & Fasilitas Kamar</p>
                    <ul id="rm-features" class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-2 text-sm mb-6"></ul>

                    {{-- Harga + CTA --}}
                    <div class="flex items-center justify-between gap-4 border-t pt-5">
                        <div>
                            <p class="text-xs text-gray-400">Mulai dari</p>
                            <p class="font-semibold text-2xl text-sky-700"><span id="rm-price"></span> <span class="text-sm text-gray-400 font-normal">/ malam</span></p>
                        </div>
                        <a id="rm-book" href="#"
                        class="bg-amber-500 hover:bg-amber-600 transition text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full whitespace-nowrap">
                            Pesan Kamar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            const U = (id, w = 900) => `https://images.unsplash.com/${id}?auto=format&fit=crop&w=${w}&q=80`;

            // Daftar fasilitas pembanding: tipe yang lebih mahal punya lebih banyak (on = true)
            const feat = (on) => [
                ['Wi-Fi gratis',                  on[0]],
                ['AC',                            on[1]],
                ['Kamar mandi dalam + shower',    on[2]],
                ['Perlengkapan mandi (amenities)',on[3]],
                ['Safe box',                      on[4]],
                ['Minibar',                       on[5]],
                ['Mesin kopi & teh',              on[6]],
                ['Balkon pribadi',                on[7]],
                ['Bathtub',                       on[8]],
                ['Ruang tamu terpisah',           on[9]],
                ['Sarapan untuk 2 orang',         on[10]],
                ['Akses lounge eksekutif',        on[11]],
                ['Butler & layanan kamar 24 jam', on[12]],
                ['Antar-jemput bandara',          on[13]],
            ];

            const ROOMS = {
                standar: {
                    name: 'Kamar Standar', stars: 1, price: 'Rp 500.000', badge: 'Hemat', badgeCls: 'bg-slate-500',
                    desc: 'Kamar ringkas dan bersih dengan fasilitas dasar yang lengkap — pilihan pas untuk perjalanan singkat atau menginap semalam.',
                    specs: [['Ukuran', '24 m²'], ['Tempat tidur', '1 Queen'], ['Kapasitas', '2 orang'], ['Pemandangan', 'Halaman hotel']],
                    tv: 'TV LED 32"',
                    features: feat([1,1,1,1,0,0,0,0,0,0,0,0,0,0]),
                    images: [U('photo-1590490360182-c33d57733427'), U('photo-1566073771259-6a8506099945'), U('photo-1520250497591-112f2f40a3f4'), U('photo-1571003123894-1f0594d2b5d9')]
                },
                deluxe: {
                    name: 'Kamar Deluxe', stars: 2, price: 'Rp 800.000', badge: 'Populer', badgeCls: 'bg-sky-600',
                    desc: 'Kamar lebih luas dengan kasur king, balkon pribadi, dan pemandangan kota. Dilengkapi minibar dan sarapan untuk kenyamanan ekstra.',
                    specs: [['Ukuran', '36 m²'], ['Tempat tidur', '1 King'], ['Kapasitas', '3 orang'], ['Pemandangan', 'Kota']],
                    tv: 'Smart TV 43"',
                    features: feat([1,1,1,1,1,1,1,1,0,0,1,0,0,0]),
                    images: [U('photo-1611892440504-42a792e24d32'), U('photo-1590490360182-c33d57733427'), U('photo-1566073771259-6a8506099945'), U('photo-1520250497591-112f2f40a3f4')]
                },
                executive: {
                    name: 'Kamar Executive', stars: 3, price: 'Rp 1.200.000', badge: 'Terbaik', badgeCls: 'bg-amber-500',
                    desc: 'Suite mewah dengan ruang tamu terpisah, bathtub, dan akses lounge eksekutif. Dilayani butler pribadi serta antar-jemput bandara untuk pengalaman menginap kelas atas.',
                    specs: [['Ukuran', '60 m²'], ['Tempat tidur', '1 King Premium'], ['Kapasitas', '4 orang'], ['Pemandangan', 'Panorama kota']],
                    tv: 'Smart TV 55" + sound bar',
                    features: feat([1,1,1,1,1,1,1,1,1,1,1,1,1,1]),
                    images: [U('photo-1582719508461-905c673771fd'), U('photo-1611892440504-42a792e24d32'), U('photo-1571896349842-33c89424de2d'), U('photo-1566073771259-6a8506099945')]
                }
            };

            const CHECK = '<svg class="w-4 h-4 text-emerald-500 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>';
            const CROSS = '<svg class="w-4 h-4 text-gray-300 shrink-0" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>';

            const el = (id) => document.getElementById(id);
            let current = null, idx = 0;

            function showImg(i) {
                const r = ROOMS[current];
                idx = (i + r.images.length) % r.images.length;
                const main = el('rm-main');
                main.src = r.images[idx];
                main.alt = r.name + ' — foto ' + (idx + 1);
                el('rm-thumbs').querySelectorAll('button').forEach((b, n) => {
                    b.classList.toggle('ring-2', n === idx);
                    b.classList.toggle('ring-sky-500', n === idx);
                    b.classList.toggle('opacity-60', n !== idx);
                });
            }

            window.stepRoomImg = (d) => showImg(idx + d);

            window.openRoom = function (key) {
                const r = ROOMS[key];
                if (!r) return;
                current = key;

                el('rm-name').textContent = r.name;
                el('rm-desc').textContent = r.desc;
                el('rm-price').textContent = r.price;
                el('rm-stars').innerHTML = '★'.repeat(r.stars) + '<span class="text-gray-300">' + '★'.repeat(3 - r.stars) + '</span>';

                const badge = el('rm-badge');
                badge.textContent = r.badge;
                badge.className = 'absolute bottom-3 left-3 text-white text-[10px] uppercase tracking-widest px-3 py-1 rounded-full ' + r.badgeCls;

                el('rm-specs').innerHTML = r.specs.map(s =>
                    `<div class="bg-slate-50 rounded-lg px-4 py-3"><p class="text-[10px] uppercase tracking-widest text-gray-400">${s[0]}</p><p class="text-sm font-semibold text-slate-800">${s[1]}</p></div>`
                ).join('');

                // TV ditampilkan sebagai fasilitas pertama (ukuran naik sesuai tipe)
                const rows = [[r.tv, true]].concat(r.features);
                el('rm-features').innerHTML = rows.map(f =>
                    `<li class="flex items-center gap-2 ${f[1] ? 'text-slate-700' : 'text-gray-400 line-through'}">${f[1] ? CHECK : CROSS}<span>${f[0]}</span></li>`
                ).join('');

                el('rm-thumbs').innerHTML = r.images.map((src, n) =>
                    `<button type="button" onclick="showRoomImg(${n})" class="overflow-hidden rounded-lg"><img src="${src.replace('w=900', 'w=240')}" alt="" class="w-full h-16 object-cover"></button>`
                ).join('');

                el('rm-book').href = "{{ route('pesanan.create') }}?tipe=" + key;

                showImg(0);
                el('roomModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            };

            window.showRoomImg = showImg;

            window.closeRoom = function () {
                el('roomModal').classList.add('hidden');
                document.body.style.overflow = '';
            };

            document.addEventListener('keydown', (e) => {
                if (el('roomModal').classList.contains('hidden')) return;
                if (e.key === 'Escape') closeRoom();
                if (e.key === 'ArrowLeft') stepRoomImg(-1);
                if (e.key === 'ArrowRight') stepRoomImg(1);
            });
        })();
    </script>


@endsection