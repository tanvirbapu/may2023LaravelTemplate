<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'title'
    ];

    public function crud()
    {
        return $this->hasOne(Crud::class);
    }
}