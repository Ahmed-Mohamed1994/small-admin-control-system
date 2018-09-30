<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class groups extends Model
{
    protected $fillable =['name'];

    public function pages(){
        return $this->belongsToMany(Pages::class,'group_page', 'group_id', 'page_id')->withTimestamps();
    }

    public function users(){
        return $this->hasMany(User::class);
    }
}
