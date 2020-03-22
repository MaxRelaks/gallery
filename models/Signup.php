<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;
use yii\helpers\Html;

class Signup extends Model
{
    const ACTIVE_USER = 1; // Потверждённый E-mail

    public $firstname;
    public $surename;
    public $email;
    public $password;
    public $confpassword;
    public $city;
    public $date;
    public $code;
    public $active;

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

    public function sendConfirmationLink(){
        $confirmationLinkUrl = Url::to(['auction/site/confirmemail', 'email'=>$this->email, 'code'=>$this->code]);
        $confirmationLink = Html::a('Подтвердить Email', $confirmationLinkUrl);

        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Пожалуйста, подтвердите свой Email')
            ->setTextBody('Для прохождения регистрации Вам необходимо подтвердить свой Email, перейдя по ссылке: ' . $confirmationLinkUrl)
            ->setHtmlBody('<p>Для прохождения регистрации Вам необходимо подтвердить свой Email, перейдя по ссылке ниже:</p>' . $confirmationLink)
            ->send();

        return $sendingResult;
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
        $user->code = $this->code;
        $user->active = 0;
        return $user->save(); //вернет true или false
    }

}
