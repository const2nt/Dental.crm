<?php
namespace frontend\controllers;
use common\models\Patients;
use common\models\PatientsSearch;
use common\models\UserProfile;
use frontend\models\SearchForm;
use Yii;
use common\models\Timetable;
use common\models\TimetableSearch;
use yii\data\Pagination;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * TimetableController implements the CRUD actions for Timetable model.
 */
class TimetableController extends Controller
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
     * Lists all Timetable models.
     * @return mixed
     */
    public function actionIndex()
    {
//        $searchModel = new TimetableSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dates' => $this->getArray($this->getRange()),
        ]);
    }
    /**
     * @return string
     * to search in reception journal
     */
    public function actionSearch()
    {
        return $this->render('search',[
            'dates' => $this->getArrayDates(Yii::$app->request->post('from_date'), Yii::$app->request->post('to_date'))
        ]);
    }
    public function getArrayDates($starts,$finishes)
    {
        $start = strtotime($starts);
        $finish = strtotime($finishes);
        if (!empty($starts) && !empty($finishes)) {
            $arrayOfDates = array();
            $i = $start;
            do {
                $arrayOfDates[] = $i;
                $i += 86400;
            } while ($i <= $finish);
            return $this->getArray($arrayOfDates);
        }
    }
    /**
     * @return array
     * get array on range dates
     */
    public function getRange()
    {
        $amount = 13;
        $arr[] = strtotime(date('d-m-Y', time()));
        for($i=1;$i<=$amount;$i++){
            $arr[] = strtotime(date('d-m-Y', time()+$i*24*60*60));
        }
        return $arr;
    }
    protected function getArray($array)
    {
        foreach ($array as $date){
            if($this->getAllPatientsArray($date) == false){
                $doctors[] =[
                    'date' => $date,
                    'doctor_id' => "Нет записей",
                ];
            }else{
                $doctors[] = [
                    'date' => $date,
                    'doctor_id' => $this->getDoctorsId($date),
                    'doctors_profile'=>$this->getDoctorsProfileId($this->getDoctorsId($date)),
                    'patients' => $this->getAllPatientsArray($date),
                    'patients_profile' =>$this->getPatientsId($date)
                ];
            }
        }
        return $doctors;
    }
    protected function getAllPatientsArray($setdate)
    {
        $array[] = Timetable::find()
            ->where(['date' => strtotime(date('Y-m-d', $setdate))])
            ->AsArray()
            ->all();
        return $array[0] ;
    }
    /**
     * @param $setdate
     * @return array
     * получает массив ID докторов у которых есть приемы
     */
    protected function getDoctorsId($setdate)
    {
        foreach ($this->getAllPatientsArray($setdate) as $card){
            $arrays[] = $card['doctor_id'];
        }
        $doctors[] = array_unique($arrays);
        return $doctors[0];
    }

    protected function getPatientsId($setdate)
    {
        foreach ($this->getAllPatientsArray($setdate) as $card){
            $arrays[] = $card['patient_id'];
        }
        foreach($arrays as $patient_id)
        {
             $patients[] = $this->findModelPatientArray($patient_id);
        }
        return $patients;
    }

    protected  function getDates($setdate)
    {
        foreach($this->getAllPatientsArray($setdate) as $card){
            $array[] = strtotime(date('Y-m-d', $card['date']));
        }
        $dates = array_unique($array);
        return $dates;
    }

    protected function getDoctorsPosition()
    {
        $doctors = UserProfile::find()->where(['position'=>'3'])->all();
        $doctors_array = ArrayHelper::map($doctors,'user_id','lastname');

        return $doctors_array;
    }
    /**
     * Displays a single Timetable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $profile = $this->findModelPatient($model->patient_id);
        $doctor = $this->findModelUser($model->doctor_id);
        $manager=$this->findModelUser($model->manager_id);
        return $this->render('view', [
            'model' => $model,
            'profile'=> $profile,
            'doctor'=>$doctor,
            'manager'=>$manager
        ]);
    }
    /**
     * Creates a new Timetable model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Timetable();
        $modelSearch = new SearchForm();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create',
                isset($_POST['patient_id']) ?
                    [
                        'model' => $model,
                        'patient' => $this->findModelPatient($_POST['patient_id'])
                    ] :
                    [
                        'modelSearch'=> $modelSearch,
                        'model' => $model,
                        'data' => '',
                    ]
            );
        }
    }
    /**
     * Updates an existing Timetable model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        $profile = $this->findModelPatient($model->patient_id);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'profile' => $profile,
                'doctors' => $this->getDoctorsPosition()
            ]);
        }
    }
    public function actionFormCreate()
    {
        return $this->render('formCreate', ['doctors' => $this->getDoctorsPosition()]);
    }
    /**
     * Deletes an existing Timetable model.
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
     * Finds the Timetable model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Timetable the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Timetable::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    protected function findModelPatient($id)
    {
        if (($model = Patients::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelPatientArray($id)
    {
        if ((
            $model = Patients::find()
                ->where(['id'=>$id])
                ->asArray()
                ->one()
            ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUser($id)
    {
        if (($model = UserProfile::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function findModelUserProfile($id)
    {
        if ((
            $model = UserProfile::find()
                ->where(['user_id'=>$id])
                ->asArray()
                ->one()
            ) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    private function getDoctorsProfileId($doctors_id)
    {
        foreach ($doctors_id as $doctor_id)
        {
            $doctors[] = $this->findModelUserProfile($doctor_id);

        }
        return $doctors;

    }
}