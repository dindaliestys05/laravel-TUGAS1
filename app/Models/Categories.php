<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;

    // Tentukan nama tabel yang digunakan di database
    protected $table = 'product_categories';

    // Daftar field yang boleh diisi secara massal (mass assignment)
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'product_category_id', // untuk kategori induk (parent category)
        'price',
        'stock',
        'is_active',
    ];

    // Relasi ke kategori induk (parent)
    public function parent()
    {
        return $this->belongsTo(Categories::class, 'product_category_id');
    }

    // Relasi ke kategori anak (child categories)
    public function children()
    {
        return $this->hasMany(Categories::class, 'product_category_id');
    }
}