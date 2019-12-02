<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    public function ads() {
        return $this->hasMany(Ad::class);
    }

    public function country() {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }
}
