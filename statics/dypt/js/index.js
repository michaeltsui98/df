//回复列表
var replyList = {
    replyLimit:5,//每页显示的个数
    replyMaxItems:'',//这个类型的应用的最大个数
    replyListHtmls:'',
    clickAddMore: function () {
        $('.moreReply').click(function(){
            var question_id = $(this).attr('question_id');
            var reply_start = $(this).parent().parent().find('.answerCell1').length;
            var more_replyUrl = addres+"index.php/InstructFront/getReplyListAjax";
            var more_replyData = "questionId="+question_id+"&replyStart="+reply_start+"&replyLimit="+replyList.replyLimit;
            AjaxForJson(more_replyUrl,  more_replyData, replyList.moreReplyList, null, question_id);
        });
    },
    moreReplyList:function(data,questionId){
        var totalItems = data.count[0]['totalItems'];
        if(totalItems == 0){
            $("#askApps_askCell_"+questionId).find('.moreReply').hide();
        }
        var htmls = "";

        //数据开始搞
        if(data.data.length > 0){
            for (var i = 0; i < data.data.length; i++) {
                if(data.data[i]['replyUp'] == null){
                    data.data[i]['replyUp'] = 0;
                }
                if(data.data[i]['replyDown'] == null){
                    data.data[i]['replyDown'] = 0;
                }
                htmls += "<dd class='answerCell answerCell1'>"+
                    "<div class='answerInfo grayTxt'>"+
                    "<a href='' title='' target=''><!--<img src='/statics/dypt/images/SQsiteLogoS1s.jpg' width='18' height='18' alt='' />--></a><a href='' title='' target='' class='grayA'>"+data.data[i]['replay_user_name']+"</a>回答了该问题 "+data.data[i]['replay_user_name']+
                    "</div>"+
                    "<div class='answerCon'>"+
                    "<p>"+
                    data.data[i]['replay_content']+
                    "</p>"+
                    "<div class='userHandle'>"+
                    "<span id='reply_up_"+data.data[i]['id']+"' class='reply_agree' replyId='"+data.data[i]['id']+"' ><em class='agree'></em>赞同（"+parseInt(data.data[i]['replyUp'])+"）</span><span id='reply_down_"+data.data[i]['id']+"' class='reply_oppose' replyId='"+data.data[i]['id']+"' ><em class='oppose'></em>反对（"+parseInt(data.data[i]['replyDown'])+"）</span>"+
                    "</div>"+
                    "</div>"+
                    "</dd>";
            }
            $('#replyCon_'+data.data[0]['replay_question_id']).append(htmls);
            var currentLength = $('#replyCon_'+data.data[0]['replay_question_id']).find('.answerCell1').length;

            totalItems = totalItems-1;

            if(totalItems == -1 || currentLength >= totalItems){
                $("#askApps_askCell_"+data.data[0]['replay_question_id']).find('.moreReply').hide();
            }
        }

    }
}

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
 * 初始化方法
 */
function init(){
    //显示收缩回复框
    replyCell();
    //添加更多回复
    replyList.clickAddMore();
    //答案的顶踩
    answerAgreeOppose();
    //回复的顶踩
    replyAgreeOppose();
    //收藏
    addFavorite();


}

//加载开始
$(document).ready(function(){
    init();
});