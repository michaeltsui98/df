
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
        AjaxForJson(initCenterAppUrl, initCenterAppData, addReplySuccessJump, null, null);

    });
}

function addReplySuccessJump(data){
    popDivJump("回复问题成功","已经成功回复该问题");
}

/****初始化**/
function init()
{
    //回复区操作
    replyCell();
    //答案的顶踩
    answerAgreeOppose();
    //回复的顶踩
    replyAgreeOppose();
    //收藏
    addFavorite();
}


$(document).ready(function(){
    init();
});