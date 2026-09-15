{{--
    File         : pesan.blade.php
    Deskripsi    : Halaman form pemesanan kamar dengan tampilan card elegan
                   dua kolom (form + ringkasan biaya), validasi client-side JS
                   dan kalkulasi total bayar interaktif.
    Initial State: Form kosong, belum ada data yang diisi
    Final State  : Data pemesanan tervalidasi dan terkirim ke server via POST
    Author       : Junior Web Developer
    Versi/Tanggal: v2.0 / 2026-09-15
--}}
@extends('layouts.app')

@section('title', 'Pesan Kamar')

@section('content')

    {{-- ===== HEADER HALAMAN ===== --}}
    <section class="bg-slate-900 py-16">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <p class="text-sky-400 text-xs uppercase tracking-widest font-semibold mb-2">Reservasi</p>
            <h1 class="font-serif-elegant text-4xl text-white">Form Pemesanan Kamar</h1>
            <p class="text-white/50 text-sm mt-3">Lengkapi data di bawah ini untuk menyelesaikan pemesanan Anda</p>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-6 py-14">

        {{-- ===== ERROR VALIDASI SERVER-SIDE ===== --}}
        @if($errors->any())
            <div class="bg-red-50 border border-red-300 text-red-700 px-5 py-4 rounded-xl mb-8">
                <strong class="text-sm">Terdapat kesalahan input:</strong>
                <ul class="list-disc list-inside mt-1 text-sm">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- ===== KOLOM FORM (2/3 lebar) ===== --}}
            <form id="formPemesanan" action="{{ route('pesanan.store') }}" method="POST"
                  class="lg:col-span-2 bg-white rounded-2xl shadow-md p-8 space-y-5" onsubmit="return validasiForm()">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    {{-- NAMA PEMESAN --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Nama Pemesan</label>
                        <input type="text" name="nama_pemesan" id="nama_pemesan" required
                               value="{{ old('nama_pemesan') }}" placeholder="Masukkan nama lengkap"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent">
                    </div>

                    {{-- JENIS KELAMIN --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Jenis Kelamin</label>
                        <div class="flex gap-6 pt-2">
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="jenis_kelamin" value="Laki-laki" required
                                       class="accent-sky-600" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }}> Laki-laki
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input type="radio" name="jenis_kelamin" value="Perempuan"
                                       class="accent-sky-600" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }}> Perempuan
                            </label>
                        </div>
                    </div>

                    {{-- NOMOR IDENTITAS --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Nomor Identitas (KTP)</label>
                        <input type="text" name="nomor_identitas" id="nomor_identitas" maxlength="16"
                               value="{{ old('nomor_identitas') }}" required placeholder="16 digit angka"
                               oninput="cekNomorIdentitas()"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent">
                        <p id="errorIdentitas" class="text-red-600 text-xs mt-1 hidden">isian salah..data harus 16 digit</p>
                    </div>

                    {{-- TIPE KAMAR --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Tipe Kamar</label>
                        <select name="tipe_kamar" id="tipe_kamar" required onchange="updateHarga()"
                                class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent">
                            <option value="">-- Pilih Tipe Kamar --</option>
                            @foreach($daftarHarga as $tipe => $harga)
                                <option value="{{ $tipe }}" data-harga="{{ $harga }}"
                                    {{ old('tipe_kamar') == $tipe ? 'selected' : '' }}>{{ $tipe }} — Rp {{ number_format($harga, 0, ',', '.') }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- HARGA --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Harga per Malam</label>
                        <input type="text" id="harga_tampil" readonly placeholder="Otomatis terisi"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm bg-gray-50 text-gray-500">
                    </div>

                    {{-- TANGGAL PESAN --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Tanggal Check-in</label>
                        <input type="date" name="tanggal_pesan" id="tanggal_pesan" required
                               value="{{ old('tanggal_pesan') }}"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent">
                    </div>

                    {{-- DURASI MENGINAP --}}
                    <div>
                        <label class="block text-xs uppercase tracking-wide text-gray-500 font-medium mb-2">Durasi Menginap (Hari)</label>
                        <input type="text" name="durasi_menginap" id="durasi_menginap"
                               value="{{ old('durasi_menginap', 1) }}" required
                               oninput="cekDurasi()"
                               class="w-full border border-gray-200 rounded-lg px-4 py-3 text-sm focus:outline-none focus:ring-2 focus:ring-sky-400 focus:border-transparent">
                        <p id="errorDurasi" class="text-red-600 text-xs mt-1 hidden">harus isi angka</p>
                    </div>

                    {{-- TERMASUK BREAKFAST --}}
                    <div class="md:col-span-2 flex items-center gap-3 bg-sky-50 rounded-lg px-4 py-3">
                        <input type="checkbox" name="termasuk_breakfast" id="termasuk_breakfast" value="1"
                               class="w-4 h-4 accent-sky-600"
                               {{ old('termasuk_breakfast') ? 'checked' : '' }}>
                        <label for="termasuk_breakfast" class="text-sm text-slate-700">🍳 Termasuk Sarapan Pagi <span class="text-gray-400">(+Rp 80.000)</span></label>
                    </div>
                </div>

                {{-- ===== TOMBOL AKSI ===== --}}
                <div class="flex flex-wrap gap-3 pt-4 border-t border-gray-100">
                    <button type="button" onclick="hitungTotalBayar()"
                            class="bg-amber-500 hover:bg-amber-600 transition text-white px-6 py-3 rounded-full text-xs uppercase tracking-widest font-semibold">
                        Hitung Total Bayar
                    </button>
                    <button type="submit"
                            class="bg-sky-700 hover:bg-sky-800 transition text-white px-6 py-3 rounded-full text-xs uppercase tracking-widest font-semibold">
                        Simpan Pemesanan
                    </button>
                    <button type="reset" onclick="resetTampilan()"
                            class="border border-gray-300 text-gray-600 hover:bg-gray-50 transition px-6 py-3 rounded-full text-xs uppercase tracking-widest font-semibold">
                        Cancel
                    </button>
                </div>
            </form>

            {{-- ===== KOLOM RINGKASAN BIAYA (1/3 lebar, sticky) ===== --}}
            <div class="bg-slate-900 text-white rounded-2xl shadow-md p-8 h-fit lg:sticky lg:top-8">
                <h3 class="font-serif-elegant text-xl mb-6">Ringkasan Biaya</h3>

                <div class="space-y-3 text-sm text-white/70 pb-4 border-b border-white/10">
                    <div class="flex justify-between">
                        <span>Tipe Kamar</span>
                        <span id="ringkasan_tipe" class="text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Durasi</span>
                        <span id="ringkasan_durasi" class="text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Sarapan</span>
                        <span id="ringkasan_breakfast" class="text-white">-</span>
                    </div>
                    <div class="flex justify-between">
                        <span>Diskon</span>
                        <span id="ringkasan_diskon" class="text-emerald-400">-</span>
                    </div>
                </div>

                <div class="pt-4">
                    <p class="text-xs uppercase tracking-widest text-white/50 mb-1">Total Bayar</p>
                    <input type="text" id="total_bayar_tampil" readonly placeholder="Rp 0"
                           class="w-full bg-transparent text-3xl font-serif-elegant text-amber-400 focus:outline-none">
                </div>

                <p class="text-xs text-white/40 mt-6 leading-relaxed">
                    Klik tombol <strong>Hitung Total Bayar</strong> setelah mengisi Tipe Kamar dan Durasi Menginap
                    untuk melihat rincian biaya di sini.
                </p>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
<script>
    /**
     * Fungsi: updateHarga
     * Deskripsi: Mengisi field Harga otomatis sesuai tipe kamar yang dipilih.
     */
    function updateHarga() {
        const select = document.getElementById('tipe_kamar');
        const opsiTerpilih = select.options[select.selectedIndex];
        const harga = opsiTerpilih.dataset.harga || 0;
        document.getElementById('harga_tampil').value = harga ? formatRupiah(harga) : '';
    }

    /**
     * Fungsi: cekNomorIdentitas
     * Deskripsi: Validasi client-side nomor identitas harus 16 digit angka.
     */
    function cekNomorIdentitas() {
        const input = document.getElementById('nomor_identitas');
        const errorEl = document.getElementById('errorIdentitas');
        const valid = /^[0-9]{16}$/.test(input.value);
        errorEl.classList.toggle('hidden', valid || input.value.length === 0);
        return valid;
    }

    /**
     * Fungsi: cekDurasi
     * Deskripsi: Validasi client-side durasi menginap harus berupa angka.
     */
    function cekDurasi() {
        const input = document.getElementById('durasi_menginap');
        const errorEl = document.getElementById('errorDurasi');
        const valid = /^[0-9]+$/.test(input.value);
        errorEl.classList.toggle('hidden', valid || input.value.length === 0);
        return valid;
    }

    /**
     * Fungsi: hitungTotalBayar
     * Deskripsi: Menghitung total bayar sesuai rumus skenario BNSP,
     *            sekaligus mengisi kolom Ringkasan Biaya di sisi kanan.
     */
    function hitungTotalBayar() {
        const select = document.getElementById('tipe_kamar');
        const opsiTerpilih = select.options[select.selectedIndex];
        const harga = parseInt(opsiTerpilih.dataset.harga || 0);
        const tipe = select.value;

        const durasiInput = document.getElementById('durasi_menginap').value;
        const durasi = parseInt(durasiInput) || 0;

        if (!harga) {
            alert('Silakan pilih tipe kamar terlebih dahulu.');
            return;
        }
        if (!cekDurasi() || durasi <= 0) {
            alert('Durasi menginap harus diisi dengan angka yang valid.');
            return;
        }

        const breakfast = document.getElementById('termasuk_breakfast').checked;

        // === Rumus perhitungan sesuai skenario BNSP ===
        const totalDasar = harga * durasi;
        const discountPersen = durasi > 3 ? 10 : 0;
        const nilaiDiscount = totalDasar * (discountPersen / 100);
        const tambahanBreakfast = breakfast ? 80000 : 0;
        const totalBayar = (totalDasar - nilaiDiscount) + tambahanBreakfast;

        // Isi hasil kalkulasi utama
        document.getElementById('total_bayar_tampil').value = formatRupiah(totalBayar);

        // Isi panel ringkasan biaya di kolom kanan
        document.getElementById('ringkasan_tipe').textContent = tipe + ' (' + formatRupiah(harga) + '/malam)';
        document.getElementById('ringkasan_durasi').textContent = durasi + ' malam';
        document.getElementById('ringkasan_breakfast').textContent = breakfast ? '+ ' + formatRupiah(80000) : 'Tidak ada';
        document.getElementById('ringkasan_diskon').textContent = discountPersen > 0
            ? '- ' + formatRupiah(nilaiDiscount) + ' (10%)'
            : 'Tidak ada';
    }

    /**
     * Fungsi: formatRupiah
     * Deskripsi: Format angka menjadi tampilan Rupiah dengan pemisah ribuan.
     */
    function formatRupiah(angka) {
        return 'Rp ' + Number(angka).toLocaleString('id-ID');
    }

    /**
     * Fungsi: validasiForm
     * Deskripsi: Validasi gabungan sebelum form disubmit.
     */
    function validasiForm() {
        const identitasValid = cekNomorIdentitas();
        const durasiValid = cekDurasi();

        if (!identitasValid) {
            alert('Nomor identitas harus 16 digit angka.');
            return false;
        }
        if (!durasiValid) {
            alert('Durasi menginap harus diisi dengan angka.');
            return false;
        }
        return true;
    }

    /**
     * Fungsi: resetTampilan
     * Deskripsi: Membersihkan tampilan harga & ringkasan biaya saat tombol Cancel diklik.
     */
    function resetTampilan() {
        document.getElementById('harga_tampil').value = '';
        document.getElementById('total_bayar_tampil').value = '';
        document.getElementById('ringkasan_tipe').textContent = '-';
        document.getElementById('ringkasan_durasi').textContent = '-';
        document.getElementById('ringkasan_breakfast').textContent = '-';
        document.getElementById('ringkasan_diskon').textContent = '-';
        document.getElementById('errorIdentitas').classList.add('hidden');
        document.getElementById('errorDurasi').classList.add('hidden');
    }
</script>
@endsection