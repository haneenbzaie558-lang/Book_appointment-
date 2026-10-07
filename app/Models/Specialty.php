<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable(['name'])]
class Specialty extends Model
{
    /**
     * Get the doctors for the specialty.
     */
    public function doctors(): HasMany
    {
        return $this->hasMany(Doctor::class);
    }
}
