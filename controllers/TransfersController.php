<?php

namespace app\controllers;

use app\models\Materials;
use app\models\RawTechnics;
use app\models\Technics;
use app\models\Transfers;
use app\models\TransfersSearch;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use Yii;

/**
 * TransfersController implements the CRUD actions for Transfers model.
 */
class TransfersController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Transfers models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TransfersSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Transfers model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transfers model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionCreate()
    {
        $model = new Transfers();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Transfers model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Transfers model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Transfers model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Transfers the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transfers::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /***
     * Create form with data from $refTable with $id
     * @param $id
     * @param $refTable
     * @return string|Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionCreateFrom()
    {
        $request = Yii::$app->request;
        $id = $request->get('id');
        $refTable = $request->get('refTable');
        $model = new Transfers();
            if  ($refTable=='technics')
            {
                $technics = Technics::findOne($id);
                if (!@is_null($technics)) {
                    $model->name = $technics->name;
                    $model->inventory_number = $technics->inventory_number;
                    $model->serial_number = $technics->serial_number;
                    $model->count = 1;
                    $model->ref_table_id = $id;
                    $model->ref_table_name = $refTable;
                    $model->date = time();
                } else {
                    $model->count = 1;
                    $model->date = time();
                    Yii::$app->session->setFlash('error', 'Не удалось найти данную единицу техники!');
                }
            }
            elseif  ($refTable=='materials')
            {
                $materials = Materials::findOne($id);
                if (!@is_null($materials)) {
                    $model->name = $materials->name;
                    $model->count = 1;
                    $model->ref_table_id = $id;
                    $model->ref_table_name = $refTable;
                    $model->date = time();
                } else {
                    $model->count = 1;
                    $model->date = time();
                    Yii::$app->session->setFlash('error', 'Не удалось найти данную единицу расходного материла!');
                }
            }
            elseif  ($refTable=='raw_technics')
            {
                $rawTechnics = RawTechnics::findOne($id);
                if (!@is_null($rawTechnics)) {
                    $model->name = $rawTechnics->name;
                    $model->inventory_number = $rawTechnics->inventory_number;
                    $model->serial_number = $rawTechnics->serial_number;
                    $model->count = 1;
                    $model->ref_table_id = $id;
                    $model->ref_table_name = $refTable;
                    $model->date = time();
                } else {
                    $model->count = 1;
                    $model->date = time();
                    Yii::$app->session->setFlash('error', 'Не удалось найти данную единицу техники!');
                }
            }
            else

            {
                $model->count = 1;
                $model->date = time();
                Yii::$app->session->setFlash('error', 'Не удалось определить референсную таблицу для копирования данных!');
            }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }


        return $this->render('create-from', [
            'id' => $id,
            'refTable' => $refTable,
            'model' => $model
        ]);
    }
}
