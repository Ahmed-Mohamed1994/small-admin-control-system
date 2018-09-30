<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    protected $fillable =['name'];

    public function groups(){
        return $this->belongsToMany(groups::class,'group_page','page_id','group_id');
    }
}
