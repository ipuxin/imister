<ul class="breadcrumb"><li>首页</li>
	<li><a href="@">配置网站</a></li>
</ul>
<div class="inner-container">
	<form enctype="multipart/form-data" role="form" method="post" action="/mrsblog/backend/web/index.php?r=slideshow%2Fadd" class="form-horizontal" id="addForm">
	    <div class="form-group">
			<label for="name" class="control-label col-sm-2 col-md-1">名称*：</label>			<div class="controls col-sm-10 col-md-11">
				<input type="text" name="Slideshow[name]" class="form-control input" id="slideshow-name">				<div class="error"></div>			</div>
		</div>
	   <div class="form-group">
			<label for="link" class="control-label col-sm-2 col-md-1">链接*：</label>			<div class="controls col-sm-10 col-md-11">
				<input type="text" name="Slideshow[link]" class="form-control input" id="slideshow-link">				<div class="error"></div>			</div>
		</div>
		<div class="form-group">
			<label for="sort_order" class="control-label col-sm-2 col-md-1">排序：</label>			<div class="controls col-sm-10 col-md-11">
				<input type="text" name="Slideshow[sort_order]" class="form-control input input-small" id="slideshow-sort_order">				<div class="error"></div>			</div>
		</div>

		<div class="form-group">
			<label for="status" class="control-label col-sm-2 col-md-1">状态：</label>			<div class="controls col-sm-10 col-md-11">
				<select name="Slideshow[status]" class="form-control width_auto" id="slideshow-status">
				<option value="1">启用</option>
				<option value="0">禁用</option>
			</select>
		</div>
		</div>
		<div class="form-group">
		 	<div style="margin-top:10px" class="col-sm-10 col-sm-offset-2 col-md-11 col-md-offset-1">
		 		<button class="btn btn-primary" type="submit">提交</button>
				<a class="btn btn-primary" href="#">返回</a>
		 	</div>
		</div>
	</form>
</div>
