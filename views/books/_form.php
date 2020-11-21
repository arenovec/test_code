<?php

    use app\models\Authors;
    use app\models\Books;
    use kartik\date\DatePicker;
    use kartik\widgets\Select2;
    use yii\helpers\ArrayHelper;
    use yii\helpers\Html;
    use yii\web\View;
    use yii\widgets\ActiveForm;

/* @var $this View */
    /* @var $model Books */
    /* @var $form ActiveForm */
?>

<div class="books-form">

    <?php $form = ActiveForm::begin(); ?>

    <?=
                $form->field($model, 'author_id')
                ->widget(Select2::classname(), [
                    'data' => ArrayHelper::map(Authors::find()->all(), 'id', 'name'),
                    'options' => [
                        'placeholder' => '',
                        'class' => 'input-lg',
                    ],
        ]);
    ?>

    <?=
        $form->field($model, 'publishing')->widget(DatePicker::class, [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'rating')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
