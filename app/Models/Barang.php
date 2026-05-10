<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';

    protected $fillable = [
        'nama_barang',
        'kategori_id',
        'stok',
        'satuan',
        'harga_jual',
        'stok_minimum',
        'harga_beli',
        'berat_atau_ukuran',
        'lokasi_simpan',
        'deskripsi',
        'foto'
    ];

    // relasi ke kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    public function scopeStokMenipis($query)
    {
        return $query->where(function ($q) {
            $q->whereNotNull('stok_minimum')
                ->whereColumn('stok', '<', 'stok_minimum');
        })->orWhere(function ($q) {
            $q->whereNull('stok_minimum')
                ->where('stok', '<', 20);
        });
    }

    public function getStokMinimumFixAttribute()
    {
        return $this->stok_minimum ?? 20;
    }

    public function getStokStatusClassAttribute()
    {
        $limit = $this->stok_minimum ?? 20;

        if ($this->stok == 0) {
            return 'stok-habis';
        }

        if ($this->stok <= $limit) {
            return 'stok-tipis';
        }

        return 'stok-normal';
    }
}
