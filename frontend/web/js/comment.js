$(function(){
    $("#i-like").click(function(){
        var _this = this;
        $.ajax({
            type : 'get',
            dataType : 'json',
            data : { id : rid},
            url : globalUpUrl,
            success : function(data){
                if(data.status == '1'){
                    var spanObj =  $(_this).find('span');  
                    var count = parseInt(spanObj.html());
                    if(isNaN(count)) count = 0; 
                    spanObj.html(count + 1);
                    // window.location.reload();
                }else{
                    alert(data.msg);
                }

            }
        });
    });

    $("#submit-recomment").click(function(){
       // alert($("#message").val());
        if(!recomment({content : $("#message").val()} , null)) $("#message").focus();
        else $("#message").val("");
    });

    //ajaxData(null,1);        //初始化评论

    //排序
    $(".ds-sort a").click(function(){
        $(".ds-sort a").removeClass("ds-current");
        $(this).addClass("ds-current");
        ajaxData(null , 1);
    });

    
});

function recomment(data , obj){
    if(data.content == ""){
        alert("留言的信息不能为空");
        return false;
    }
    if(data.content.length > 255){
        alert("留言的信息字符请控制在255字内.");
        return false;
    }

    data.rid = rid;
    $.ajax({
        type : 'post',
        data : data,
        dataType : 'json',
        url : globalRecommentUrl,
        success : function(jsonData){
            if(jsonData.status == 1){
                ajaxData(null,1);    //更新
                if(data.type == 2){
                    //子评论需要移除评论框
                    obj.remove();           
                }
            }else{
                alert(jsonData.msg);
            }
        }
    });
    return true;
}

/*
function ajaxData(_this , page){
    page = parseInt(page);
    if(isNaN(page) || page < 1)return false;
    var params = {page : page , sort : $(".ds-current").attr('data')};
    if(!!_this){
        addParams= $.trim($(_this).attr('data')); 
        if(addParams != ""){
            var addParamsData = addParams.split("&");
            for(var index in addParamsData){
                var tmpParams = addParamsData[index].split("=");
                if(tmpParams.length == 2){  //追加
                    params[tmpParams[0]] = tmpParams[1];
                }
            }
        }
    }else{
        params['rid'] = rid;
    }

    $("#comments-list").html('<li><img src="' + load_img+'" style="display:block;margin:0 auto;"/></li>');
     $.ajax({
        type : 'get',
        data : params,
        dataType : 'json',
        url : globalCommentlistUrl,
        success : function(jsonData){
            var appStr = "";
            for(var dd in jsonData['data']){
                //子类回复
                appStr += commentTmpl(jsonData['data'][dd]);
                appStr +='<ul class="ds-comments" style="padding-left:25px;">';
                for(var cdata in  jsonData['data'][dd]['child']){
                    appStr +=commentTmpl(jsonData['data'][dd]['child'][cdata] , true) + '</li>';
                }
                appStr +='     </ul>';
                appStr +='</li> ';
            }
            $("#comments-list").html(appStr);
            $("#recomment-count").html(jsonData['count']);   //评论条数
            $("#cmpage").html(jsonData['page']);
        }
    });
}
*/
//评论的模板
function commentTmpl(data , child){
    var appStr = '';
    appStr +='<li class="ds-post">';
    appStr +='    <div data-source="duoshuo" class="ds-post-self">';
    appStr +='        <div class="ds-avatar">';
    appStr +='                <img alt="smister" src="'+data['simage']+'"/>';
    appStr +='        </div>';
    appStr +='        <div class="ds-comment-body">';
    appStr +='            <div class="ds-comment-header">';
    appStr +='                <span data-qqt-account="" class="ds-user-name"><a class="ds-user-name ds-highlight">' + data['sname'] + '</a></span>';
    appStr +='            </div>';
    appStr +='            <p>';
    if(child){
         appStr +='<a class="ds-comment-context">回复 ' + data['aname'] + ': </a>';
    }
    appStr +=data['content'];
    appStr +='            </p>';
    appStr +='            <div class="ds-comment-footer ds-comment-actions">';
    appStr +='                    <span class="ds-time">' + data['dateFormat'] + '</span>';
    appStr +='                    <a href="javascript:void(0);" class="ds-post-reply" onclick="showComment(this);" data="' + data['id']  + '">';
    appStr +='                         <span class="ds-icon ds-icon-reply"></span>回复';
    appStr +='                    </a>';
    appStr +='            </div>';
    appStr +='        </div>';
    appStr +='    </div>';
    return appStr;
}

function showComment(_this){
    var parentObj = $(_this).parent().parent();
    if(parentObj.find(".recomment-box").length > 0) {
        parentObj.find(".recomment-box").remove();
        return;
    }
    else $(".recomment-box").remove(); //移除其他的回复框
    var appStr = '';
    appStr +='<div class="ds-replybox recomment-box">';
    appStr +='    <a class="ds-avatar" href="javascript:void(0);">';
    appStr +='        <img src="' +  member_img + '" alt="smister">';
    appStr +='    </a>';
    appStr +='    <form method="post" class="comment-form">';
    appStr +='        <div class="ds-textarea-wrapper ds-rounded-top">';
    appStr +='            <textarea  class="message" data="' + $(_this).attr('data') +'" placeholder="= 。= .评论吧."></textarea>';
    appStr +='            <pre class="ds-hidden-text"></pre>';
    appStr +='        </div>';
    appStr +='        <div class="ds-post-toolbar">';
    appStr +='            <div class="ds-post-options ds-gradient-bg"><span class="ds-sync"></span></div>';
    appStr +='            <button class="ds-post-button" type="button" onclick="sendComment(this);" >发布</button>';
    appStr +='            <div class="ds-toolbar-buttons">';
    appStr +='            </div>';
    appStr +='        </div>';
    appStr +='    </form>';
    appStr +='</div>';
    parentObj.append(appStr);
}

function sendComment(_this){
    //$(_this).parent().parent();
    var parentObj = $(_this).parent().parent();
    var messageObj = parentObj.find(".message");
    var data = {
        content : messageObj.val(),
        comment_id : messageObj.attr('data')
    };
    if(!recomment(data,parentObj.parent())) messageObj.focus();
}