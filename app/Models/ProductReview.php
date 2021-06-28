<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];


    public function user(){
        return $this->belongsTo('App\Models\User','user_id');
    }

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }


}


