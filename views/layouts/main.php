<?php

    use app\assets\IndexAsset;
    use yii\helpers\Html;

IndexAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
    <head>         
        <title><?= Html::encode($this->title) ?></title>
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <?php $this->head() ?>
        <?= Html::csrfMetaTags() ?>
    </head>
    <body>           
        <?php $this->beginBody() ?>
        <div class="global_container">
            <?= $content ?>
        </div>
        <?php $this->endBody() ?>
    </body>
</html>
<?php $this->endPage() ?>
