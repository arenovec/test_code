<?php

    use yii\helpers\Html;
    use yii\widgets\DetailView;

/* @var $this yii\web\View */
    /* @var $model app\models\Authors */

    \yii\web\YiiAsset::register($this);
?>
<div class="authors-view">

    <!-- Тут можно выводить через ListView, для текста вывожу через обычный цикл -->

    <h1>Список книг автора <a href="<?= yii\helpers\Url::toRoute(['/authors/view', 'id' => $model->id]) ?>"><?= $model->name ?></a></h1>

    <?php if(count($model->books)): ?>
            <?php foreach ($model->books as $key => $book_value): ?>

                <h2>Книга <a href="<?= yii\helpers\Url::toRoute(['/books/view', 'id' => $book_value->id]) ?>"><?= $book_value->title ?></a>, вышла в <?= $book_value->publishing ?>, рейтинг: <?= $book_value->rating ?></h2>

            <?php endforeach; ?>
        <?php else: ?>
            Книг не найдено
    <?php endif; ?>



</div>
