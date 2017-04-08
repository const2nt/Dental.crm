<?php

namespace frontend\controllers;

use common\models\Services;
use common\models\PatientsDiagnoses;
use common\models\PatientsTreatments;
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

    public function getLastPatientCardNumber()
    {
        $last_row = Patients::find()->orderBy(['id'=> SORT_DESC])->limit(1)->one();
        $number = $last_row->patient_card;
        return $number;
    }

    static public function createPatientIfPrimary($full_name,$phone)
    {
        $name = explode(" ",$full_name);

        $model = new Patients();
        $model->lastname = $name[0];
        $model->firstname = $name[1];
        $model->middlename = $name[2];
        $model->registration_date = date('d-m-Y',time());
        $model->phone = $phone;
        $model->patient_card = PatientController::getLastPatientCardNumber() + 1;
        $model->save();

        return $model->id;
    }

    /**
     * Displays a single Patients model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $diagnosesStory = $this->getDiagnosesStory($id);
        $treatmentsStory = $this->getTreatmentsStory($id);

        return $this->render('view', [
            'model' => $model,
            'diagnosesStory'=> $diagnosesStory,
            'treatmentsStory'=> $treatmentsStory
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

    protected function getDiagnosesStory($id)
    {   
        $diagnoses = PatientsDiagnoses::find()
                ->where(['patient_id'=>$id])
                ->all();

        return $diagnoses;
    }

    protected function getTreatmentsStory($id)
    {
        $treatments = PatientsTreatments::find()
                ->where(['patient_id'=>$id])
                ->asArray()
                ->all();
        foreach ($treatments as $key) {
            $services[]= json_decode($key['services_id']);
            foreach ($services[0] as $ser_id) {

                $serv[] = Services::find()
                ->where(['id'=>$ser_id])
                ->asArray()
                ->one();
            }

        }
        foreach ($treatments as $keys) {
            $keys[] = $serv;
        }

        return $treatments;
    }

}
