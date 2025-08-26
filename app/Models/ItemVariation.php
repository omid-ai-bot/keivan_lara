<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ItemVariation extends Model
{
    protected $fillable = ['name', 'price', 'description'];

    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
