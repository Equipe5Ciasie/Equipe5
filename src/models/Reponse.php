<?php

namespace equipe5\models;

class Reponse extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'reponses';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function appel_offres(){
        return $this->belongsTo('equipe5\models\Appel_offres');
    }
}