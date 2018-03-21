<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Cymbals extends Model
{

    protected $fillable = [
        'vendor_code',
        'collection_id',
        'image',
        'image2',
        'price',
        'position'
    ];

    public function local()
    {
        return $this->hasMany(Cymbal_locale::class, 'cymbal_id');
    }

    public function plates()
    {
        return $this->hasMany(Plate::class, 'cymbals_id');
    }

    public static function getCymbalsLocalById($id,$language)
    {
        $temp = DB::select('
        SELECT `cymbals`.`id`,
        `cymbals`.`collection_id`,
        `cymbals`.`price` ,
        `cymbals_locales`.`description`
        FROM cymbals 
        JOIN `cymbals_locales` ON  `cymbals_locales`.`cymbal_id` = `cymbals`.`id`
        AND `cymbals`.`id` = :id
        AND `cymbals_locales`.`language`=:lang', ['id' => $id,'lang' => $language]);

        return array_shift($temp);
    }
}
