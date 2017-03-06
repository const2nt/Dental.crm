<?php

namespace frontend\controllers;

use common\models\Patients;
use common\models\Services;
use common\models\Timetable;
use Yii;
use common\models\PatientsDiagnoses;
use common\models\PatientsTreatments;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PatientsTreatmentsController implements the CRUD actions for PatientsDiagnoses model.
 */
class PatientsTreatmentsController extends Controller
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
     * Lists all PatientsDiagnoses models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => PatientsDiagnoses::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PatientsDiagnoses model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'diagnoses' => $this->findModelDiagnoses($id),
            'treatments' => $this->findModelTreatments($id),
        ]);
    }

    /**
     * Creates a new PatientsDiagnoses model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $diagnoses = new PatientsDiagnoses();
        $treatments = new PatientsTreatments();

        if ($diagnoses->load(Yii::$app->request->post()) && $diagnoses->save()) {

            $services =json_encode(Yii::$app->request->post('services_id'));
            $treatments->services_id = $services;
            $treatments->patient_id = $diagnoses->patient_id;

            if ($treatments->load(Yii::$app->request->post()) && $treatments->save()) {

                return $this->redirect(['view', 'id' => $diagnoses->id]);
            }
        } else {
            return $this->render('create', [
                'diagnoses' => $diagnoses,
                'treatments' => $treatments,
                'services' => $this->getServicesList(),
                'patients' => $this->getPatientsList(Yii::$app->user->id)
            ]);
        }
    }

    /**
     * Updates an existing PatientsDiagnoses model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $diagnoses = $this->findModelDiagnoses($id);
        $treatments = $this->findModelTreatments($id);

        if ($diagnoses->load(Yii::$app->request->post()) && $diagnoses->save()) {

            $services =json_encode(Yii::$app->request->post('services_id'));
            $treatments->services_id = $services;

            if($treatments->load(Yii::$app->request->post()) && $treatments->save()) {

                return $this->redirect(['view', 'id' => $diagnoses->id]);
            }
        } else {
            return $this->render('create', [
                'diagnoses' => $diagnoses,
                'treatments' => $treatments,
                'services' => $this->getServicesList(),
                'patients' => $this->getPatientsList(Yii::$app->user->id)
            ]);
        }
    }

    /**
     * Deletes an existing PatientsDiagnoses model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModelDiagnoses($id)->delete();
        $this->findModelTreatments($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PatientsDiagnoses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientsDiagnoses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelDiagnoses($id)
    {
        if (($model = PatientsDiagnoses::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * Finds the PatientsDiagnoses model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PatientsDiagnoses the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelTreatments($id)
    {
        if (($model = PatientsTreatments::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     * @return array
     * get services list for select
     */
    protected function getServicesList()
    {
        $services = Services::find()->all();
        $services_array = ArrayHelper::map($services,'id','service_name');

        return $services_array;
    }

    /**
     * @param $doctor_id
     * @return mixed
     * Get patients only for the logged-in doctor and
     * only those who are registered at the current reception
     */
    protected function getPatientsList($doctor_id)
    {
        $timetable = Timetable::find()->where(['doctor_id'=>$doctor_id,'date'=>strtotime(date('d-m-Y',time()))])->all();
        $timetable_arr = ArrayHelper::map($timetable,'id','patient_id');

        foreach($timetable_arr as $patient_id){
                $patient = Patients::findOne($patient_id);
                $patients_array[$patient->id] = $patient->lastname.' '.$patient->firstname.' '.$patient->middlename;
        }

        return $patients_array;
    }
}

