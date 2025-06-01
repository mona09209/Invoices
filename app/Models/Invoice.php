<?php

namespace App\Models;
use App\Models\Sections;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'invoices';
    protected $guarded = [];
    public function section(){
return $this->belongsTo(Sections::class);
    }
    protected $dates = ['deleted_at'];

}
