<?php

namespace frontend\controllers;

use common\models\Patients;
use common\models\PatientsSearch;
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
                    'doctor_id' => $this->getDoctors($date),
                    'patients' => $this->getAllPatientsArray($date)
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
    protected function getDoctors($setdate)
    {
        foreach ($this->getAllPatientsArray($setdate) as $card){

                $arrays[] = $card['doctor_id'];
        }
                $doctors[] = array_unique($arrays);

        return $doctors[0];
    }


    protected  function getDates($setdate)
    {
        foreach($this->getAllPatientsArray($setdate) as $card){
            $array[] = strtotime(date('Y-m-d', $card['date']));
        }
            $dates = array_unique($array);

        return $dates;
    }

    /**
     * Displays a single Timetable model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $date = $model->date;
        $start_time = $model->start_time;
        $end_time = $model->end_time;

        return $this->render('view', [
            'model' => $model,
            'date' => $date,
            'start_time' => $start_time,
            'end_time' => $end_time,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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

}
