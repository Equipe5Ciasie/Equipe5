<?php

namespace equipe5\models;

class Entreprise extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'entreprise';
    protected $primaryKey = 'id';
    public $timestamps = false;
}