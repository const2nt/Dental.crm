<?php
/**
 * Created by PhpStorm.
 * User: Kostya
 * Date: 26.02.2017
 * Time: 17:11
 */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Timetable */
/* @var $form yii\widgets\ActiveForm */
?>
<?php
//if(!empty(print_r($_POST))) {
//    $id = $_POST['patient_id'];
//}

?>
<div class="timetable-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'date')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'start_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'end_time')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'full_name')
        ->textInput(isset($_POST['name']) ?
             ['maxlength' => true, 'value'=>$_POST['name']] :
            ['maxlength' => true] ) ?>

    <?=$form->field($model, 'primary')
        ->checkbox(isset($_POST['patient_id']) ?
        ['disabled'=>true] :
            [''])
    ?>

    <?= $form->field($model, 'doctor_id')->textInput() ?>

    <?= $form->field($model, 'notes')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'phone')
        ->textInput(isset($_POST['phone']) ?
            ['maxlength' => true, 'value'=>$_POST['phone']] :
            ['maxlength' => true])
    ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Сохранить запись' : 'Сохранить изминения', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?= $form->field($model, 'patient_id')
        ->hiddenInput(isset($_POST['patient_id']) ?
        ['value'=> $_POST['patient_id']] :
            ['value' =>''])
    ?>

    <?= $form->field($model, 'manager_id')->hiddenInput(['value' => Yii::$app->user->id]) ?>



    <?php ActiveForm::end(); ?>

</div>
