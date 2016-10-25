<?php
    use yii\widgets\Breadcrumbs;
?>
<?=Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        ['label' => '文章列表' , 'url' => ['index']],
        '编辑用户'
    ]
])?>
<?=$this->render('_form' , ['model' => $model, 'categorys' => $categorys])?>