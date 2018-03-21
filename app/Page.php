<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public function seo()
    {
        return $this->hasMany(Seo_option::class, 'page_id');
    }
}
