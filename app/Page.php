<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

	protected $table = 'tblPages';

    protected $fillable = [
        'title','name','uri','content'
    ];


}
