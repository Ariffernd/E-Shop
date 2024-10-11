<?php

namespace App\Models\Shop;

use App\Models\Shop\Kategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubKategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori_id',
        'sub_kategori',
    ];

    public function Kategori(){
        return $this->belongsTo(Kategori::class);
    }
}
