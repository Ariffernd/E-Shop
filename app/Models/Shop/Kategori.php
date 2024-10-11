<?php

namespace App\Models\Shop;

use App\Models\Shop\SubKategori;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'kategori',
    ];

    public function SubKategori(){
        return $this->hasMany(SubKategori::class);
    }
}
