 /* $('.nav_a').mouseover(function(){
		$('.nav_a_hover').removeClass("nav_a_hover");
		$(this).addClass("nav_a_hover");
	}) */
	$('.nav_a').click(function(){
		
			alert("请先登录，然后在进行其他操作！")
			sessionStorage.setItem("block_num",$(this).attr('tolink'));
			window.location.href=url
		
	})
	$('.user_list li:eq(2)').click(function(){
		sessionStorage.setItem('block_num','')
	})
		setTimeout(function(){
		$('.fixedTop').css('display','none');
	},5000);
	
 window.onload=function(){
	        $(".fixed span").hover(function(){
	        	$(this).find(".fix_pos").css("display",'block')
	        },function(){
	        	$(this).find(".fix_pos").css("display",'none')
	        })
        }

/*           来源统计   start        */
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?c16e71335ce5575c1aab0ce71c7415ae";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
/*           来源统计   end        */