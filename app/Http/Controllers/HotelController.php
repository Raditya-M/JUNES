<?php
/**
 * File         : HotelController.php
 * Deskripsi    : Controller utama aplikasi pemesanan kamar hotel.
 *                Menangani tampilan halaman (produk, harga, tentang kami),
 *                proses simpan pemesanan (store), dan tampilan detail pesanan (show).
 * Initial State: Belum ada request yang diproses
 * Final State  : Data pemesanan tervalidasi dan tersimpan di database,
 *                serta dapat ditampilkan kembali ke pengguna
 * Author       : Junior Web Developer
 * Versi/Tanggal: v1.0 / 2026-09-15
 */

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class HotelController extends Controller
{
    /**
     * Daftar master tipe kamar & harga.
     * Disimpan sebagai konstanta agar konsisten antara form, kalkulasi,
     * dan validasi server-side (single source of truth).
     *
     * @var array
     */
    private const DAFTAR_HARGA_KAMAR = [
        'Standar'   => 500000,
        'Deluxe'    => 800000,
        'Executive' => 1200000,
    ];

    /**
     * Biaya tambahan breakfast (flat, tidak dipengaruhi durasi menginap).
     */
    private const BIAYA_BREAKFAST = 80000;

    /**
     * Menampilkan halaman utama / beranda (Produk, Daftar Harga, Tentang Kami).
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // Kirim daftar harga kamar ke view supaya tabel harga selalu sinkron
        return view('hotel.index', [
            'daftarHarga' => self::DAFTAR_HARGA_KAMAR,
        ]);
    }

    /**
     * Menampilkan halaman form pemesanan kamar.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('hotel.pesan', [
            'daftarHarga' => self::DAFTAR_HARGA_KAMAR,
        ]);
    }

    /**
     * Memproses penyimpanan data pemesanan ke database.
     * Melakukan validasi server-side sesuai aturan pengisian form di skenario.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // ==== VALIDASI SERVER-SIDE ====
        // Wajib dilakukan meskipun sudah ada validasi JS di client,
        // karena validasi client bisa dilewati/dimatikan oleh pengguna.
        $validated = $request->validate([
            'nama_pemesan'        => ['required', 'string', 'max:100'],
            'jenis_kelamin'       => ['required', Rule::in(['Laki-laki', 'Perempuan'])],
            // regex memastikan HANYA angka dan PERSIS 16 digit
            'nomor_identitas'     => ['required', 'regex:/^[0-9]{16}$/'],
            'tipe_kamar'          => ['required', Rule::in(array_keys(self::DAFTAR_HARGA_KAMAR))],
            'tanggal_pesan'       => ['required', 'date'],
            'durasi_menginap'     => ['required', 'integer', 'min:1'],
            // checkbox: jika tidak dicentang, field tidak terkirim -> nullable
            'termasuk_breakfast'  => ['nullable', 'boolean'],
        ], [
            // Pesan error kustom sesuai skenario BNSP
            'nomor_identitas.regex'      => 'isian salah..data harus 16 digit',
            'durasi_menginap.integer'    => 'harus isi angka',
            'nama_pemesan.required'      => 'Nama pemesan wajib diisi',
            'jenis_kelamin.required'     => 'Jenis kelamin wajib dipilih',
            'tipe_kamar.required'        => 'Tipe kamar wajib dipilih',
            'tanggal_pesan.required'     => 'Tanggal pesan wajib diisi',
        ]);

        // ==== LOGIKA PERHITUNGAN (server-side, sebagai validasi ulang dari JS) ====
        $hargaKamar   = self::DAFTAR_HARGA_KAMAR[$validated['tipe_kamar']];
        $durasi       = (int) $validated['durasi_menginap'];
        $breakfast    = $request->boolean('termasuk_breakfast'); // true jika checkbox dicentang

        $totalDasar   = $hargaKamar * $durasi;

        // Diskon 10% berlaku jika durasi menginap lebih dari 3 hari
        $discountPersen = $durasi > 3 ? 10 : 0;
        $nilaiDiscount  = $totalDasar * ($discountPersen / 100);

        // Tambahan breakfast flat Rp 80.000 jika dicentang
        $tambahanBreakfast = $breakfast ? self::BIAYA_BREAKFAST : 0;

        // Total akhir sesuai rumus: (Total Dasar - Diskon) + Tambahan Breakfast
        $totalBayar = ($totalDasar - $nilaiDiscount) + $tambahanBreakfast;

        // ==== SIMPAN KE DATABASE ====
        $pemesanan = Pemesanan::create([
            'nama_pemesan'       => $validated['nama_pemesan'],
            'jenis_kelamin'      => $validated['jenis_kelamin'],
            'nomor_identitas'    => $validated['nomor_identitas'],
            'tipe_kamar'         => $validated['tipe_kamar'],
            'harga'              => $hargaKamar,
            'tanggal_pesan'      => $validated['tanggal_pesan'],
            'durasi_menginap'    => $durasi,
            'termasuk_breakfast' => $breakfast,
            'discount'           => $discountPersen,
            'total_bayar'        => $totalBayar,
        ]);

        // Redirect ke halaman detail pesanan yang baru dibuat
        return redirect()
            ->route('pesanan.show', $pemesanan->id)
            ->with('success', 'Pemesanan kamar berhasil disimpan!');
    }

    /**
     * Menampilkan detail / rekap satu data pemesanan.
     *
     * @param  \App\Models\Pemesanan  $pemesanan
     * @return \Illuminate\View\View
     */
    public function show(Pemesanan $pemesanan)
    {
        // Route Model Binding otomatis mengambil data by ID,
        // atau melempar 404 jika tidak ditemukan.
        return view('hotel.detail', compact('pemesanan'));
    }

    /**
     * Menampilkan daftar seluruh pemesanan yang sudah tersimpan (rekap).
     *
     * @return \Illuminate\View\View
     */
    public function riwayat()
    {
        $daftarPesanan = Pemesanan::latest()->get();
        return view('hotel.riwayat', compact('daftarPesanan'));
    }
}