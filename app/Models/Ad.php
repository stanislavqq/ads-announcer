<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    public function category() {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function city() {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function author() {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }
}
