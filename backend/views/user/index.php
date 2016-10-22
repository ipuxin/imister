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
        <a class="btn btn-primary btn-middle" href="#">添加</a>
        <a id="delete-btn" class="btn btn-primary btn-middle">删除</a>
    </p>
    <form method="post" action="/mrsblog/backend/web/index.php?r=slideshow%2Fdelete" id="dltForm">
        <table class="table table-hover">
            <thead>
            <tr>
                <th class="text-center"><input type="checkbox"
                                               onclick="$('input[name*=\'selected\']').prop('checked',this.checked);">
                </th>
                <th>名称</th>
                <th>图片</th>
                <th>链接</th>
                <th>状态</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="text-center"><input type="checkbox" name="selected[]" value="1"></td>
                <td>万能的蜘蛛</td>
                <td>图片</td>
                <td>#</td>
                <td>开启</td>
                <td><a href="#" title="编辑" class="data_op data_edit"></a> | <a href="javascript:void(0);" title="删除"
                                                                               class="data_op data_delete"></a></td>
            </tr>
            </tbody>
        </table>
    </form>
    <ul class="pagination">
        <li class="prev disabled"><span>«</span></li>
        <li class="active"><a data-page="0" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=1">1</a>
        </li>
        <li><a data-page="1" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=2">2</a></li>
        <li><a data-page="2" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=3">3</a></li>
        <li><a data-page="3" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=4">4</a></li>
        <li><a data-page="4" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=5">5</a></li>
        <li><a data-page="5" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=6">6</a></li>
        <li><a data-page="6" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=7">7</a></li>
        <li><a data-page="7" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=8">8</a></li>
        <li><a data-page="8" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=9">9</a></li>
        <li><a data-page="9" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=10">10</a></li>
        <li class="next"><a data-page="1" href="/mrsblog/backend/web/index.php?r=article%2Findex&amp;page=2">»</a></li>
    </ul>
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
