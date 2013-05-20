/****配置*/
var addres = "http://sizz.jfzd.com/";
/*************************公共方法**************************/
/**
 * 顶答案
 */
function answerAgreeOppose()
{
    $(".answer_agree").live("click",function(){
        var answerId = $(this).attr('answerId');
        var answerStat = 1;
        var answerAOUrl = addres+"index.php/InstructFront/updateAnswerEstimateAjax";
        var answerAOData = "answerId="+answerId+"&answerStat=1";
        AjaxForJson(answerAOUrl,  answerAOData, refreshAnswerAgreeOppose, null, answerStat);
    });

    $('.answer_oppose').live("click",function(){
        var answerId = $(this).attr('answerId');
        var answerStat = 0;
        var answerAOUrl = addres+"index.php/InstructFront/updateAnswerEstimateAjax";
        var answerAOData = "answerId="+answerId+"&answerStat=0";
        AjaxForJson(answerAOUrl,  answerAOData, refreshAnswerAgreeOppose, null, answerStat);
    });
}

/**
 * 刷新顶踩
 */

function refreshAnswerAgreeOppose(data,answerStat)
{
    if(data.insertId == 0){
        popDiv(" ","你只能够评价答案一次哦");
    }
    var answerId = data.ao[0]['answer_id'];
    var answerUp = data.ao[0]['answer_up'];
    var answerDown = data.ao[0]['answer_down'];
    //顶就刷新顶，踩就刷新踩
    if(answerStat == 1){
        $('#answer_up_'+answerId).html("<em class='agree'></em>赞同（"+answerUp+"）");
    }else if(answerStat == 0){
        $('#answer_down_'+answerId).html("<em class='oppose'></em>反对（"+answerDown+"）");
    }

}


/**
 * 回复的顶踩
 */
function replyAgreeOppose()
{
    $('.reply_agree').live("click",function(){

        var replyId = $(this).attr('replyId');
        var replyStat = 1;
        var replyAOUrl = addres+"index.php/InstructFront/updateReplyEstimateAjax";
        var replyAOData = "replyId="+replyId+"&replyStat=1";
        AjaxForJson(replyAOUrl,  replyAOData, refreshReplyAgreeOppose, null, replyStat);
    });

    $('.reply_oppose').live("click",function(){
        var replyId = $(this).attr('replyId');
        var replyStat = 0;
        var replyAOUrl = addres+"index.php/InstructFront/updateReplyEstimateAjax";
        var replyAOData = "replyId="+replyId+"&replyStat=0";
        AjaxForJson(replyAOUrl,  replyAOData, refreshReplyAgreeOppose, null, replyStat);
    });


}

/**
 * 刷新顶踩回复
 * @param data
 * @param replyStat
 */
function refreshReplyAgreeOppose(data,replyStat)
{
    if(data.insertId == 0){
        popDiv(" ","你只能够评价答案一次哦");
    }
    var replyId = data.ao[0]['replay_id'];
    var replyUp = data.ao[0]['replay_up'];
    var replyDown = data.ao[0]['replay_down'];
    if(replyStat == 1){
        $('#reply_up_'+replyId).html("<em class='agree'></em>赞同（"+replyUp+"）");
    }else if(replyStat == 0){
        $('#reply_down_'+replyId).html("<em class='oppose'></em>反对（"+replyDown+"）");
    }
}

function characterTransform(str) {
    str = str.replace(/\%/g, "%25");
    str = str.replace(/\+/g, "%2B");
    str = str.replace(/\&/g, "%26");
    return str;
}



/**
 * 回复成功
 * @param data
 */
function addReplySuccess(data){
    popDiv("回复问题成功","已经成功回复该问题");
}

/**
 * 弹出层的方法
 */
function popDiv(title,content){
    $('.popDivTitle').html(title);
    $('.popDivContent').html(content);
    var bodyScrollTop=0;
    if (document.documentElement && document.documentElement.scrollTop) {
        bodyScrollTop = document.documentElement.scrollTop;
    }
    else if (document.body) {
        bodyScrollTop = document.body.scrollTop;
    }
    bodyScrollTop = bodyScrollTop+600;
    $(".editFra").css("top",bodyScrollTop+"px");
    $('.editFra').show('slow');
    $('.close').click(function(){
        $('.editFra').hide('slow');
    });
    setTimeout(function(){
        $('.editFra').hide('slow');
    },3000);
}

function popDivJump(title,content){
    $('.popDivTitle').html(title);
    $('.popDivContent').html(content);
    var bodyScrollTop=0;
    if (document.documentElement && document.documentElement.scrollTop) {
        bodyScrollTop = document.documentElement.scrollTop;
    }
    else if (document.body) {
        bodyScrollTop = document.body.scrollTop;
    }
    bodyScrollTop = bodyScrollTop+600;
    $(".editFra").css("top",bodyScrollTop+"px");
    $('.editFra').show('slow');
    $('.close').click(function(){
        $('.editFra').hide('slow');
    });
    setTimeout(function(){
        $('.editFra').hide('slow');
        history.go(0);
    },3000);
}


function sethash(){
    alert();
    hashH = document.documentElement.scrollHeight;
    urlC = "http://www.dodoedu.com/agent.html";
    document.getElementById("iframeC").src=urlC+"#"+hashH;
}


//ajax调用公共方法
function AjaxForJson(requestUrl, requestData, SuccessCallback, errorCallback, successPar) {
    //if (AjaxForJson.ajaxing) return;
    //AjaxForJson.ajaxing = true;
    jQuery.ajax({
        type: "POST",
        url: requestUrl,
        data: requestData,
        //contentType: "application/json;charset=utf-8",
        //dataType: "json",
        contentType: "application/x-www-form-urlencoded",
        dataType: "text",
        success: function (data) {
            var obj = null; // $.parseJSON(data.d);
            try {
                obj = eval('(' + data + ')')
            } catch (ex) {
                obj = data;
            }
            if(obj.stat == 'true'){
                SuccessCallback(obj.data, successPar);
                sethash();
            }else if(obj.stat == 'null'){
                popDiv("缺少输入","要有内容才可以提交哦");
            }else{
//                alert('somethingWrong');
                popDiv('somethingWrong','somethingWrong');
            }

        },
        error: function (err) {
            err;
            //errorCallback();
        },
        complete: function (XHR, TS) {
            XHR = null
        }
    });
}


//添加收藏
function addFavorite()
{
    $('.addFavorite').click(function(){
        var questionId = $(this).attr('favorite_question_id');
        var addFavoriteUrl = addres+"index.php/InstructFront/addFavoriteAjax";
        var addFavoriteData = "questionId="+questionId;
        AjaxForJson(addFavoriteUrl, addFavoriteData, addFavoriteSuccess, null, questionId);
    });
}

//收藏问题成功
function addFavoriteSuccess(data,questionId)
{

    if(data == 0){
        popDiv("你已经收藏过该问题了","你已经收藏过该问题了");
    }else{
        popDiv("成功收藏问题","成功收藏问题");
    }
}

function leftHot()
{
    $('#hQ').click(function(){
        $('.myBook').hide();
        $('.Ask').show();
        $('#hU').removeClass('active');
        $(this).addClass('active');
    });
    $('#hU').click(function(){
        $('.Ask').hide();
        $('.myBook').show();
        $('#hQ').removeClass('active');
        $(this).addClass('active');
    });

}


$(document).ready(function(){
    leftHot();
});


