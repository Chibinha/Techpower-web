<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use common\models\Profile;
use common\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['index', 'view', 'create', 'update', 'delete', 'assignworker', 'revokeworker'],
                        'allow' => true,
                        'roles' => ['admin'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $user = $this->findModel($id);
        $profile = $user->getProfiles();
        return $this->render('view', [
            'model' => $user,
            'profile' => $profile,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $profile = $model->getProfiles();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        $role = \Yii::$app->authManager->checkAccess($id, 'worker');

        return $this->render('update', [
            'model' => $model,
            'perfil' => $profile,
            'role' => $role,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->status = '0';
        $model->save();
        return $this->redirect(['index']);
    }

    public function actionAssignworker($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('worker');
            $auth->assign($authorRole, $model->getId());
            \Yii::$app->session->addFlash('success', 'Role Assigned.');
        } else {
            \Yii::$app->session->addFlash('error', 'Error Assigning role.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }
    
    public function actionRevokeworker($id)
    {
        $model = $this->findModel($id);
        if ($model) {
            $auth = \Yii::$app->authManager;
            $authorRole = $auth->getRole('worker');
            $auth->revoke($authorRole, $model->getId());
            \Yii::$app->session->addFlash('success', 'Role revoked.');
        } else {
            \Yii::$app->session->addFlash('error', 'Error Revoking role.');
        }

        return $this->redirect(['view', 'id' => $model->id]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
