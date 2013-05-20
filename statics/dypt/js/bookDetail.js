/**
 * 提问框
 */
function askCell()
{
    $('.ask').click(function(){
        $('#ask_book_'+$(this).attr('mxid')).toggle();
    });

    $('.cancel').click(function(){
        $('#ask_book_'+$(this).attr('book_id')).hide();
    });

    $('.subQuestion').click(function(){
        var bookMxid = $(this).attr('bookId');
        var questionTitle = characterTransform($('#questionTitle_'+$(this).attr('bookId')).val());
        var questionContent = characterTransform($('#questionContent_'+$(this).attr('bookId')).val()).replace(/\n/g, "<br/>");
        var subQuestionUrl = addres+"index.php/InstructFront/addQuestionAjax";
        var subQuestionData = "questionMxid="+bookMxid+"&questionTitle="+questionTitle+"&questionContent="+questionContent;
        AjaxForJson(subQuestionUrl, subQuestionData, askSuccess, null, bookMxid);

    });

    //提交问题成功
    function askSuccess(data,mxid)
    {
        //写信息，关层，刷新问题数目
        var askStat = data.insertId;
        var askMxid = mxid;
        var questionNum = data.questionNum;
        $('#ask_book_'+askMxid).hide();
        popDiv("提问成功","您成功的完成了一次提问");
        //这里是不是要加一个问题框。

        setTimeout(function(){
            history.go(0);
        },3500);



    }


}


/**
 * 显示或收缩回复框
 */
function replyCell(){
    $('.reply').live('click',function(){
        $('#reply_'+this.id).toggle();
    });
    $('.cancel').live('click',function(){
        $('#reply_'+$(this).attr('question_id')).hide();
    });
    $('.answerBtnDetail').live('click',function(){
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
    replyCell();
    askCell();
    //收藏
    addFavorite();

}
$(document).ready(function(){
    init();
});
