<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;

//use mdm\admin\components\AccessControl;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';

$this->params['breadcrumbs'][] = $this->title;

?>

<div class="box">
    <div class="box-header with-border">

        <?= Html::a('<i class="fa fa-plus-circle"> </i> Create', ['create'], ['class' => 'btn btn-success btn-sm']) ?>
        
        <div class="box-tools">
            <?php $form = ActiveForm::begin([
                            'action' => ['index'],
                            'method' => 'get',
                            'id' => 'search-form',
                            'options' => ['class' => 'form-horizontal'],
                        ]); ?>
                            <div class='input-group input-group-sm' style='width: 300px;margin-top:5px;'>
                            <?= $form->field($searchModel, 'skey',[
                                  'options'=>['class'=>'input-group input-group-sm','style'=>'width: 300px;'],
                                  'inputOptions' => ['placeholder' => 'Search Keyword','class' => 'form-control pull-right'],
                                    ])->label(false); ?>
                             <div class="input-group-btn">
                                <button class="btn btn-default" type="submit">
                                <i class="fa fa-search"></i>
                                </button>
                             </div>
                             </div>

            <?php ActiveForm::end(); ?>
        </div>    
    </div>    
    
<?php Pjax::begin(); ?> 

<?= GridView::widget([
    'layout' => '<div class="bg-light-blue disabled color-palette alert" style="margin-bottom:0">{summary}</div>
                 <div class="box-body">{items}</div>
                 <div class="box-footer clearfix pull-right">{pager}</div>',
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        
        'options' => [
            'class' => 'box-body',
        ],
    
        'tableOptions' => ['class' => 'table table-hover'],
 
        'columns' => [
            'id' => [
                    'attribute' => 'id',
                    'enableSorting' => false,
                ],
                
                'username' => [
                    'attribute' => 'username',
                    //'enableSorting' => false,
                ],
                
                 'email' => [
                     'attribute' => 'email',
                     //'enableSorting' => false,
                 ],
                
                 'mobile' => [
                     'attribute' => 'mobile',
                     //'enableSorting' => false,
                 ],
                
                 'status' => [
                    'attribute' => 'status',
                    //'template' => '<span class="label label-success">{value}</span>',
                     'format' => 'html',
                    'value'=> function($model){
                        return  $model->status==10?'<span class="label label-success">正常</span>':'<span class="label label-danger">禁用</span>';
                    },
                    'enableSorting' => false,
                ],
                
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'php:Y-m-d h:i:s'],
                    'enableSorting' => false,
                ],

                [
                    'class' => 'yii\grid\ActionColumn',
                       /*  'template' => '{view}&nbsp;&nbsp;{update}&nbsp;&nbsp;{changepwd}&nbsp;&nbsp;{delete}',
                       'template' => function(){
                            $template = '';
                            if(1==1){
                                $template .= '{view}&nbsp;&nbsp;';
                            }
                            return $template;
                         }, 
                    	'auth'=>[
        					'update'=>function($url, $model, $key){
        						//这里任意判断，只要不return true，就会认为无权限
        					}
        				 ], */
                        'template' => $template,
                         
                        'buttons' => [
                            'changepwd' => function ($url, $model, $key) {
                                
                                return  Html::a('<span class="glyphicon glyphicon-lock"></span>', $url, ['title' => '修改密码'] ) ;
                            },
                         ],                    
                ],
        ],
    ]); ?>
<?php Pjax::end(); ?>
</div>
