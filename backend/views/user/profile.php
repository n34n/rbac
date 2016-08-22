<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

$cssString = '.table-striped > tbody > tr:nth-of-type(odd) {
                  background-color: #e5e5e5;
                }';
$this->registerCss($cssString);

/* @var $this yii\web\View */
/* @var $model backend\models\User */

$this->title = Yii::t('backend', 'Profile');
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'My Account'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="box">
  
    <div class=" box-body">
    <?= DetailView::widget([
        'model' => $model,
        
        'attributes' => [
            'username' => [
                'attribute' => 'username',
                'label' => Yii::t('backend', 'Username'),
                //'enableSorting' => false,
            ],
            'email' => [
                'attribute' => 'email',
                'label' => Yii::t('backend', 'Email'),
                'format' => 'email',
                //'enableSorting' => false,
            ],            
            'mobile' => [
                'attribute' => 'mobile',
                'label' => Yii::t('backend', 'Mobile'),
            ],           
            [
                'attribute' => 'created_at',
                'label' => Yii::t('backend', 'Created at'),
                'format' => ['date', 'php:Y-m-d h:i:s'],
            ],
            [
                'attribute' => 'updated_at',
                'label' => Yii::t('backend', 'Updated at'),
                'format' => ['date', 'php:Y-m-d h:i:s']
            ],
        ],
    ]) ?>
    </div>

</div>
