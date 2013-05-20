$(document).ready(function(){
    init();
});
/********************************/
//ajax调用公共方法
function AjaxForJson(requestUrl, requestData, SuccessCallback, errorCallback, successPar)
{
    //if (AjaxForJson.ajaxing) return;
    //AjaxForJson.ajaxing = true;
    jQuery.ajax({
        type: "POST",
        url: requestUrl,
        data: requestData,
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



/*********************************/


function init(){
    //点击评价获得评价信息
    getEvaType();
    //处理评价信息
    processEva();
    //还有个评价详情的咯？
    getEvaluateInfo();
    //点击关闭的时候
    closeEvaluateInfo();
}



/*提交评价*/
function processEva()
{
    $('.submitEva').die().live('click',function(){
        if(buttonConfirm("评价提交后将不可修改，确定要提交么？")){
            var that = $(this);
            var mxid = that.attr('mxid');
            var subTable = that.parent().parent().parent().find('input[type="radio"]:checked');
            //都齐全了，开始整AJAX
            var requestUrl = "/index.php/Evaluate/processAjaxEvaluate";
            var requestData = "mxid="+mxid;
            for(var i= 0; i<subTable.length;i++){
                requestData += "&"+$(subTable[i]).attr('name')+"="+$(subTable[i]).val()+"*"+$(subTable[i]).attr('chooseLabel');
            }
            AjaxForJson(requestUrl, requestData, processEvaSuccess, null, that);
        }
    });
}
/*提交评价成功*/
function processEvaSuccess(data,that)
{
    alert(data.msg);
    $('.evaluateTable').remove();
    var mxid = that.attr('mxid');
    $('#'+mxid).removeClass('evaluate').addClass('evaInfo').unbind('click').html('评价详情');
}

/*点击评价获得详情*/
function getEvaType(){
    $(".evaluate").click(function()
    {
        var that = $(this);
            var requestUrl = "/index.php/Evaluate/getAjaxEvaluateTypes";
            var xd = $('#xd').val();
            var mxid = this.id;
            var requestData = "mxid="+mxid+"&xd="+xd;
            AjaxForJson(requestUrl, requestData, getEvaTypeSuccess, null, that);
    });
}

/*成功从后台获得详情*/
function getEvaTypeSuccess(data,that)
{
//    alert(data);
      $('.evaluateTable').remove();
      $('.evaluateInfo').remove();
      that.parent().parent().after(data);
}

/*点击评价详情看到一个选好了的答案详情*/
function getEvaluateInfo()
{
    $('.evaInfo').die().live('click',function(){
//        alert('这个是 弹出选项卡的咯？');
        var that = $(this);
        var mxid = that.attr('id');
        var requestUrl = "/index.php/Evaluate/getAjaxEvaluateInfo";
        var requestData = "mxid="+mxid;
        AjaxForJson(requestUrl, requestData, getEvaTypeSuccess, null, that);
    });
}
function getEvaluateInfoSuccess(data,that)
{
    $('.evaluateTable').remove();
    $('.evaluateInfo').remove();
    that.parent().parent().after(data);
}

function closeEvaluateInfo()
{
    $('.closeEvaluateInfo').die().live('click',function(){
        $('.evaluateInfo').remove();
    });
}

function buttonConfirm(msg)
{
    if(confirm(msg)==true){
        return true;
    }else{
        return false;
    }
}
