<?php

    use app\models\BooksSearch;
    use kartik\grid\GridView;
    use yii\data\ActiveDataProvider;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\web\View;

/* @var $this View */
    /* @var $searchModel BooksSearch */
    /* @var $dataProvider ActiveDataProvider */

    $this->title = 'Books';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="books-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Books', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                [
                    'class' => '\kartik\grid\DataColumn',
                    'attribute' => 'author_id',
                    'label' => 'Автор',
                    'vAlign' => 'middle',
                    'hAlign' => 'center',
                    'filterType' => GridView::FILTER_SELECT2,
                    'filter' => ArrayHelper::map(app\models\Authors::find()->all() , 'id', 'name'),
                    'filterWidgetOptions' => [
                        'pluginOptions' => ['allowClear' => true],
                    ],
                    'filterInputOptions' => ['placeholder' => 'Выберите атвора'],
                    'mergeHeader' => false,
                    'format' => 'raw',
                    'value' => function ($model, $key, $index, $widget)
                    {
                        return $model->author->name;
                    }
                ],
                'publishing',
                'title',
                'rating',
                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
    ?>
</div>
