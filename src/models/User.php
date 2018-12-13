<?php

namespace equipe5\models;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function appels_offres(){
        return $this->hasMany('equipe5\models\Appel_offres');
    }

    public function metier(){
        return $this->belongsTo('equipe5\models\Metier');
    }

    public static function byMail($email){
        return parent::where('email', '=', $email)->first();
    }

    public static function byId($id){
        return parent::where('id', '=', $id)->first();
    }
}