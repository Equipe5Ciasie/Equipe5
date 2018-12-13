<?php

namespace equipe5\models;

class Appel_offres extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'appels_offres';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function user(){
        return $this->belongsTo('equipe5\models\User');
    }

    public static function byId($id){
        return parent::where('id', '=', $id)->first();
    }
}