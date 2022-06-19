<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Category extends Model
{
    use HasFactory;

    protected $fillable= ['name','capacity','name_ar'];

    public function cars(){
        return $this->hasMany(Car::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
        get: fn ($value) => App::islocale('en') ? $value : $this->name_ar,
        );
    }
}


