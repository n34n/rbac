<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$cssString = '.table-striped > tbody > tr:nth-of-type(odd) {
                  background-color: #e5e5e5;
                }';
$this->registerCss($cssString);

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = 'View User: '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
    <div class="box-header with-border">
    <p>
        <?= Html::a('<i class="fa fa-plus-circle"> </i> Create', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        <?= Html::a('<i class="fa fa-pencil"> </i> Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary btn-sm']) ?>
        <?= Html::a('<i class="fa fa-lock"> </i> Change Password', ['changepwd', 'id' => $model->id], ['class' => 'btn btn-warning btn-sm']) ?>
        <?= Html::a('<i class="fa fa-trash-o"> </i> Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger btn-sm',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    </div>
   
    <div class=" box-body">
    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            'id',
            'username',
            'email:email',
            'mobile',
            [
                'attribute' => 'status',
                'value'=>   $model->status==10?'正常':'屏蔽',
            ],
            [
                'attribute' => 'created_at',
                'format' => ['date', 'php:Y-m-d h:i:s']
            ],
            [
            'attribute' => 'updated_at',
            'format' => ['date', 'php:Y-m-d h:i:s']
            ],
        ],
    ]) ?>
    </div>

</div>
