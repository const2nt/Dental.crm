<?php

namespace frontend\controllers;

use common\models\PatientProfile;
use frontend\models\SearchForm;
use Yii;
use common\models\Patients;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientController implements the CRUD actions for Patients model.
 */
class PatientController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Patients models.
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new SearchForm();

        $dataProvider = new ActiveDataProvider([
            'query' => Patients::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'model'=> $model,
            'data'=>$this->getPatientsArray(),
            'search'=> $this->Search(),
            'lastpatient'=>$this->getLastPatientCardNumber()
        ]);
    }

    public function Search()
    {
        if(!empty($_POST['SearchForm']['search'])) {

            $getSearch = explode("|", $_POST['SearchForm']['search']);
            $query_card = $getSearch[2];
            $card_number = explode(" ",$query_card);
            $name = explode(" ",$getSearch[0]);
            $query = "`lastname`"." LIKE "."\"%".$name[0]."%\"";
            if(is_integer($card_number[3])) {          // TODO: удалить после создания автозаполнения "№ карточки"
                $query .= " OR ";
                $query .= "`patient_card`" . " LIKE " . "\"%" . $card_number[3] . "%\"";
            }

            $search = Patients::find()
                ->where($query)
                ->all();

            return $search;
        }
    }

    protected function getPatientsArray()
    {

        $data = Patients::find()->all();

        foreach ($data as $d ) {
            $data_array[] = $d->lastname." ".$d->firstname." ".$d->middlename." | тел. ".$d->phone." | № карты ".$d->patient_card;
        }

        return array_values($data_array);
    }

    public static function getLastPatientCardNumber()
    {
        $last_row = Patients::find()->orderBy(['id'=> SORT_DESC])->limit(1)->one();
        $number = $last_row->patient_card;
        return $number;
    }

    /**
     * Displays a single Patients model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model
        ]);
    }

    /**
     * Creates a new Patients model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Patients();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Patients model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Patients model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Patients model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Patients the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Patients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
