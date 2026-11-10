@extends('layouts.app')

@section('title', 'Detail Pemesanan - JUNES')

@section('content')

@section('content')
<style>
    nav, header, footer { display: none !important; }
</style>

<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
<div class="min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        
        {{-- Header Status --}}
        <div class="text-center mb-8">
            <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-emerald-100 text-emerald-600 mb-4 shadow-sm">
                <i class="fa-solid fa-circle-check text-3xl"></i>
            </div>
            <h1 class="text-3xl font-serif-elegant font-bold text-slate-900 tracking-wide">
                Konfirmasi Pemesanan
            </h1>
            <p class="text-slate-500 text-sm mt-1">
                Terima kasih, pemesanan kamar Anda telah berhasil dicatat.
            </p>
        </div>

        {{-- Invoice Card --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-slate-100">
            
            {{-- Card Header --}}
            <div class="bg-slate-900 text-white px-8 py-6 flex flex-wrap justify-between items-center gap-4 border-b border-amber-500/30">
                <div>
                    <span class="text-amber-400 font-serif-elegant tracking-widest text-xs uppercase block">Ringkasan Reservasi</span>
                    <h2 class="text-xl font-semibold tracking-wide mt-0.5">Hotel JUNES</h2>
                </div>
                <div class="text-right">
                    <span class="text-xs text-slate-400 block uppercase tracking-wider">Tanggal Transaksi</span>
                    <span class="text-sm font-medium text-slate-200">
                        {{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d M Y, H:i') }}
                    </span>
                </div>
            </div>

            {{-- Card Body / Table Content --}}
            <div class="p-8 space-y-6">
                
                {{-- Detail Tamu --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 border-b border-slate-100 pb-2">
                        Data Pemesan
                    </h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <dt class="text-slate-500">Nama Pemesan</dt>
                            <dd class="font-semibold text-slate-800 text-base mt-0.5">{{ $pemesanan->nama_pemesan }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">Nomor Identitas (NIK/Passport)</dt>
                            <dd class="font-medium text-slate-800 mt-0.5 tracking-wide">{{ $pemesanan->nomor_identitas }}</dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">Jenis Kelamin</dt>
                            <dd class="font-medium text-slate-800 mt-0.5">{{ $pemesanan->jenis_kelamin }}</dd>
                        </div>
                    </dl>
                </div>

                {{-- Detail Reservasi Kamar --}}
                <div>
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3 border-b border-slate-100 pb-2">
                        Rincian Menginap
                    </h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <dt class="text-slate-500">Tipe Kamar</dt>
                            <dd class="font-semibold text-amber-700 mt-0.5 flex items-center gap-1.5">
                                <i class="fa-solid fa-bed text-amber-500"></i>
                                {{ $pemesanan->tipe_kamar }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">Tanggal Menginap</dt>
                            <dd class="font-medium text-slate-800 mt-0.5">
                                {{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d F Y') }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">Durasi Menginap</dt>
                            <dd class="font-medium text-slate-800 mt-0.5">
                                {{ $pemesanan->durasi_menginap }} Malam
                            </dd>
                        </div>
                        <div>
                            <dt class="text-slate-500">Layanan Sarapan (Breakfast)</dt>
                            <dd class="mt-0.5">
                                @if($pemesanan->termasuk_breakfast)
                                    <span class="inline-flex items-center gap-1 text-xs font-medium bg-emerald-50 text-emerald-700 px-2.5 py-1 rounded-full border border-emerald-200">
                                        <i class="fa-solid fa-utensils"></i> Termasuk
                                    </span>
                                @else
                                    <span class="inline-flex items-center text-xs font-medium bg-slate-100 text-slate-600 px-2.5 py-1 rounded-full">
                                        Tidak Termasuk
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                {{-- Rincian Pembayaran --}}
                <div class="bg-slate-50 rounded-xl p-5 border border-slate-200/80">
                    <h3 class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">
                        Rincian Biaya
                    </h3>
                    <div class="space-y-2 text-sm">
                        @if($pemesanan->discount > 0)
                            <div class="flex justify-between items-center text-slate-600">
                                <span>Potongan Diskon</span>
                                <span class="font-medium text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded text-xs">
                                    {{ $pemesanan->discount }}% OFF
                                </span>
                            </div>
                        @endif
                        <div class="flex justify-between items-center pt-3 border-t border-slate-200">
                            <span class="font-bold text-slate-900 text-base">Total Tagihan</span>
                            <span class="font-bold text-xl text-amber-600">
                                Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}
                            </span>
                        </div>
                    </div>
                </div>

            </div>

            {{-- Card Footer / Action Buttons --}}
            <div class="bg-slate-50 px-8 py-5 border-t border-slate-100 flex flex-col sm:flex-row gap-3 justify-center sm:justify-between items-center">
                <a href="{{ route('pesanan.create') }}"
                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 rounded-lg bg-slate-900 text-white font-medium text-sm hover:bg-slate-800 transition shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-plus text-amber-400"></i>
                    Pesan Kamar Lain
                </a>

                <a href="{{ route('home') }}"
                class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 rounded-lg bg-slate-900 text-white font-medium text-sm hover:bg-slate-800 transition shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-house text-amber-400"></i>
                    Kembali ke Beranda
                </a>
            </div>
        </div>

        {{-- Helper Note --}}
        <p class="text-center text-xs text-slate-400 mt-6">
            Simpan bukti pemesanan ini. Tunjukkan saat melakukan *check-in* di resepsionis.
        </p>

    </div>
</div>
@endsection