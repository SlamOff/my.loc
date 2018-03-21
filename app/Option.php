<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Option extends Model
{
    public static function getOptions($type,$locale)
    {
        $options=[];
        $arr = DB::select('SELECT `key`,`value` FROM `options` WHERE `type`=:type AND (`language`=:lang OR `multi`=0)', ['type'=>$type,'lang' => $locale]);
        foreach ($arr as $value)
            $options[$value->key]=$value->value;
        return $options;
    }
}
