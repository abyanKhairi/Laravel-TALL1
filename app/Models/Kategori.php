<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'keterangan'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

