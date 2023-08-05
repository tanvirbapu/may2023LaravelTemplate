<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crud extends Model
{
    use HasFactory;

    protected $fillable = [
        'textbox',
        'dropdown',
        'radiobutton',
        'checkbox',
        'toggle',
        'image',
        'video',
        'editor',
        'date',
        'multiple_value'
    ];


    public function option()
    {
        return $this->belongsTo(Option::class);
    }
}