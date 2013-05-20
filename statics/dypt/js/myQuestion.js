//删除问题
function deleteMyQuestion()
{
    $('.delQuestion').click(function(){
        var questionId = $(this).attr('question_id');
        var delQuestionUrl = addres+"index.php/InstructFront/deleteMyQuestionAjax";
        var delQuestionData = "questionId="+questionId;
        AjaxForJson(delQuestionUrl, delQuestionData, deleteMyQuestionSuccess, null, questionId);
    });
}

/**
 * 删除我的问题成功
 * @param data
 * @param questionId
 */
function deleteMyQuestionSuccess(data,questionId)
{
    if(data.data == 0){
        //没有删除
        popDiv("没有删除问题","没有删除问题");
    }else{
        popDiv("成功删除问题","成功删除问题");
        //要隐藏这个CELL
        $('#myQuestion_'+questionId).hide('slow');
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