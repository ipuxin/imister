<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;
use yii\widgets\LinkPager;
?>
<?= Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        '用户列表',
    ]
]) ?>
<div class="inner-container">
    <p class="text-right">
        <a class="btn btn-primary btn-middle" href="<?= Url::to(['add']) ?>">添加</a>
        <a id="delete-btn" class="btn btn-primary btn-middle">删除</a>
    </p>
    <form method="post" action="/mrsblog/backend/web/index.php?r=slideshow%2Fdelete" id="dltForm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center"><input type="checkbox"
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
                    <td class="text-center"><input type="checkbox" name="selected[]" value="1"></td>
                    <td><?= $value['username'] ?></td>
                    <td><?= $value['login_ip'] ?></td>
                    <td><?= date('Y-m-d H:i:s', $value['login_date']) ?></td>
                    <td><?= date('Y-m-d H:i:s', $value['date']) ?></td>
                    <td><?= $value['status'] == 1 ? '开启' : '禁用'; ?></td>
                    <td><a href="#" title="编辑" class="data_op data_edit"></a> | <a href="javascript:void(0);" title="删除"
                                                                                   class="data_op data_delete"></a></td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </form>
    <?= LinkPager::widget([
        'pagination' => $pagination,
    ]) ?>
</div>
<script type="text/javascript">
    $(function () {
        $("#delete-btn").click(function () {
            if (confirm('您确定要删除 ,这是不可恢复操作')) {
                $("#dltForm").submit();
            }
        });

        $(".data_delete").click(function () {
            $("#dltForm").find('input[type=checkbox]').prop('checked', false);
            $(this).parent().parent().find('input[type=checkbox]').prop('checked', true);
            $("#delete-btn").click();
        });

    });
</script>
