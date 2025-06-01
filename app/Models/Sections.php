<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Products;


class Sections extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $fillable = [
        'name',
        'description',
        'created_by',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'section_id');
    }
}
