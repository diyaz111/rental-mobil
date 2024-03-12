<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransaksiCar extends Model
{
    protected $table = 'transaksi_car';
    protected $fillable = ['kode_transaksi', 'user_id', 'mobil_id', 'tgl_pinjam', 'tgl_kembali', 'status', 'ket'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }
}
