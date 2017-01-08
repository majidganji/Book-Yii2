<?php

namespace frontend\controllers;

use frontend\models\Books;
use common\components\JahanPay;
use common\components\JDF;
use frontend\models\Orders;
use Yii;

class ShopController extends MainController {

    public function beforeAction($action) {
        if ($action->id === 'facture') {
            $this->enableCsrfValidation = FALSE;
        }
        return parent::beforeAction($action);
    }

    public function actionFacture($au, $order_id) {
        $model = $this->_book_model($order_id);
        list($code, $message) = JahanPay::verify($model->price, $au);
        if ($code !== 1) {
            throw new \yii\web\HttpException(500, $message . '(' . $code . ')');
        }
        $order = new Orders();
        $order->user_id = (Yii::$app->user->id ? : NULL);
        $order->book_id = $model->id;
        $order->au = $au;
        $order->paid = 1;
        $order->ts = time();
        $order->confirmed = 1;
        $order->save();
        if (Yii::$app->user->isGuest) {
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
                throw new \yii\web\NotFoundHttpException('کتاب مورد نظر پیدا نشد.'. ' - کد بانکی شما :' . $au);
            }
        }else{
            return $this->redirect(['/site/more', 'id' => $model->id]);
        }
    }

    public function actionGobank($id) {
        $model = $this->_book_model($id);
        JahanPay::request($model->price, $model->id, urlencode(JDF::jdate('l j Y F', $model->ts)));
    }

    public function actionShop($id) {
        $model = $this->_book_model($id);
        return $this->render('/shop/shop', [
                    'model' => $model,
        ]);
    }

    private function _book_model($id) {
        if (!$model = Books::findOne(['id' => $id, 'confirmed' => 1])) {
            throw new \yii\web\NotFoundHttpException('کتاب مورد نظر پیدا نشد.');
        }
        return $model;
    }

}
