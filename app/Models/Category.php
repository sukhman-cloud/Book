<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'admin_cate';
    protected $fillable = [
        'category_name',
        'category_abbrivation'
    ] ;
}
