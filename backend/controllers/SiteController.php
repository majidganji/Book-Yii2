<?php

namespace backend\controllers;

use Yii;

use common\models\AdminLoginForm;


/**
 * Site controller
 */
class SiteController extends AdminController {

    public $layout = 'index';
    
    public function beforeAction($action) {
        if ($action->id === 'error'){
            $this->layout = 'error';
        }
        return parent::beforeAction($action);
    }
    
    public function actionIndex() {
        return $this->render('index');
    }

    public function actionLogin() {
        $this->layout = 'login';
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new AdminLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
