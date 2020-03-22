<?php

namespace app\controllers;

use app\models\User;
use Yii;
use yii\web\Controller;
use app\models\Signup;
use app\models\Login;

class SiteController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogout()
    {
        if(!Yii::$app->user->isGuest)
        {
            Yii::$app->user->logout();
            return $this->redirect(['login']);
        }
    }


    public function actionSignup()
    {
        $model = new Signup();

        if(isset($_POST)){
            $model->attributes = Yii::$app->request->post('Signup');
            $model->code = Yii::$app->getSecurity()->generateRandomString(10);
            if($model->validate())
            {
                $model->signup();
                $model->sendConfirmationLink();
                Yii::$app->session->setFlash('success', " Выслана ссылка для потверждения Вашей почты.");
                return $this->goHome();
            }
        }

        return $this->render('signup',['model'=>$model]);
    }

    public function actionConfirmemail()
    {
        // Если пользователь авторизован, то возврощаем на домашнюю страницу
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }
        // разбираем ссылку
        $code = htmlspecialchars(Yii::$app->request->get('code'));
        $email = htmlspecialchars(Yii::$app->request->get('email'));

        // Ищим пользователя с таким E-mail и code
        $model = User::find()->where(['email' => $email, 'code' => $code])->one();
        // Если нашли
        if ($model->id)
        {
            $model->code = '';
            $model->active = Signup::ACTIVE_USER;
            $model->save();
            Yii::$app->session->setFlash('success', "Ваш E-mail потверждён.");
            return $this->redirect('/site/login');
        }
        else
        {
            return $this->goHome();
        }

    }

    public function actionLogin()
    {
        if(!Yii::$app->user->isGuest)
        {
            return $this->goHome();
        }

        $login_model = new Login();

        if( Yii::$app->request->post('Login'))
        {
            $login_model->attributes = Yii::$app->request->post('Login');

            if($login_model->validate())
            {
                Yii::$app->user->login($login_model->getUser());
                return $this->goHome();
            }
        }

        return $this->render('login',['login_model'=>$login_model]);
    }

}
