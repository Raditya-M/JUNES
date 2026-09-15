{{--
    File         : riwayat.blade.php
    Deskripsi    : Halaman menampilkan seluruh riwayat data pemesanan
                   dengan tampilan kartu elegan, senada tema resort hotel.
    Initial State: Belum ada rekap data pemesanan yang ditampilkan
    Final State  : Seluruh data pemesanan ditampilkan dalam bentuk tabel/kartu
    Author       : Junior Web Developer
    Versi/Tanggal: v2.0 / 2026-09-15
--}}
@extends('layouts.app')

@section('title', 'Riwayat Pemesanan')

@section('content')

    {{-- ===== HEADER HALAMAN (banner gelap, konsisten dengan tema) ===== --}}
    <section class="bg-slate-900 py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-sky-400 text-xs uppercase tracking-widest font-semibold mb-2">Rekap Transaksi</p>
            <h1 class="font-serif-elegant text-4xl text-white">Riwayat Pemesanan</h1>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-14">

        @if($daftarPesanan->isEmpty())
            {{-- Tampilan kosong yang lebih ramah --}}
            <div class="bg-white rounded-2xl shadow p-14 text-center">
                <p class="text-5xl mb-4">🗂️</p>
                <p class="text-gray-500 mb-6">Belum ada data pemesanan yang tercatat.</p>
                <a href="{{ route('pesanan.create') }}"
                   class="inline-block bg-amber-500 hover:bg-amber-600 transition text-white text-xs uppercase tracking-widest px-6 py-3 rounded-full">
                    Pesan Kamar Sekarang
                </a>
            </div>
        @else
            <div class="overflow-x-auto bg-white rounded-2xl shadow-md">
                <table class="min-w-full text-sm">
                    <thead class="bg-slate-900 text-white">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">Nama Pemesan</th>
                            <th class="py-4 px-6 text-left font-medium">Tipe Kamar</th>
                            <th class="py-4 px-6 text-left font-medium">Tanggal</th>
                            <th class="py-4 px-6 text-left font-medium">Durasi</th>
                            <th class="py-4 px-6 text-left font-medium">Breakfast</th>
                            <th class="py-4 px-6 text-left font-medium">Total Bayar</th>
                            <th class="py-4 px-6 text-left font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($daftarPesanan as $pesanan)
                            <tr class="hover:bg-sky-50 transition">
                                <td class="py-4 px-6 font-medium text-slate-800">{{ $pesanan->nama_pemesan }}</td>
                                <td class="py-4 px-6">
                                    {{-- Badge warna berbeda per tipe kamar --}}
                                    <span class="inline-block text-xs px-3 py-1 rounded-full font-medium
                                        @if($pesanan->tipe_kamar === 'Standar') bg-gray-100 text-gray-600
                                        @elseif($pesanan->tipe_kamar === 'Deluxe') bg-sky-100 text-sky-700
                                        @else bg-amber-100 text-amber-700 @endif">
                                        {{ $pesanan->tipe_kamar }}
                                    </span>
                                </td>
                                <td class="py-4 px-6 text-gray-500">{{ $pesanan->tanggal_pesan->format('d/m/Y') }}</td>
                                <td class="py-4 px-6 text-gray-500">{{ $pesanan->durasi_menginap }} malam</td>
                                <td class="py-4 px-6">{{ $pesanan->termasuk_breakfast ? 'Ya' : '—' }}</td>
                                <td class="py-4 px-6 font-semibold text-sky-700">Rp {{ number_format($pesanan->total_bayar, 0, ',', '.') }}</td>
                                <td class="py-4 px-6">
                                    <a href="{{ route('pesanan.show', $pesanan->id) }}"
                                       class="text-sky-600 hover:text-sky-800 font-medium text-xs uppercase tracking-wide">
                                        Lihat Detail →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </section>

@endsection