<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Language */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-8">
        <div class="box box-primary">

    <?php $form = ActiveForm::begin(
        [
        'options'     => ['class'=>'form-horizontal','enctype' => 'multipart/form-data'],
        'fieldConfig' => [
            'template'      => '{label}<div class="col-sm-10" style="padding-right:30px">{input}</div><div style="margin:8px 0 0 145px">{error}</div>',
            'labelOptions'  => ['class' => 'col-sm-2 control-label'],
        ],
        ]        
        ); ?>
    <div class="box-body">
    <?= $form->field($model, 'language')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

    <?php //$form->field($model, 'icon')->fileInput() ?>
    
    <?= $form->field($model, 'icon')->widget(FileInput::classname(), [
            'options' => ['accept' => 'image/*'],
            'pluginOptions' => [
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => true,
                'showUpload' => false,
/*                 'initialPreview'=>[
                    "http://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/FullMoon2010.jpg/631px-FullMoon2010.jpg",
                ],                
                'initialPreviewAsData'=>true,
                'initialCaption'=>"The Moon and the Earth",
                'initialPreviewConfig' => [
                    ['caption' => 'Moon.jpg', 'size' => '873727', 'url'=>'http://localhost/avatar/delete'],
                ],                
                'overwriteInitial'=>false, */
    
            ]
    ]);?>
    
    <?= $form->field($model, 'order')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'status')->dropDownList(['10' => Yii::t('backend', 'Approved'), '0' => Yii::t('backend', 'Denied')])->label(Yii::t('backend', 'Status')); ?>

    <div class="form-group" style="padding: 8px 0 0 145px">
        <?= Html::submitButton($model->isNewRecord ? '<i class="fa fa-plus-circle"> </i> '.Yii::t('backend', 'Create').'' : '<i class="fa fa-pencil"> </i> '.Yii::t('backend', 'Update').'', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>
    </div>

    <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
