<?php

    namespace app\controllers;

    use Yii;
    use app\models\Authors;
    use app\models\AuthorsSearch;
    use yii\web\Controller;
    use yii\web\NotFoundHttpException;
    use yii\filters\VerbFilter;

    /**
     * AuthorsController implements the CRUD actions for Authors model.
     */
    class AuthorsController extends Controller
    {

        /**
         * {@inheritdoc}
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
         * Lists all Authors models.
         * @return mixed
         */
        public function actionIndex()
        {
            $searchModel = new AuthorsSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }

        /**
         * Displays a single Authors model.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionView($id)
        {
            return $this->render('view', [
                        'model' => $this->findModel($id),
            ]);
        }

        /**
         * Creates a new Authors model.
         * If creation is successful, the browser will be redirected to the 'view' page.
         * @return mixed
         */
        public function actionCreate()
        {
            $model = new Authors();

            if($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                        'model' => $model,
            ]);
        }

        /**
         * Updates an existing Authors model.
         * If update is successful, the browser will be redirected to the 'view' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionUpdate($id)
        {
            $model = $this->findModel($id);

            if($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('update', [
                        'model' => $model,
            ]);
        }

        public function actionGetBooks($author_id)
        {

            //Можно было сделать через провайдер, но как вариант сделал так 
            
            $model = Authors::find()
                    ->where(['authors.id' => $author_id])
                    ->with(['books' => function (\yii\db\ActiveQuery $query)
                        {
                            $query ->orderBy(['publishing' => SORT_ASC]);
                        }])    
                    ->one();

            return $this->render(\Yii::$app->controller->action->id, [
                        'model' => $model
            ]);
        }

        /**
         * Deletes an existing Authors model.
         * If deletion is successful, the browser will be redirected to the 'index' page.
         * @param integer $id
         * @return mixed
         * @throws NotFoundHttpException if the model cannot be found
         */
        public function actionDelete($id)
        {
            $this->findModel($id)->delete();

            return $this->redirect(['index']);
        }

        /**
         * Finds the Authors model based on its primary key value.
         * If the model is not found, a 404 HTTP exception will be thrown.
         * @param integer $id
         * @return Authors the loaded model
         * @throws NotFoundHttpException if the model cannot be found
         */
        protected function findModel($id, $with = [])
        {

            $model = Authors::find()
                    ->where(['id' => $id])
                    ->with($with)
                    ->one();

            if($model !== null)
                return $model;

            throw new NotFoundHttpException('The requested page does not exist.');
        }

    }
    