<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $model backend\models\User */
/* @var $form yii\widgets\ActiveForm */
//$listData=ArrayHelper::map('正常','禁用');
?>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">
    <?php $form = ActiveForm::begin(
            [
                'options'     => ['class'=>'form-horizontal'],
                'fieldConfig' => [
                    'template'      => '{label}<div class="col-sm-10" style="padding-right:30px">{input}</div><div style="margin:8px 0 0 145px">{error}</div>',
                    'labelOptions'  => ['class' => 'col-sm-2 control-label'],
                 ],
            ]
        ); ?>
        <div class="box-body">
    <?php  
        if($model->isNewRecord)
        {
            echo $form->field($model, 'username')->textInput(['maxlength' => true])->label(Yii::t('backend', 'Username'));
        }else{
            echo $form->field($model, 'username',['inputOptions' => ['class'=>'form-control','disabled'=>'']])->textInput(['maxlength' => true])->label(Yii::t('backend', 'Username'));
        }
    ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true])->label(Yii::t('backend', 'Email')); ?>

    <?= $form->field($model, 'mobile')->textInput(['maxlength' => true])->label(Yii::t('backend', 'Mobile')); ?>
    
    <?php if($model->isNewRecord)
          {
              echo $form->field($model, 'password')->passwordInput(['maxlength' => true])->label(Yii::t('backend', 'Password'));;
          }
    ?>
    
    <?= $form->field($model, 'status')->dropDownList(['10' => Yii::t('backend', 'Approved'), '0' => Yii::t('backend', 'Denied')])->label(Yii::t('backend', 'Status')); ?>
    
        <div class="form-group" style="padding: 8px 0 0 145px">
            <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus-circle"> </i> '.Yii::t('backend', 'Create').'' : '<i class="fa fa-pencil"> </i> '.Yii::t('backend', 'Update').'', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
        </div>
    <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
