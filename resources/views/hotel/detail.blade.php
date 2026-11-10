@extends('layouts.app')

@section('title', 'Detail Pemesanan - JUNES')

@section('content')
<style>
    nav, header, footer { display: none !important; }

    /* Struk hanya tampil saat dicetak */
    .struk-print { display: none; }

    @media print {
        @page { size: 80mm auto; margin: 4mm; }
        html, body { background: #fff !important; }
        .screen-only { display: none !important; }
        .struk-print { display: block !important; }
    }

    .struk-print {
        width: 72mm;
        margin: 0 auto;
        font-family: 'Courier New', Courier, monospace;
        font-size: 11px;
        line-height: 1.5;
        color: #000;
    }
    .struk-print .garis { border-top: 1px dashed #000; margin: 6px 0; }
    .struk-print .baris { display: flex; justify-content: space-between; gap: 8px; }
    .struk-print .baris span:last-child { text-align: right; }
</style>

{{-- ================= TAMPILAN LAYAR ================= --}}
<div class="screen-only min-h-screen bg-slate-50 py-12 px-4 sm:px-6 lg:px-8">
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

                <button type="button" onclick="window.print()"
                        class="w-full sm:w-auto inline-flex justify-center items-center gap-2 px-6 py-2.5 rounded-lg bg-amber-500 text-white font-medium text-sm hover:bg-amber-600 transition shadow-md hover:shadow-lg">
                    <i class="fa-solid fa-print"></i>
                    Cetak Struk
                </button>

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

{{-- ================= STRUK (hanya muncul saat dicetak) ================= --}}
<div class="struk-print">
    <div style="text-align:center">
        <strong style="font-size:15px; letter-spacing:2px">HOTEL JUNES</strong><br>
        Jl. Raya Pajajaran No. 88<br>
        Bogor, Jawa Barat<br>
        info@junes.co.id
    </div>

    <div class="garis"></div>

    <div style="text-align:center"><strong>STRUK PEMESANAN</strong></div>
    <div class="baris"><span>No.</span><span>INV-{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</span></div>
    <div class="baris"><span>Tanggal</span><span>{{ \Carbon\Carbon::parse($pemesanan->created_at)->format('d/m/Y H:i') }}</span></div>

    <div class="garis"></div>

    <div class="baris"><span>Nama</span><span>{{ $pemesanan->nama_pemesan }}</span></div>
    <div class="baris"><span>Jenis Kelamin</span><span>{{ $pemesanan->jenis_kelamin }}</span></div>
    <div class="baris"><span>No. Identitas</span><span>{{ \Illuminate\Support\Str::mask($pemesanan->nomor_identitas, '*', 0, -4) }}</span></div>

    <div class="garis"></div>

    <div class="baris"><span>Tipe Kamar</span><span>{{ $pemesanan->tipe_kamar }}</span></div>
    <div class="baris"><span>Check-in</span><span>{{ \Carbon\Carbon::parse($pemesanan->tanggal_pesan)->format('d/m/Y') }}</span></div>
    <div class="baris"><span>Durasi</span><span>{{ $pemesanan->durasi_menginap }} malam</span></div>
    <div class="baris"><span>Sarapan</span><span>{{ $pemesanan->termasuk_breakfast ? 'Termasuk' : 'Tidak' }}</span></div>
    @if($pemesanan->discount > 0)
        <div class="baris"><span>Diskon</span><span>{{ $pemesanan->discount }}%</span></div>
    @endif

    <div class="garis"></div>

    <div class="baris" style="font-size:13px">
        <strong>TOTAL</strong>
        <strong>Rp {{ number_format($pemesanan->total_bayar, 0, ',', '.') }}</strong>
    </div>

    <div class="garis"></div>

    <div style="text-align:center">
        Terima kasih atas kepercayaan Anda.<br>
        Tunjukkan struk ini saat check-in<br>
        di resepsionis.<br>
        Sugeng Rawuh!
    </div>
</div>
@endsection