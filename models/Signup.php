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

<<<<<<< HEAD
    public function sendConfirmationLink(){
        $confirmationLinkUrl = Url::to(['auction/site/confirmemail', 'email'=>$this->email, 'code'=>$this->code],'https');

        $sendingResult = Yii::$app->mailer->compose()
            ->setFrom(Yii::$app->params['adminEmail'])
            ->setTo($this->email)
            ->setSubject('Пожалуйста, подтвердите свой Email')
            //->setTextBody('Для прохождения регистрации Вам необходимо подтвердить свой Email, перейдя по ссылке: ' . $confirmationLinkUrl)
            ->setHtmlBody('<table bgcolor="#ffffff" class="m_-6559625847427879627es-header-body" align="center" cellpadding="0" cellspacing="0" width="600" style="border-collapse:collapse;border-spacing:0px;background-color:#ffffff"> 
             <tbody><tr style="border-collapse:collapse"> 
              <td style="Margin:0;padding-top:20px;padding-bottom:20px;padding-left:40px;padding-right:40px;background-position:center bottom" align="left"> 
               <table width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;border-spacing:0px"> 
                 <tbody><tr style="border-collapse:collapse"> 
                  <td width="520" valign="top" align="center" style="padding:0;Margin:0"> 
                   <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="border-collapse:collapse;border-spacing:0px"> 
                     <tbody><tr style="border-collapse:collapse"> 
                      <td align="center" class="m_-6559625847427879627es-m-txt-c" style="padding:0;Margin:0"><h2 style="Margin:0;line-height:29px;font-family:arial,\'helvetica neue\',helvetica,sans-serif;font-size:24px;font-style:normal;font-weight:normal;color:#333333">Привіт,&nbsp;'.$this->firstname.'</h2></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td class="m_-6559625847427879627es-m-txt-c" align="center" style="padding:0;Margin:0;padding-top:15px;padding-bottom:20px"><h3 style="Margin:0;line-height:24px;font-family:arial,\'helvetica neue\',helvetica,sans-serif;font-size:20px;font-style:normal;font-weight:normal;color:#010101">Щоб підтвердити Ваш аккаунт натисніть на кнопку знизу</h3></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td align="center" style="padding:0;Margin:0;padding-bottom:10px;padding-left:10px;padding-right:10px"><span class="m_-6559625847427879627es-button-border" style="border-style:solid;border-color:#2cb543;background:#2cb543;border-width:0px 0px 2px 0px;display:inline-block;border-radius:30px;width:auto"><a class="m_-6559625847427879627es-button" style="text-decoration:none;font-family:arial,\'helvetica neue\',helvetica,sans-serif;font-size:18px;color:#ffffff;border-style:solid;border-color:#31cb4b;border-width:10px 20px 10px 20px;display:inline-block;background:#31cb4b;border-radius:30px;font-weight:normal;font-style:normal;line-height:22px;width:auto;text-align:center" href="'.$confirmationLinkUrl.'" >Підтвердити </a></span></td> 
                     </tr> 
                     <tr style="border-collapse:collapse"> 
                      <td class="m_-6559625847427879627es-m-txt-c" align="center" style="padding:0;Margin:0;padding-top:10px;padding-bottom:15px"><p style="Margin:0;font-size:14px;font-family:arial,\'helvetica neue\',helvetica,sans-serif;line-height:21px;color:#999999"><a href="http://auction-gallery.ga" target="_blank" data-saferedirecturl="https://www.google.com/url?q=http://auction-gallery.ga&amp;source=gmail&amp;ust=1585076604690000&amp;usg=AFQjCNGWlg0E_HpAuXuhFXyV3BrCEh8bkw">auction-gallery.ga</a></p></td> 
                     </tr> 
                   </tbody></table></td> 
                 </tr> 
               </tbody></table></td> 
             </tr> 
           </tbody></table>')
            ->send();

        return $sendingResult;
    }

=======
>>>>>>> parent of c73ca91... add send mail done
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
