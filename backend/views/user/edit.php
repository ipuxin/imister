<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\helpers\Html;

?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '用户列表', 'url' => ['index']],
        '编辑用户'
    ]
]) ?>
<?=$this->render('_form' , ['model' => $model])?>