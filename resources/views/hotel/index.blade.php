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
            <h1 class="font-serif-elegant text-white text-5xl md:text-6xl mb-4">
                Selamat Datang.Sugeng Rawuh
            </h1>
            <p class="text-white/90 max-w-md mb-6 text-sm leading-relaxed">
                Hotel kami hadir sebagai destinasi menginap modern dengan desain elegan,
                pelayanan hangat, dan pengalaman menginap yang autentik bagi setiap tamu.
            </p>
            <a href="#tentang"
               class="inline-block border border-white text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full hover:bg-white hover:text-slate-900 transition w-fit">
                Info Selengkapnya
            </a>
        </div>

        {{-- ===== SEARCH BAR OVERLAY (mengambang di bawah hero) ===== --}}
        <div class="absolute bottom-0 left-0 w-full z-20">
            <form action="{{ route('pesanan.create') }}" method="GET"
                  class="max-w-7xl mx-auto flex flex-col md:flex-row bg-slate-900/95 text-white">

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Check-in</label>
                    <input type="date" class="bg-transparent outline-none text-sm w-full placeholder-white/50">
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Check-out</label>
                    <input type="date" class="bg-transparent outline-none text-sm w-full placeholder-white/50">
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Dewasa</label>
                    <select class="bg-transparent outline-none text-sm w-full text-white">
                        <option class="text-slate-900">1</option>
                        <option class="text-slate-900">2</option>
                        <option class="text-slate-900">3</option>
                    </select>
                </div>

                <div class="flex-1 px-6 py-5 border-b md:border-b-0 md:border-r border-white/20">
                    <label class="block text-xs uppercase tracking-wide text-white/60 mb-1">Anak</label>
                    <select class="bg-transparent outline-none text-sm w-full text-white">
                        <option class="text-slate-900">0</option>
                        <option class="text-slate-900">1</option>
                        <option class="text-slate-900">2</option>
                    </select>
                </div>

                <button type="submit"
                        class="bg-sky-500 hover:bg-sky-600 transition text-white uppercase text-sm tracking-widest px-10 py-5 font-medium">
                    Cari Kamar
                </button>
            </form>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- ===== WELCOME SECTION (kolase foto + teks) ===== --}}
    {{-- ============================================================= --}}
    <section id="tentang" class="max-w-7xl mx-auto px-6 py-20 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

        {{-- Kolase foto (mirip referensi: 2 foto bertumpuk) --}}
        <div class="relative h-[420px]">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?auto=format&fit=crop&w=500&q=80"
                 class="absolute top-0 left-0 w-3/5 h-56 object-cover rounded shadow-lg" alt="Kolam renang hotel">
            <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=500&q=80"
                 class="absolute bottom-0 right-0 w-3/5 h-56 object-cover rounded shadow-lg border-4 border-white" alt="Pemandangan hotel">
        </div>

        {{-- Teks Welcome --}}
        <div>
            <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-2">Kenyamanan Kelas Atas</p>
            <h2 class="font-serif-elegant text-3xl md:text-4xl text-slate-800 mb-4">Selamat Datang di JUNES</h2>
            <p class="text-gray-600 text-sm leading-relaxed mb-4">
                JUNES adalah pilihan tepat bagi pengunjung yang mencari perpaduan
                antara kenyamanan, keindahan, dan lokasi strategis untuk menjelajahi sekitarnya.
            </p>
            <p class="text-gray-600 text-sm leading-relaxed mb-6">
                Kamar-kamar kami tersedia dalam tiga tipe pilihan: Standar, Deluxe, dan Executive,
                masing-masing dirancang untuk memberikan pengalaman menginap terbaik bagi setiap tamu.
            </p>
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
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M14 10l-2 1m0 0l-2-1m2 1v2.5M20 7l-2 1m2-1l-2-1m2 1v2.5M14 4l-2 1m0 0L10 4m2 1v2.5M4 7l2-1m-2 1l2 1m-2-1v2.5M7 15l-2 1m2-1l-2-1m2 1v2.5M20 15l-2 1m2-1l-2-1m2 1v2.5M17 21l-2 1m2-1l-2-1m2 1v2.5M11 21l-2 1m2-1l-2-1m2 1v2.5"/></svg>
                    <span>Kolam Renang</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M3.75 13.5l10.5-10.5m0 0h-6.75m6.75 0v6.75M20.25 10.5L9.75 21m0 0h6.75M9.75 21v-6.75"/></svg>
                    <span>Gym & Yoga</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 21a9 9 0 100-18 9 9 0 000 18zM12 8v4l3 3"/></svg>
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
                    <svg class="w-5 h-5 text-sky-200 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9"/></svg>
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
            <h2 class="font-serif-elegant text-3xl md:text-4xl text-slate-800">Kamar & Suite</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

            {{-- Kamar Standar --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1590490360182-c33d57733427?auto=format&fit=crop&w=600&q=80"
                         alt="Kamar Standar" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Standar</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar nyaman dengan fasilitas dasar, cocok untuk perjalanan singkat.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• 1 Kasur Queen</li>
                        <li>• AC & TV</li>
                        <li>• Kamar mandi dalam</li>
                    </ul>
                    <p class="font-semibold text-sky-700">Rp 500.000 <span class="text-gray-400 font-normal">/ malam</span></p>
                </div>
            </div>

            {{-- Kamar Deluxe --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1611892440504-42a792e24d32?auto=format&fit=crop&w=600&q=80"
                         alt="Kamar Deluxe" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Deluxe</h3>
                    <p class="text-sm text-gray-600 mb-3">Kamar lebih luas dengan pemandangan kota dan fasilitas tambahan.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• 1 Kasur King</li>
                        <li>• AC, TV, Minibar</li>
                        <li>• Balkon pribadi</li>
                    </ul>
                    <p class="font-semibold text-sky-700">Rp 800.000 <span class="text-gray-400 font-normal">/ malam</span></p>
                </div>
            </div>

            {{-- Kamar Executive --}}
            <div class="bg-white rounded-lg shadow-md overflow-hidden group">
                <div class="overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1582719508461-905c673771fd?auto=format&fit=crop&w=600&q=80"
                         alt="Kamar Executive" class="w-full h-56 object-cover group-hover:scale-105 transition duration-500">
                </div>
                <div class="p-6">
                    <h3 class="font-serif-elegant text-xl mb-2">Kamar Executive</h3>
                    <p class="text-sm text-gray-600 mb-3">Suite mewah dengan ruang tamu terpisah dan layanan premium.</p>
                    <ul class="text-xs text-gray-500 space-y-1 mb-4">
                        <li>• Ruang tamu terpisah</li>
                        <li>• Bathtub & shower</li>
                        <li>• Akses lounge eksekutif</li>
                    </ul>
                    <p class="font-semibold text-sky-700">Rp 1.200.000 <span class="text-gray-400 font-normal">/ malam</span></p>
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
                        src="https://www.youtube.com/embed/dQw4w9WgXcQ"
                        title="Video Tour JUNES" allowfullscreen></iframe>
            </div>
        </div>
    </section>

    {{-- ============================================================= --}}
    {{-- ===== SECTION TENTANG KAMI / INFORMASI HOTEL ===== --}}
    {{-- ============================================================= --}}
    <section id="tentang-kami-detail" class="py-24 bg-slate-50">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-2 gap-12 items-center">

            {{-- Kolom foto --}}
            <div class="relative h-[420px]">
                <img src="https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?auto=format&fit=crop&w=700&q=80"
                    class="absolute top-0 left-0 w-4/5 h-4/5 object-cover rounded-2xl shadow-xl" alt="Tampak depan hotel">
                <div class="absolute bottom-0 right-0 bg-amber-500 text-white rounded-2xl shadow-lg p-6 w-48 text-center">
                    <p class="text-3xl font-serif-elegant">1</p>
                    <p class="text-xs uppercase tracking-widest mt-1">Hari Melayani Tamu</p>
                </div>
            </div>

            {{-- Kolom informasi --}}
            <div>
                <p class="text-sky-600 text-xs uppercase tracking-widest font-semibold mb-2">Hubungi Kami</p>
                <h2 class="font-serif-elegant text-3xl md:text-4xl text-slate-800 mb-4">Informasi Hotel</h2>
                <p class="text-gray-600 text-sm leading-relaxed mb-8">
                    JUNES adalah hotel bintang lima yang berlokasi strategis di pusat kota,
                    menawarkan kenyamanan menginap dengan pelayanan ramah dan fasilitas lengkap
                    untuk kebutuhan bisnis maupun liburan Anda.
                </p>

                {{-- Info kontak dengan ikon, gaya card ringan --}}
                <div class="space-y-4">
                    <div class="flex items-start gap-4 bg-white rounded-lg shadow-sm p-4">
                        <div class="p-2 bg-sky-50 rounded-lg text-sky-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-slate-800">Alamat</p>
                            <p class="text-sm text-gray-500">Jl. Raya Pajajaran No. 88, Bogor, Jawa Barat, Indonesia</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 bg-white rounded-lg shadow-sm p-4">
                        <div class="p-2 bg-sky-50 rounded-lg text-sky-600 shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <div>
                            <p class="font-semibold text-sm text-slate-800">Telepon</p>
                            <p class="text-sm text-gray-500">+34-666-9990023</p>
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

@endsection