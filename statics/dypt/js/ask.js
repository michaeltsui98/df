


//点击提问
function askCell()
{
    $('.ask').click(function(){
        $('#ask_book_'+this.id).toggle();
    });
    $('.cancel').click(function(){
        $('#ask_book_'+$(this).attr('book_id')).hide();
    });

    $('.subQuestion').click(function(){
        var bookMxid = $(this).attr('bookId');
        var questionTitle =  characterTransform($('#questionTitle_'+$(this).attr('bookId')).val());
        var questionContent = characterTransform($('#questionContent_'+$(this).attr('bookId')).val()).replace(/\n/g, "<br/>");
        var subQuestionUrl = addres+"index.php/InstructFront/addQuestionAjax";
        var subQuestionData = "questionMxid="+bookMxid+"&questionTitle="+questionTitle+"&questionContent="+questionContent;
        AjaxForJson(subQuestionUrl, subQuestionData, askSuccess, null, bookMxid);

    });
}

//提交问题成功
function askSuccess(data,mxid)
{
    //写信息，关层，刷新问题数目
    var askStat = data.insertId;
    var askMxid = mxid;
    var questionNum = data.questionNum;
    $('#ask_book_'+askMxid).hide();
    $('#totalQuestion_'+askMxid).html(questionNum);
    popDiv("提问成功","您成功的完成了一次提问");
}

//点击搜索
function searchSubmit()
{
    $('.searchBooks').click(function(){
        $('#searchForm').submit();
    });
}

/****初始化**/
function init()
{
    //搜索资料提交
    searchSubmit();
    //点击提问
    askCell();

}


$(document).ready(function(){
    init();
});
