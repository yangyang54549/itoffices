/*右键禁止，复制禁止*/
$(document).bind("contextmenu copy selectstart", function() {
	return false;
});

$(document).keydown(function(e) {
	if(e.ctrlKey && (e.keyCode == 65 || e.keyCode == 67)) {
		return false;
	}
})
/*tap切换*/
var tap =0;
function taps(i) {
	$(".cente-head .p2").removeClass("on");
	$(".cente-head .p2").eq(i).addClass("on");
	$(".cente_ul").css("margin-left", "-" + (i*100) + "%");
}

notHave();

function notHave() {
	var uls = $(".cente_ul ul");
	for(var s = 0; s < uls.length; s++) {
		var ullen = $(".cente_ul .ul" + (s + 1) + " .li_one").length;
		/*$(".cente_ul .ul" + (s + 1) + " .string>p").html("共" + ullen + "条记录，共" + (Math.ceil(ullen / 7)) + "页");*/
		/*$(".cente_ul .ul" + (s + 1) + " .string>p").html("共" + ullen + "条记录");*/
		if(ullen > 0) {
			$(".cente_ul .ul" + (s + 1) + " .string>p").css("display", "block");
			$(".cente_ul .ul" + (s + 1) + " .string .wu").css("display", "none");
			if(ullen > 6){
				
				$(".cente_ul .ul" + (s + 1) + " .em_show").css("display", "block");
				for(var i = 0;i<6;i++){
					$(".cente_ul .ul" + (s + 1) + " .li_one").eq(i).addClass("li-block");
				}
			}else{
				$(".cente_ul .ul" + (s + 1) + " .em_show").css("display", "none");
				$(".cente_ul .ul" + (s + 1) + " .li_one").addClass("li-block");
			}
			
			
		} else {
			$(".cente_ul .ul" + (s + 1) + " .string>p").css("display", "none");
			$(".cente_ul .ul" + (s + 1) + " .string .wu").css("display", "block");
			$(".cente_ul .ul" + (s + 1) + " .string .wu").css("display", "flex");
			
		}
		$("#num_" + (s + 1)).text(ullen);
	}

}
function showEm1(){
	
				var p1 = $(".cente_ul .ul1 .li_one").length;
				var p2 = $(".cente_ul .ul1 .li-block").length;
				var p2s = p2+6;
				if(p1>p2s){					
					for(var i = p2;i<p2s;i++){
						$(".cente_ul .ul1 .li_one").eq(i).addClass("li-block");
						$(".cente_ul .ul1 .li_one").eq(i).css("display","block");
					}
				}else{
					$(".cente_ul .ul1 .em_show").css("display","none");
					for(var i = p2;i<p1;i++){
						$(".cente_ul .ul1 .li_one").eq(i).addClass("li-block");
						$(".cente_ul .ul1 .li_one").eq(i).css("display","block");
					}
				}
}
function showEm2(){
	
				var p1 = $(".cente_ul .ul2 .li_one").length;
				var p2 = $(".cente_ul .ul2 .li-block").length;
				var p2s = p2+6;
				if(p1>p2s){					
					for(var i = p2;i<p2s;i++){
						$(".cente_ul .ul2 .li_one").eq(i).addClass("li-block");
						$(".cente_ul .ul2 .li_one").eq(i).css("display","block");
					}
				}else{
					$(".cente_ul .ul2 .em_show").css("display","none");
					for(var i = p2;i<p1;i++){
						$(".cente_ul .ul2 .li_one").eq(i).addClass("li-block");
						$(".cente_ul .ul2 .li_one").eq(i).css("display","block");
					}
				}
}
$(" .participations .participation_f1").click(function() {

	if($(this).parent().parent().hasClass('str')) {} else {
		if($(this).hasClass('participation1')) {
			/*选择  取消未选择*/
			$(this).removeClass("participation1");
			$(this).parent().next().next().removeClass("blue1");
			/*$(this).parent().next().next().next().removeClass("string1");*/
		} else {
			/*未选择  改为选择*/
			var pt = $(this).parent().data('id');
			$(".pt" + pt + " .participation_f1").removeClass("participation1");
			$(this).addClass("participation1");
			$(this).parent().next().next().addClass("blue1");
			/*$(this).parent().next().next().next().addClass("string1");*/
		}
	}
})
$(".content .center_cen").width(($(".center").width() - 250) + "px");
$(".active").css("color", "white");
/*隐藏*/


