<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'title', 'slug', 'subtitle', 'order', 'content', 'content_type'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
    public function presentation()
    {
        return $this->hasOne(Presentation::class);
    }
}
