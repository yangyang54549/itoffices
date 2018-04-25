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
			$(".cente-head .p2").click(function() {
				$(".cente-head .p2").removeClass("on");
				$(this).addClass("on");
				var tt1 = $(".cente-head .p2").index($(this)) * 100;
				/*taps(tt1);*/
				$(".cente_ul").css("margin-left", "-" + tt1 + "%");

			})
taps();
function taps(){
	var uls = $(".cente_ul ul");
	for(var s = 0;s<uls.length;s++){
		var ullen = $(".cente_ul .ul"+(s+1)+" .li_one").length;
		$(".cente_ul .ul"+(s+1)+" .string>p").html("共" + ullen + "条记录，共" + (Math.ceil(ullen / 7)) + "页");
		if(ullen>0){
			$(".cente_ul .ul"+(s+1)+" .string>p").css("display","block");
			$(".cente_ul .ul"+(s+1)+" .string .wu").css("display","none");
		}else{
			$(".cente_ul .ul"+(s+1)+" .string>p").css("display","none");
			$(".cente_ul .ul"+(s+1)+" .string .wu").css("display","block");
			$(".cente_ul .ul"+(s+1)+" .string .wu").css("display","flex");
		}		
		$("#num_"+(s+1)).text(ullen);
	}
	
}
$(" .participations .participation_f1").click(function() {

				if($(this).parent().parent().hasClass('str')) {}else{
				if($(this).hasClass('participation1')) {
					/*选择  取消未选择*/
					$(this).removeClass("participation1");
					$(this).parent().next().next().removeClass("blue1");
					$(this).parent().next().next().next().removeClass("string1");
				} else {
					/*未选择  改为选择*/
					var pt = $(this).parent().data('id');
					$(".pt" + pt + " .participation_f1").removeClass("participation1");
					$(this).addClass("participation1");
					$(this).parent().next().next().addClass("blue1");
					$(this).parent().next().next().next().addClass("string1");
				}}
			})
$(".content .center_cen").width(($(".center").width() - 250) + "px");
			$(".active").css("color", "white");