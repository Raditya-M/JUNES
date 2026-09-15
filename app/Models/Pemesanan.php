<?php
/**
 * File         : Pemesanan.php
 * Deskripsi    : Model untuk merepresentasikan data pemesanan kamar hotel.
 *                Berelasi langsung dengan tabel pemesanan_kamars.
 * Initial State: Data pemesanan belum tersedia sebagai objek PHP
 * Final State  : Data pemesanan dapat diakses, disimpan, dan dimanipulasi
 *                melalui Eloquent ORM
 * Author       : Junior Web Developer
 * Versi/Tanggal: v1.0 / 2026-09-15
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    /**
     * Nama tabel yang digunakan oleh model ini.
     * (Opsional, karena Laravel otomatis mendeteksi 'pemesanans',
     * kita eksplisitkan agar sesuai dengan nama migration)
     */
    protected $table = 'pemesanan_kamars';

    /**
     * Kolom-kolom yang boleh diisi secara mass-assignment.
     * Mencegah error "MassAssignmentException" saat create()/update().
     */
    protected $fillable = [
        'nama_pemesan',
        'jenis_kelamin',
        'nomor_identitas',
        'tipe_kamar',
        'harga',
        'tanggal_pesan',
        'durasi_menginap',
        'termasuk_breakfast',
        'discount',
        'total_bayar',
    ];

    /**
     * Casting tipe data otomatis.
     * - termasuk_breakfast di-cast ke boolean agar mudah dicek di view (checked/tidak)
     * - tanggal_pesan di-cast ke date agar mudah diformat di Blade
     */
    protected $casts = [
        'termasuk_breakfast' => 'boolean',
        'tanggal_pesan'      => 'date',
    ];
}