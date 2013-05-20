/**
 * 点击提交搜索
 */
function searchSubmit()
{
    $('.searchQuestion').click(function(){
        $('#searchForm').submit();
    });
}

/***
 * 回复框
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


/****初始化**/
function init()
{
    //搜索资料提交
    searchSubmit();
    //回复区操作
    replyCell();
    //收藏
    addFavorite();
}


$(document).ready(function(){
    init();
});
