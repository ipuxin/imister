<?php
    use yii\widgets\Breadcrumbs;
    use yii\helpers\Url;
    use yii\widgets\LinkPager;

    use \Yii;
    use yii\helpers\Html;
    use common\models\Category;
    $this->registerJsFile('@web/js/index-list.js' , ['depends' => 'yii\web\JqueryAsset']);

    $categorys = Category::getParentCategorys();
?>
<?=Breadcrumbs::widget([
    'homeLink' => ['label' => '首页'],
    'links' => [
        '文章分类列表',
    ]
])?>
<div class="inner-container">
    <?php if(Yii::$app->session->hasFlash('success')){?>
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?=Yii::$app->session->getFlash('success')?>
    </div>
    <?php }?>
    <?php if(Yii::$app->session->hasFlash('error')){?>
    <div class="alert alert-danger">
        <a href="#" class="close" data-dismiss="alert">&times;</a>
        <?=Yii::$app->session->getFlash('error')?>
    </div>
    <?php }?>
	<p class="text-right">
		<a class="btn btn-primary btn-middle" href="<?=Url::to(['add'])?>">添加</a>
		<a id="delete-btn" class="btn btn-primary btn-middle">删除</a>
	</p>
    <?=Html::beginForm(['delete'] , 'post'  , ['id' => 'dltForm'])?>
		<table class="table table-hover">
			<thead>
				<tr>
						<th class="text-center"><input type="checkbox" onclick="$('input[name*=\'selected\']').prop('checked',this.checked);"></th>
						<th>名称</th>
						<th>分类</th>
						<th>排序</th>
						<th>状态</th>
						<th>操作</th>
				</tr>
			</thead>
			<tbody>
            <?php foreach($result as $value){?>
						<tr>
						<td class="text-center"><input type="checkbox" name="selected[]" value="<?=$value['id']?>"></td>
						<td><?=$value['name']?></td>
                            <!--如果存在父类,就显示父类的名称,否则就显示无-->
						<td><?=isset($categorys[$value['pid']]) ? $categorys[$value['pid']] : '无';?></td>
						<td><?=$value['sort_order']?></td>
						<td><?=$value['status'] == 1 ? '开启' : '禁用';?></td>
						<td><a href="<?=Url::to(['edit' , 'id' => $value['id']])?>" title="编辑" class="data_op data_edit"></a> | <a href="javascript:void(0);" title="删除" class="data_op data_delete"></a></td>
						</tr>
            <?php }?>
			</tbody>
		</table>
	<?=Html::endForm();?>
    <?=LinkPager::widget([
        'pagination' => $pagination,
    ])?>
</div>