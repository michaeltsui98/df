$(document).ready(function(){
	//学版块学校切换功能
	$("div.main_box_l_t #xuep1").mouseover(function(){
		$(this).attr("class","main_box_tab").siblings("span").attr("class","main_box_tab2");
		$("ul#xue_ul1").removeAttr("style");
		$("ul#xue_ul2").css("display","none");
	});
	$("div.main_box_l_t #xuep2").mouseover(function(){
		$(this).attr("class","main_box_tab").siblings("span").attr("class","main_box_tab2");
		$("ul#xue_ul1").css("display","none");
		$("ul#xue_ul2").removeAttr("style");
	});
	//学版块院校切换功能
	$("div.main_box_m > dl.xue_m > dd:gt(0)").css("background-image","url(/statics/images/btn02a.gif)");
	$("div.main_box_m > dl.xue_m > dd > a:eq(0)").mouseover(function(){
		$(this).parent("dd").css("background-image","url(/statics/images/btn02.gif)").siblings("dd").css("background-image","url(/statics/images/btn02a.gif)");
		$("div#xuedm2").css("display","none");
		$("div#xuedm3").css("display","none");
		$("div#xuedm1").removeAttr("style");
	});
	$("div.main_box_m > dl.xue_m > dd > a:eq(1)").mouseover(function(){
		$(this).parent("dd").css("background-image","url(/statics/images/btn02.gif)").siblings("dd").css("background-image","url(/statics/images/btn02a.gif)");
		$("div#xuedm1").css("display","none");
		$("div#xuedm3").css("display","none");
		$("div#xuedm2").removeAttr("style");
	});
	$("div.main_box_m > dl.xue_m > dd > a:eq(2)").mouseover(function(){
		$(this).parent("dd").css("background-image","url(/statics/images/btn02.gif)").siblings("dd").css("background-image","url(/statics/images/btn02a.gif)");
		$("div#xuedm1").css("display","none");
		$("div#xuedm2").css("display","none");
		$("div#xuedm3").removeAttr("style");
	});
});