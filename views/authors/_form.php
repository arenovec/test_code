<?php

    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
    /* @var $model app\models\Authors */
    /* @var $form yii\widgets\ActiveForm */
?>

<div class="authors-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?=
        $form->field($model, 'birthday')->widget(\kartik\date\DatePicker::class, [
            'pluginOptions' => [
                'autoclose' => true,
                'format' => 'yyyy-mm-dd'
            ]
        ])
    ?>

        <?= $form->field($model, 'rating')->textInput() ?>

    <div class="form-group">
    <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
