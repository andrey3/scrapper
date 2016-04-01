<?php

namespace app\controllers;

use Yii;
use app\models\RegForm;
use app\models\LoginForm;

class SignController extends \yii\web\Controller
{
    public function actionReg()
    {

        $model = new RegForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            if ($user = $model->reg()) {
                if (Yii::$app->getUser()->login($user)):
                    return $this->redirect('/admin/product/index');
                endif;
            } else {
                Yii::$app->session->setFlash('error', 'Error sign up.');
                Yii::error('Error sign up');
                return $this->refresh();
            }
        }

        return $this->render(
            'reg',
            ['model' => $model]
        );
    }

    public function actionLogin()
    {

        if (!Yii::$app->user->isGuest):

            return $this->redirect('/admin/product/index');

        endif;

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()):

            return $this->redirect('/admin/product/index');

        endif;

        return $this->render(
            'login',
            ['model' => $model]
        );
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->redirect('/sign/login');

    }

}