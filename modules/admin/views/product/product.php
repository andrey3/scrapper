<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View
 * @var $model app\modules\admin\models\ProductForm
 * @var $form ActiveForm
*/

?>
<div class="product">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['value' => $model->title]) ?>
    <?= $form->field($model, 'link')->textInput(['value' => $model->link]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>

</div>