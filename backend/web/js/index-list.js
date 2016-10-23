$(function () {
    /**
     * 点击删除按钮后,如果同意删除,
     * 就提交表单
     */
    $("#delete-btn").click(function () {
        if (confirm('您确定要删除 ,这是不可恢复操作')) {
            $("#dltForm").submit();
        }
    });

    /**
     * 效果:
     * 点击单列删除按钮,
     * 其他列的checkbox为false,
     * 同时,本列checkbox为true.
     * 最后,激活总的删除按钮
     *
     * prop:获取匹配的元素集中第一个元素的属性（property）值或设置每一个匹配元素的一个或多个属性。
     */
    $(".data_delete").click(function () {
        alert('ok');
        $("#dltForm").find('input[type=checkbox]').prop('checked', false);
        $(this).parent().parent().find('input[type=checkbox]').prop('checked', true);
        $("#delete-btn").click();
    });
});