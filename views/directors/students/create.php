<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Students */

$this->title = 'Додати учня';
$this->params['breadcrumbs'][] = ['label' => 'Учні', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="students-create">

	<?php if (Yii::$app->controller->school__payment_type == 'all' && Yii::$app->user->identity->school->is_test == 'no') : ?>
    	<div class="alert alert-success">
    		Максимальна доступна кількість реєстрації учнів для Вашої школи - <strong><?= Yii::$app->controller->school__max_students ?></strong>. Можна додати ще: <strong><?= Yii::$app->controller->school__max_students - Yii::$app->controller->_count_students ?></strong>.
		</div>
    <?php endif; ?>

    <h1 class="h1-title"><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'request' => $request,
        'classes' => $classes,
    ]) ?>

</div>
