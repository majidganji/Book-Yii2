<?php

namespace backend\controllers;

use Yii;
use backend\models\Books;
use backend\models\BooksSearch;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use common\components\Image;

/**
 * BookController implements the CRUD actions for Books model.
 */
class BookController extends AdminController {

    public $layout = 'index';

    /**
     * Lists all Books models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->pagination->pageSize = 15;
        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    public function actionDownload($id) {
        $model = $this->findModel($id);
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
            $file = Yii::$app->basePath . '/../frontend/web/PdfoouploadS/' . $file->randname;
            header("Content-Length: " . filesize($file));
            @readfile($file);
            flush();
        } else {
            throw new \yii\web\NotFoundHttpException('کتاب مورد نظر پیدا نشد.');
        }
    }

    /**
     * Displays a single Books model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Books model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Books();
        if ($model->load(Yii::$app->request->post())) {
            $model->ts = time();
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            $RD_name = Yii::$app->security->generateRandomString(20);
            $path = Yii::$app->basePath . '/../frontend/web/PdfoouploadS/' . $RD_name . '.' . $model->pdf->extension;
            $extension = $model->pdf->extension;
            $model->img = UploadedFile::getInstance($model, 'img');
            if ($model->save()) {
                $model->pdf->saveAs($path);
                $image = new \backend\models\Image;
                $image->ismain = 1;
                $image->book_id = $model->id;
                $image->confimed = 1;
                $image->save();
                Image::safeUpload($model->img->tempName, $image->id);
                $bd = new \backend\models\BooksDow();
                $bd->book_id = $model->id;
                $bd->name = $model->title . '.' . $extension;
                $bd->randname = $RD_name . '.' . $extension;
                $bd->save();
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                die;
            }
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Books model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->img = UploadedFile::getInstance($model, 'img');
            $model->pdf = UploadedFile::getInstance($model, 'pdf');
            if($model->save()){
                if($model->img !== NULL){
                    unlink(Yii::$app->basePath . '/../frontend/web/photosFoRPdF/'. $model->imageid .'.jpg');
                    Image::safeUpload($model->img->tempName, $model->imageid);
                }
                if($model->pdf !== NULL){
                    $bd = \backend\models\BooksDow::findOne(['book_id' => $model->id])->randname;
                    $path = Yii::$app->basePath . '/../frontend/web/PdfoouploadS/' . $bd ;
                    $model->pdf->saveAs($path);
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Books model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        unlink(Yii::$app->basePath . '/../frontend/web/photosFoRPdF/'. $model->imageid .'.jpg');
        unlink(Yii::$app->basePath . '/../frontend/web/PdfoouploadS/'. $model->bookname);
        $model->delete();
        return $this->redirect(['index']);
    }

    /**
     * Finds the Books model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Books the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Books::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('مشخصات نامعتبر است.');
        }
    }

}
