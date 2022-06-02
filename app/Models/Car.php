<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
//use Attribute;
use Illuminate\Database\Eloquent\Casts\Attribute as CastsAttribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Mews\Purifier\Casts\CleanHtml;


class Car extends Model
{
    use HasFactory;
protected $guarded = [];

protected $attributes= [
    'is_new'    => false,
];

//protected casts to set rules when getting data from database
protected $casts= [
    'description' => CleanHtml::class,
];

    public function category(){
        return $this->belongsTo(Category::class);
    }


     /**
     * make accesor for is_new.
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute

    protected function isNew(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value ? 'yes' : 'no',
        );
    }
*/
protected function featuredImage(): Attribute
{
    return Attribute::make(
        get: fn ($value) => $value ? $value : 'dXVyu3hZL729Vizzh1zZo75hm5sanCT5TJM0Ls6K.jpg',
    );
}
}

