<?php

    use app\models\Books;
    use yii\bootstrap\Html;
    use yii\helpers\Url;
    use yii\web\View;
    use yii\web\YiiAsset;
    use yii\widgets\DetailView;

/* @var $this View */
    /* @var $model Books */

    $this->title = $model->title;
    $this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
    $this->params['breadcrumbs'][] = $this->title;
    YiiAsset::register($this);
?>
<div class="books-view">

    <h1><a href="<?= Url::toRoute(['/books']) ?>">Список книг</a></h1>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?=
            Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
        ?>
    </p>

    <?=
        DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                [
                    'attribute' => 'author_id',
                    'format' => 'raw',
                    'value' => function($data)
                    {
                        return Html::a($data->author->name, ["/authors/view", 'id' => $data->author->id]);
                    }
                ],
                'publishing',
                'title',
                'rating',
            ],
        ])
    ?>

</div>
