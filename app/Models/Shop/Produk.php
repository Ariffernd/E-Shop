<?php

namespace App\Models\Shop;

use App\Models\Shop\Kategori;
use App\Models\Shop\SubKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = [
        'sku',
        'foto',
        'thumb',
        'kategori_id',
        'sub_kategori_id',
        'nama_produk',
        'berat_barang',
        'satuan',
        'deskripsi',
        'stok',
        'harga',
        'status',
    ];

    protected $casts = [
        'foto' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            if ($model->foto) {
                $model->thumb = $model->foto[0];
            }
        });

        static::updating(function ($model) {
            if ($model->foto) {
                $model->thumb = $model->foto[0];
            }
        });
    }

    public function Kategori(){
        return $this->belongsTo(Kategori::class);

    }

    public function SubKategori(){
        return $this->belongsTo(SubKategori::class);
    }
}
