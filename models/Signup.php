<?php

namespace app\models;

use yii\base\Model;

class Signup extends Model
{
    public $firstname;
    public $surename;
    public $email;
    public $password;
    public $confpassword;
    public $city;
    public $date;

    public function rules()
    {
        return [

            [['firstname','surename','email','date','city','password','confpassword'],'required'],
            ['email','email'],
            ['firstname','string','min'=>4,'max'=>15],
            ['surename','string','min'=>4,'max'=>15],
            ['city','string','min'=>4,'max'=>15],
            ['email','unique','targetClass'=>'app\models\User'],
            ['password','string','min'=>4,'max'=>15],
            ['confpassword', 'compare', 'compareAttribute' => 'password'],
        ];
    }

    public function signup()
    {
        $user = new User();
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->firstname = $this->firstname;
        $user->surename = $this->surename;
        $user->city = $this->city;
        $user->date = $this->date;
        return $user->save(); //вернет true или false
    }

}
