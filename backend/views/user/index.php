<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\LinkPager;
use \yii;
use yii\helpers\Html;

/**
 * 注册自定义js,依赖jQuery
 */
$this->registerJsFile('@web/js/index-list.js', ['depends' => 'yii\web\JqueryAsset']);

?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        '用户列表',
    ]
]) ?>
<div class="inner-container">
    <?php
    /**
     * 添加yii2自带的提示样式
     */
    if (Yii::$app->session->hasFlash('success')) {
        ?>
        <div class="alert alert-success">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?= Yii::$app->session->getFlash('success') ?>
        </div>
    <?php } ?>
    <?php if (Yii::$app->session->hasFlash('error')) { ?>
        <div class="alert alert-danger">
            <a href="#" class="close" data-dismiss="alert">&times;</a>
            <?= Yii::$app->session->getFlash('error') ?>
        </div>
    <?php } ?>
    <p class="text-right">
        <a class="btn btn-primary btn-middle" href="<?= Url::to(['add']) ?>">添加</a>
        <a id="delete-btn" class="btn btn-primary btn-middle">删除</a>
    </p>
    <?= Html::beginForm(['delete'], 'post', ['id' => 'dltForm']) ?>
    <table class="table table-hover">
        <thead>
        <tr>
            <th class="text-center">
                <input type="checkbox"
                       onclick="$('input[name*=\'selected\']').prop('checked',this.checked);">
            </th>
            <th>用户名</th>
            <th>登录ip</th>
            <th>登录时间</th>
            <th>创建时间</th>
            <th>状态</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($result as $value) { ?>
            <tr>
                <td class="text-center">
                    <!--比较好的Yii2表单处理之checkbox处理-->
                    <input type="checkbox" name="selected[]" value="<?= $value['id'] ?>">
                </td>
                <td><?= $value['username'] ?></td>
                <td><?= $value['login_ip'] ?></td>
                <td><?= date('Y-m-d H:i:s', $value['login_date']) ?></td>
                <td><?= date('Y-m-d H:i:s', $value['date']) ?></td>
                <td><?= $value['status'] == 1 ? '开启' : '禁用'; ?></td>
                <td><a href="<?= Url::to(['edit', 'id' => $value['id']]) ?>" title="编辑"
                       class="data_op data_edit"></a> |
                    <a href="javascript:void(0);" title="删除" class="data_op data_delete"></a></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
    <?= Html::endForm(); ?>
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]) ?>
</div>