<?php

    use app\models\AuthorsSearch;
    use kartik\grid\GridView;
    use yii\data\ActiveDataProvider;
    use yii\helpers\Html;
    use yii\helpers\Url;
    use yii\web\View;

/* @var $this View */
    /* @var $searchModel AuthorsSearch */
    /* @var $dataProvider ActiveDataProvider */

    $this->title = 'Authors';
    $this->params['breadcrumbs'][] = $this->title;
?>
<div class="authors-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Authors', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?=
        GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [               
                'id',
                'name',
                'birthday',
                'rating',
                [
                    'class' => 'kartik\grid\ActionColumn',
                    'template' => '{view}{update}{delete}{books}',
                    'dropdown' => false,
                    'dropdownOptions' => ['class' => 'pull-right'],
                    "headerOptions" => ["class" => "kartik-sheet-style"],
                    'viewOptions' => [
                        'target' => '_blank'
                    ],
                    'buttons' => [
                        'books' => function ($url, $model, $key)
                        {
                            return '<a href="/ru/authors/get-books?author_id='.$model->id.'" title="Просмотр" aria-label="Просмотр" data-pjax="0" target="_blank"><span class="fa fa-book" aria-hidden="true"></span></a>';
                        },
                    ],
                ]
            ],
        ]);
    ?>
</div>
