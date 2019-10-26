<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
  use SoftDeletes;

  protected $fillable=['name','parent_id'];
  protected $dates = ['deleted_at'];

  public function getSubCategories(){
    return $this->hasMany('App\Category','parent_id','id');
  }

}
