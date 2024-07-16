<?php

namespace app\controllers;

use app\models\ImportForm;
use app\models\RawTechnics;
use Yii;
use yii\web\Controller;
use yii\web\UploadedFile;

class ImportController extends Controller
{
    public function actionRaw()
    {
        $model = new ImportForm();
        if (
            Yii::$app->request->isPost && $model->load(Yii::$app->request->post())
        ) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->upload()) {
                RawTechnics::deleteAll();
                $message = ImportForm::importRaw();
                Yii::$app->session->setFlash('success', $message);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось загрузить файл!');
            }
        }
        return $this->render('raw', ['model' => $model]);
    }

    public function actionMaterials()
    {
        $model = new ImportForm();
        if (
            Yii::$app->request->isPost && $model->load(Yii::$app->request->post())
        ) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->upload()) {
                $message = ImportForm::importMaterials();
                Yii::$app->session->setFlash('success', $message);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось загрузить файл!');
            }
        }
        return $this->render('materials', ['model' => $model]);
    }

    public function actionTechnics()
    {
        $model = new ImportForm();
        if (
            Yii::$app->request->isPost && $model->load(Yii::$app->request->post())
        ) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->upload()) {
                $message = ImportForm::importTechnics();
                Yii::$app->session->setFlash('success', $message);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось загрузить файл!');
            }
        }
        return $this->render('technics', ['model' => $model]);
    }

    public function actionTechnicsZ21()
    {
        $model = new ImportForm();
        if (
            Yii::$app->request->isPost && $model->load(Yii::$app->request->post())
        ) {
            $model->importFile = UploadedFile::getInstance($model, 'importFile');
            if ($model->upload()) {
                $message = ImportForm::importTechnicsZ21();
                Yii::$app->session->setFlash('success', $message);
            } else {
                Yii::$app->session->setFlash('error', 'Не удалось загрузить файл!');
            }
        }
        return $this->render('technics-z21', ['model' => $model]);
    }

}
