<?php

namespace equipe5\models;

class User extends \Illuminate\Database\Eloquent\Model {
    protected $table = 'users';
    protected $primaryKey = 'id';
    public $timestamps = false;

    public static function byMail($email){
        return parent::where('email', '=', $email)->first();
    }
}