<?php

namespace frontend\controllers;

use Yii;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use frontend\models\Books;
use yii\data\Pagination;
use frontend\models\User;
use frontend\models\ChangePassword;

/**
 * Site controller
 */
class SiteController extends MainController {

    public function actionCategory($id, $name) {
        $this->layout = 'index';
        $query = Books::find()->where(['category_id' => $id, 'confirmed' => 1]);
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 10,
        ]);

        $models = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pagination,
        ]);
    }

    public function actionSearch($search) {
        $this->layout = 'index';
        $query = Books::find()->filterWhere(['like', 'title', strtolower($search)]);
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 10,
        ]);

        $models = $query->offset($pagination->offset)->limit($pagination->limit)->all();
        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pagination,
        ]);
    }

    private function _book_model($id) {
        if (!$model = Books::findOne(['id' => $id, 'confirmed' => 1])) {
            throw new \yii\web\NotFoundHttpException('کتاب مورد نظر پیدا نشد.');
        }
        return $model;
    }

    public function actionAccunt() {
        $this->layout = 'accunt';
        return $this->render('/accunt/accunt');
    }

    public function actionChangepassword() {
        $this->layout = 'accunt';
        $model = new ChangePassword();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->savePassword()) {
                Yii::$app->session->setFlash('success', 'رمز عبور تغییر کرد.');
                return $this->redirect(['/site/accunt']);
            } else {
                Yii::$app->session->setFlash('danger', 'خطا : رمز عبور تغییر نکرد.');
            }
        }

        return $this->render('/accunt/change-password', [
                    'model' => $model,
        ]);
    }

    public function actionChangeaccunt() {
        $this->layout = 'accunt';
        $model = User::findOne(Yii::$app->user->id);
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->updated_at = time();
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'تغییرات با موفقیت انجام شد.');
                return $this->redirect(['/site/accunt']);
            } else {
                Yii::$app->session->setFlash('dabger', 'خطا در تغییر اطلاعات به وجود آمده است.');
                return $this->refresh();
            }
        }
        return $this->render('/accunt/change-accunt', [
                    'model' => $model,
        ]);
    }

    public function actionDownload($id) {
        $model = $this->_book_model($id);
        if ($model->price === NULL || $model->getOrders()->one()->user_id === Yii::$app->user->id) {
            set_time_limit(-1);
            if ($file = $model->getBooksDows()->one()) {
                header("Pragma: public");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("Cache-Control: private");
                header("Content-Description: File Transfer");
                header("Content-type: application/octet-stream");
                header('Content-Disposition: attachment; filename="' . $file->name . '"');
                header("Content-Transfer-Encoding: binary");
                $file = Yii::$app->basePath . '/web/PdfoouploadS/' . $file->randname;
                header("Content-Length: " . filesize($file));
                @readfile($file);
                flush();
            } else {
                throw new \yii\web\NotFoundHttpException('کتاب مورد نظر پیدا نشد.');
            }
        } else {
            throw new \yii\web\ForbiddenHttpException('خطا: دسترسی غیر مجاز.');
        }
    }

    public function actionMore($id) {
        $this->layout = 'more';
        $model = $this->_book_model($id);
        return $this->render('more', [
                    'model' => $model,
        ]);
    }

    public function actionIntroduction() {
        
    }

    public function actionIndex() {
        $this->layout = 'index';
        $query = Books::find()->where(['confirmed' => 1]);
        $pagination = new Pagination([
            'totalCount' => $query->count(),
            'defaultPageSize' => 10,
        ]);
        $models = $query->offset($pagination->offset)->limit($pagination->limit)->orderBy('id DESC')->all();
        return $this->render('index', [
                    'models' => $models,
                    'pages' => $pagination,
        ]);
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $user = User::findOne(Yii::$app->user->id);
            Yii::$app->session->set('last_login_time', $user->last_login_time);
            $user->last_login_time = time();
            $user->update();
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout() {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact() {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'پیام شما با موفقیت ارسال شد. با تشکر');
            } else {
                Yii::$app->session->setFlash('error', 'خطا در هنگام ارسال ایمیل.');
            }
            return $this->refresh();
        } else {
            if (!Yii::$app->user->isGuest) {
                $model->email = Yii::$app->user->identity->email;
                $model->name = Yii::$app->user->identity->name . ' ' . Yii::$app->user->identity->family;
            }
            return $this->render('contact', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout() {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup() {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }
        return $this->render('signup', [
                    'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset() {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }
        return $this->render('requestPasswordResetToken', [
                    'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token) {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password was saved.');
            return $this->goHome();
        }
        return $this->render('resetPassword', [
                    'model' => $model,
        ]);
    }

}
