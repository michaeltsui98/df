//删除问题
function deleteMyQuestion()
{
    $('.delReply').click(function(){
        var replyId = $(this).attr('reply_id');
        var delQuestionUrl = addres+"index.php/InstructFront/deleteMyReplyAjax";
        var delQuestionData = "replyId="+replyId;
        AjaxForJson(delQuestionUrl, delQuestionData, deleteMyReplaySuccess, null, replyId);
    });
}

/**
 * 删除我的问题成功
 * @param data
 * @param questionId
 */
function deleteMyReplaySuccess(data,replyId)
{

    if(data.data == 0){
        //没有删除
        popDiv("没有删除回答","没有删除回答");
    }else{
        popDiv("成功删除回答","成功删除回答");
        //要隐藏这个CELL
        $('#question_reply_'+replyId).hide('slow');
    }

}

/****初始化**/
function init()
{
    deleteMyQuestion();
}


$(document).ready(function(){
    init();
});