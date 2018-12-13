<?php

namespace equipe5\models;

class Metier extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'metiers';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function users(){
        return $this->hasMany('equipe5\models\User');
    }

    public static function byId($id){
        return parent::where('id', '=', $id)->first();
    }
}