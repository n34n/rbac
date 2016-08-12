<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\LanguageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Languages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="box">
    <div class="box-header with-border">

        
    <?php 
        if(Yii::$app->user->can('语言设置')){
            echo Html::a('<i class="fa fa-plus-circle"> </i> '.Yii::t('backend', 'Create').'', ['create'], ['class' => 'btn btn-success btn-sm']);
        }else{
            echo '<a class="btn btn-sm"></a>';
        }
    ?>


    <?= GridView::widget([
        'layout' => '<div class="box-body">{items}</div>
                 <div class="box-footer clearfix pull-right">{pager}</div>',        
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            //['class' => 'yii\grid\SerialColumn'],

            //'id',
            'icon' => [
                'attribute' => 'icon',
                'format' => 'html',
                'value'  => function($model){
                    return Html::img(FILE_PATH.$model->icon, array('width'=>'30px'));
                },
                'enableSorting' => false,
             ],
            'code',
            'language',
            //'icon',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
</div>