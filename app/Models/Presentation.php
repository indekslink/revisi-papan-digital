<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    use HasFactory;
    protected $fillable = ['sheet_id', 'order'];

    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }
}
