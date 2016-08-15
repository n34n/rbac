<?php

namespace backend\controllers;

use Yii;
use backend\models\Role;
use backend\models\search\RoleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Permissions;
use yii\base\Object;

/**
 * RoleController implements the CRUD actions for Role model.
 */
class RoleController extends Controller
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
     * Lists all Role models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RoleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Role model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model          = $this->findModel(['=', 'name', $id]);
        
        //get roles
        $searchModel    = new RoleSearch();
        $roles          = $searchModel->find('name')->Where(['=', 'type', 1])->all();
        
        //get checked roles
        $permission     = new Permissions();
        $roleschecked   = $permission->find('child')->Where(['=', 'parent', $model->name])->all();
        
        //get permissions
        $searchModel    = new RoleSearch();
        $permissions    = $searchModel->find()
                        ->Where(['=', 'type', 2])
                        ->andWhere(['not like', 'name', 'ctl'])
                        ->andWhere(['not like', 'name', 'gii'])
                        ->andWhere(['not like', 'name', 'debug'])
                        ->all(); 
        
        //get checked roles
        $permission     = new Permissions();
        $permissionschecked   = $permission->find('child')->Where(['=', 'parent', $model->name])->all();        
        
        
        return $this->render('view', [
            'model'         => $model,
            'roles'         => $roles,
            'roleschecked'  => $roleschecked,
            'permissions'   => $permissions,
            'permissionschecked'   => $permissionschecked,
        ]);
    }

    /**
     * Creates a new Role model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Role();
        $searchModel = new RoleSearch();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            $model->type        = 1;
            $model->created_at  = $model->updated_at = time();
            $model->save();

            if($_POST['Role']['_roles']){
                $_rolesList         = $_POST['Role']['_roles'];
                foreach ($_rolesList as $val){
                    $rolechild = new Permissions();
                    $rolechild->parent  = $model->name;
                    $rolechild->child   = $val;
                    $rolechild->save();
                }                
            }
            
            if($_POST['Role']['_permissions']){
                $_permissionsList   = $_POST['Role']['_permissions'];
                foreach ($_permissionsList as $val){
                    $rolechild = new Permissions();
                    $rolechild->parent  = $model->name;
                    $rolechild->child   = $val;
                    $rolechild->save();
                }
            }     
             
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            $roles       = $searchModel->find()->Where(['=', 'type', 1])->all();//Yii::$app->request->queryParams);
            $permissions = $searchModel->find()
            ->Where(['=', 'type', 2])
            ->andWhere(['not like', 'name', 'ctl'])
            ->andWhere(['not like', 'name', 'gii'])
            ->andWhere(['not like', 'name', 'debug'])
            ->all();            
            return $this->render('create', [
                'model' => $model,
                'roles' => $roles,
                'permissions' => $permissions,
            ]);
        }
    }

    /**
     * Updates an existing Role model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->name]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Role model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Role model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Role the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Role::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
