/**
 * 显示或收缩回复框
 */
function replyCell(){
    $('.reply').click(function(){
        $('#reply_'+this.id).toggle();
    });
    $('.cancel').click(function(){
        $('#reply_'+$(this).attr('question_id')).hide();
    });
    $('.answerBtnIndex').click(function(){
        //提交啦！
        $('#reply_'+$(this).attr('question_id')).hide();
        var replyContent = characterTransform($('#replycontent_'+$(this).attr('question_id')).val()).replace(/\n/g, "<br/>");
        var replyQuestionId = $('#question_'+$(this).attr('question_id')).val();
        var initCenterAppUrl = addres+"index.php/InstructFront/addReplyAjax";
        var initCenterAppData = "questionId="+replyQuestionId+"&replyContent="+replyContent;
        AjaxForJson(initCenterAppUrl, initCenterAppData, addReplySuccess, null, null);

    });
}

/**
 * 取消收藏
 */
function cancelFavorite()
{
    $('.deleteFavorite').click(function(){
        var favoriteId = $(this).attr('favorite_id');
        var delFavoriteUrl = addres+"index.php/InstructFront/deleteMyFavoriteAjax";
        var delFavoriteData = "favoriteId="+favoriteId;
        AjaxForJson(delFavoriteUrl, delFavoriteData, delFavoriteSuccess, null, favoriteId);
    });
}
function delFavoriteSuccess(data,favoriteId)
{
    if(data.data == 0){
        popDiv("删除收藏失败","删除收藏失败");
    }else{
        popDiv("删除收藏成功","删除收藏成功");
        //删除层
        $('#favorite_'+favoriteId).hide('slow');
    }
}


/**
 * 初始化方法
 */
function init(){
    //显示收缩回复框
    replyCell();
    //取消收藏
    cancelFavorite();
}

//加载开始
$(document).ready(function(){
    init();
});
