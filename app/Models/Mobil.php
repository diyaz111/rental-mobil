<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Mobil extends Model
{
    use HasFactory, HasRoles;

    protected $table = 'cars';
    protected $fillable = ['merk', 'name', 'license_number', 'color', 'year', 'status', 'price', 'penalty'];

    /**
     * Method One To Many
     */
    public function transaksiCar()
    {
        return $this->hasMany(TransaksiCar::class);
    }
}
