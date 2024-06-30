<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $fillable = ['name','parent_id'];

    public function Children(){
        return $this->hasMany(category::class  ,'parent_id');
    }

    public function SubCategory(){
        return $this->Children()->with('SubCategory')->select('id','name','parent_id');

    }
}
