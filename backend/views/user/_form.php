<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
//$listData=ArrayHelper::map('正常','禁用');
?>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
        <div class="box-body">
    <?php $form = ActiveForm::begin(); ?>

    <?php  
        if($model->isNewRecord)
        {
            echo $form->field($model, 'username')->textInput(['maxlength' => true]);
        }else{
            echo $form->field($model, 'username',['inputOptions' => ['class'=>'form-control','disabled'=>'']])->textInput(['maxlength' => true]);
        }
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true]) ?>
    
    <?php if($model->isNewRecord)
          {
              echo $form->field($model, 'password')->passwordInput(['maxlength' => true]);
          }
    ?>
    
    <?= $form->field($model, 'status')->dropDownList(['10' => '正常', '0' => '禁用']) ?>
    
    <div class="form-group" style="padding-top: 15px">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus-circle"> </i> Create' : '<i class="fa fa-pencil"> </i> Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
        </div>
        </div>
    </div>
</div>
