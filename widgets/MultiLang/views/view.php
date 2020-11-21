<ul class="nav nav-tabs ">
    <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">          
            <?= '<img src="' . yii\helpers\Url::to('@web/img/' . $current->url) . '.png" class="pull-left"> '?>
            <p class="ru"><?= $current->name ?></p>
            <div class="clearfix"></div>

        </a>
        <div class="dropdown-menu">
            <?php foreach ($langs as $lang): ?>
            <a class="dropdown-item" href="<?=  '/' . $lang->url . \yii\helpers\Html::encode(Yii::$app->getRequest()->getLangUrl()) ?>">
                <?= '<img src="' . yii\helpers\Url::to('@web/img/' . $lang->url) . '.png" class="pull-left"> '?>
                <p class="lang_name"><?= $lang->name ?></p>
            </a>
            <?php endforeach; ?>  
        </div>
    </li>
</ul>