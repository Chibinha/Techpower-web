<?php
namespace backend\controllers;
use Yii;
use common\models\Sale;
use common\models\SaleItem;
use common\models\SaleSearch;
use common\models\SaleItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\User;
use yii\filters\AccessControl;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
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
                        'actions' => ['index', 'view', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
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
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]); 
    }
    //  * Displays a single Sale model.
    //  * @param integer $id
    //  * @return mixed
    //  * @throws NotFoundHttpException if the model cannot be found
    public function actionView($id)
    {
        $sale = Sale::findOne($id);
        $searchModel = new SaleItemSearch();
        $dataProvider = $searchModel->search( [ $searchModel->formName() => ['id_sale' => $id]]);
        $user_id=$sale['id_user'];
        $get_user = User::findOne($user_id);
        
        return $this->render('view', [
            'model' => $sale,
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel,
            'cliente' => $get_user,
        ]);
    }
    /**
     * Updates an existing Sale model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $sale = Sale::findOne($id);
        
        if ($sale->load(Yii::$app->request->post()) && $sale->save()) {
            return $this->redirect(['view', 'id' => $sale->id]);
        }
        
        return $this->render('update', [
            'model' => $sale,
        ]);
    }
    /**
     * Deletes an existing Sale model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $sale = $this->findModel($id);   
        $sale->delete();
        return $this->redirect(['index']);
    }
    
    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}