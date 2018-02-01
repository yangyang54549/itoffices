<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"E:\GitHub\itoffice\public/../application/index\view\cases\index.html";i:1517214923;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>IT联合办公</title>
		<link rel="stylesheet" href="__INDEX__/css/header.css" />
		<link rel="stylesheet" href="__INDEX__/css/index.css" />
		<link rel="stylesheet" href="__INDEX__/css/restre.css" />
		<link rel="stylesheet" href="__INDEX__/css/style.css" />
		<!--<link rel="shortcut icon" href="https://www.315pr.com:443/resources/bootstrap/__INDEX__/img/sdyk.ico">-->
		<script src="__INDEX__/js/js/jquery-2.1.3.min.js"></script>
		<style type="text/css">
			.nav li a {
				color: white;
			}

			.sou {
				width: 100%;
				background-image: url(__INDEX__/img/index.jpg);
				filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='scale')";
				-moz-background-size: 100% 100%;
				background-size: 100% 100%;
				padding: 1px 0;
				position: relative;
				top: 0;
				left: 0;
			}

			.search {
				width: 100%;
				padding: 0;
				position: absolute;
				left: 0;
				top: 50%;
				margin-top: -30px;
			}

			.search1 {
				height: 60px;
				width: 600px;
				line-height: 65px;
				position: relative;
				top: 0;
				left: 0;
				background-color: white;
				margin: 5px auto;
				border-radius: 5px;
				box-shadow: 0 4px 20px 2px rgba(28, 57, 81, 0.18);
			}

			.search1:hover {
				box-shadow: 0 10px 30px 6px rgba(28, 57, 81, 0.18);
			}

			.search1 input {
				width: 450px;
				height: 56px;
				line-height: 56px;
				border: none;
				margin-left: 50px;
				margin-top: -2px;
			}

			.search1 img {
				width: 30px;
				position: absolute;
				top: 17px;
				left: 13px;
			}

			.search1 button {
				width: 80px;
				height: 56px;
				position: absolute;
				top: 2px;
				right: 2px;
				border-radius: 5px;
				background-color: #0d80dd;
				color: white;
				font-size: 16px;
			}

			.search1 span {
				position: absolute;
				top: 0px;
				right: -40px;
				color: white;
				font-size: 15px;
				font-weight: bold;
			}

			.search1 p {
				width: 120px;
				height: 56px;
				text-align: center;
				border-radius: 5px;
				position: absolute;
				right: -170px;
				font-size: 16px;
				background-color: #0d80dd;
				color: white;
				font-weight: bold;
				top: 3px;
				line-height: 56px;
				box-shadow: 0 4px 20px 2px rgba(28, 57, 81, 0.18);
				/*background: -webkit-linear-gradient(left,  #f2f2ef, white);*/
				/* Safari 5.1 - 6.0 */
				/*background: -o-linear-gradient(right,  #f2f2ef, white);*/
				/* Opera 11.1 - 12.0 */
				/*background: -moz-linear-gradient(right, #f2f2ef, white);*/
				/* Firefox 3.6 - 15 */
				/*background: linear-gradient(to right, #f2f2ef, white);*/
				/* 标准的语法（必须放在最后） */
			}

			.search1 p:hover {
				box-shadow: 0 10px 30px 6px rgba(28, 57, 81, 0.18);
			}

			#page-box {
				position: relative;
				top: 0;
				left: 0;
			}

			.page-div {
				position: absolute;
				right: 1px;
width: 360px;
height: 680px;
				top: -735px;
				box-shadow: 0 4px 20px 2px rgba(28, 57, 81, 0.18);
				background-color: rgba(0, 0, 0, 0.1);
				border-radius:20px ;
			}

			.page-div h3 {
				width: 100%;
				height: 100px;
				font-size: 40px;
				line-height: 100px;
				position: absolute;
				top: 50%;
				left: 0;
				margin-top: -50px;
			}

			.page-div:hover {
				box-shadow: 0 10px 30px 6px rgba(28, 57, 81, 0.18);
			}

			.demandlist ul .round {
				width: 30%;
				margin-bottom: 50px;
				margin-right: 5%;
			}

			.similarity_label {
				font-size: 18px;
			}
			/*nav*/
			.navs{
				position: absolute;
				top: -45px;
				left: 0;
				width: 600px;
				height: 40px;
				overflow: hidden;
				background-color: rgba(0,0,0,0.1);
			}
			.navs .is{
				float: left;
				width: 90px;
				height: 38px;
				text-align: center;
				line-height: 40px;
				font-size: 14px;
				color: white;
				z-index: 100;
			}
			.navs i:hover{
				color: #fff !important;
				background: url(__INDEX__/img/navBg.png);
				background-size: 100%;
			}
			.actives {
				color: #fff !important;
				background: url(__INDEX__/img/navBg.png);
				background-size: 100%;
			}
			.page-content{width: 100%;}
			 .demandlist{
			 	width: 100%;
			 }
			.project-list{width: 1200px;
			margin: 0 auto;
			padding: 0 20px;}
			.project-list .round{
				/*background-image: url(__INDEX__/img/index/phone.png);*/
				padding: 40px 18px 80px 18px;
    			width: 359px;
    			height: 688px;
    			border-radius: 25px;
    			margin-right: 40px;
    			border: none;
    			  border: 1px solid #d2d2d2;
    			  box-shadow: 0 4px 20px 2px rgba(28, 57, 81, 0.18);
			}
			.project-list .round .rounds{
				width: 100%;
				height: 100%;
    			overflow: hidden;
    			position: relative;
    			display: inline-block;
   			 	border: 1px solid gainsboro;
			}
			.rounds a{
			width: 100%;
			height: 100%;
			}
			.rounds a .proImg{
				width:100%;
				height: 100%;
			}

			.project-list .round:hover{
				background-image: url(__INDEX__/img/index/phone.png);
				box-shadow: 0 8px 20px 0 rgba(28,57,81,0.24);

			}
			.photograph{
				background-color: rgba(255,255,255,0.01);

			}
			.photograph img{
				margin-top: 15px;
				margin-left: 15px;
				width: 40px;
				height: 40px;
			}
		</style>
	</head>

	<body>

		<div class="sou">
			<div class="search">

				<div class="search1">
					<div class="navs">
						<i class="is">IT联合办公</i>
						<i class="is">需求</i>
						<i class="actives is">案例</i>
						<i class="is">人才</i>
					</div>
					<input type="text" name="" id="" value="" placeholder="搜索..." />
					<img src="__INDEX__/img/icon/fda.png" />
					<button onclick="one();">搜索</button>
					<p onclick="window.location.href='epiboly1.html'">免费发需求</p>
					<span>或者</span>
				</div>

			</div>
		</div>
		<div id="choice">
			<div class="choice_kind">
				<span text="产品类型：">产品类型：</span>
				<ul class="ty">
				<?php if($where['type']?? ''): ?>
					<li data-id="0">不限</li>
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;if($where['type'] == $vos['id']): ?>
                        <li class="active" data-id="<?php echo $vos['id']; ?>"><?php echo $vos['name']; ?></li>
                        <?php else: ?>
                        <li data-id="<?php echo $vos['id']; ?>"><?php echo $vos['name']; ?></li>
                    	<?php endif; endforeach; endif; else: echo "" ;endif; else: ?>
					<li class="active" data-id="0">不限</li>
                    <?php if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>
                        <li data-id="<?php echo $vos['id']; ?>"><?php echo $vos['name']; ?></li>
                    <?php endforeach; endif; else: echo "" ;endif; endif; ?>
					<!-- <li data="9" class="freeman_none" style="display:none;">直销系统类</li> -->
					<!-- <i class="more_choice">更多 <img src="https://www.315pr.com:443/resources/bootstrap/reset/img/ico68.png"></i> -->
					<i class="clear"></i>
				</ul>
				<i class="clear"></i>
			</div>
<!--不限-->
			<?php if(session('father_id')): if(is_array($type) || $type instanceof \think\Collection || $type instanceof \think\Paginator): $i = 0; $__LIST__ = $type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ty): $mod = ($i % 2 );++$i;?>
				<div class="choice_kind main abc<?php echo $ty['id']; ?>" data-id="<?php echo $ty['id']; ?>"  <?php echo !empty($ty['id']) && $ty['id']==session('father_id')?'style="border-bottom: 1px dashed rgba(0,0,0,0.14);"' : 'style="border-bottom: 1px dashed rgba(0,0,0,0.14);display: none;"'; ?>>
					<span text="主要功能：">主要功能：</span><!--游戏-->
					<ul class="xiao">
					<?php if(session('where.specific')): ?>
						<li data-id="0">不限</li>
					<?php else: ?>
						<li class="active" data-id="0">不限</li>
					<?php endif; if(is_array($specific) || $specific instanceof \think\Collection || $specific instanceof \think\Paginator): $i = 0; $__LIST__ = $specific;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sp): $mod = ($i % 2 );++$i;if($ty['id'] == $sp['father_id']): if($sp['id'] == session('where.specific')): ?>
								<li class="active" data-id="<?php echo $sp['id']; ?>"><?php echo $sp['name']; ?></li>
							<?php else: ?>
								<li data-id="<?php echo $sp['id']; ?>"><?php echo $sp['name']; ?></li>
							<?php endif; endif; endforeach; endif; else: echo "" ;endif; ?>
						<!-- <li data="7" class="freeman_none" style="display:none;">牌九</li>
						<i class="more_choice">更多 <img src="https://www.315pr.com:443/resources/bootstrap/reset/img/ico68.png"></i> -->
						<i class="clear"></i>
					</ul>
					<i class="clear"></i>
				</div>
				<?php endforeach; endif; else: echo "" ;endif; else: ?>
				<div class="choice_kind main unlimited abc0" style="border-bottom: 1px dashed rgba(0,0,0,0.14);">
					<span text="主要功能：">主要功能：</span>
					<ul class="xiao">
						<li class="active" data-id="0">不限</li>
	                        <?php if(is_array($specific) || $specific instanceof \think\Collection || $specific instanceof \think\Paginator): $i = 0; $__LIST__ = $specific;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voss): $mod = ($i % 2 );++$i;?>
	                            <li data-id="<?php echo $voss['id']; ?>"><?php echo $voss['name']; ?></li>
	                        <?php endforeach; endif; else: echo "" ;endif; ?>
						<!-- <li data="7" class="freeman_none" style="display:none;">共享会议室</li>
						<li data="8" class="freeman_none" style="display:none;">共享衣服</li>
						<i class="more_choice">更多 <img src="https://www.315pr.com:443/resources/bootstrap/reset/img/ico68.png"></i> -->
						<i class="clear"></i>
					</ul>

					<i class="clear"></i>
				</div>
			<?php endif; ?>

<!--全部-->	<div class="choice_kind system share">
				<span text="系统类型：" data="">系统类型：</span>
				<ul class="sys">

				<?php if(session('where.system_type')?? ''): ?>
					<li data-id="0">不限</li>
					<?php if(is_array($system) || $system instanceof \think\Collection || $system instanceof \think\Paginator): $i = 0; $__LIST__ = $system;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosss): $mod = ($i % 2 );++$i;if(session('where.system_type') == $vosss['id']): ?>
	                    <li data-id="<?php echo $vosss['id']; ?>" class="active"><?php echo $vosss['name']; ?></li>
	                    <?php else: ?>
	                    <li data-id="<?php echo $vosss['id']; ?>"><?php echo $vosss['name']; ?></li>
	                	<?php endif; endforeach; endif; else: echo "" ;endif; ?>
					<!-- <i class="more_choice">更多 <img src="https://www.315pr.com:443/resources/bootstrap/reset__INDEX__/img/ico68.png"></i> -->
					<i class="clear"></i>
				<?php else: ?>
					<li data-id="0" class="active">不限</li>
                        <?php if(is_array($system) || $system instanceof \think\Collection || $system instanceof \think\Paginator): $i = 0; $__LIST__ = $system;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vosss): $mod = ($i % 2 );++$i;?>
                            <li data-id="<?php echo $vosss['id']; ?>"><?php echo $vosss['name']; ?></li>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
					<!-- <i class="more_choice">更多 <img src="https://www.315pr.com:443/resources/bootstrap/reset__INDEX__/img/ico68.png"></i> -->
					<i class="clear"></i>
				<?php endif; ?>
				</ul>

				<i class="clear"></i>
			</div>
		</div>
		<!--end-->
		<div class="page-content" style="margin-top: 0">
			<div class="demandlist">
				<ul class="project-list" id="project-list1">
				<?php if(is_array($cases) || $cases instanceof \think\Collection || $cases instanceof \think\Paginator): $i = 0; $__LIST__ = $cases;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
					<li class="round">
						<div class="rounds">
							<a href="<?php echo url('cases/inside',['id'=>$vo['id']]); ?>" target="_blank">
							<img class="proImg" src="__INDEX__/img/index/18001.jpg" alt="">
							<div class="picList">
								<div class="similarity-title"><?php echo $vo['case_name']; ?></div>
								<div class="similarity_label">产品类型:<span><?php echo $vo['type']; ?></span></div>
								<div class="similarity_label">主要功能:<span><?php echo $vo['specific']; ?></span></div>
								<div class="similarity_label functionNames">系统类型:
									<span><?php if(is_array($vo['system_type']) || $vo['system_type'] instanceof \think\Collection || $vo['system_type'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['system_type'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$type): $mod = ($i % 2 );++$i;?> <?php echo $type; endforeach; endif; else: echo "" ;endif; ?></span>

								</div>
								<div class="similarity-intro"><?php echo $vo['brief']; ?></div>
								<div class="similarity-price"> ￥<span class="price"><?php echo $vo['money']; ?></span> </div>
								<div class="photograph"> <img src="__INDEX__/img/sj.png" alt=""> </div>
							</div>
						</a>
						</div>

					</li>
				<?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
					<i class="clear"></i>
				</ul>
				<div id="page-box" style="width: 1200px;margin: 0 auto;">
<!-- 					<div class="page-div" onclick="xia();">
						<h3>下一页</h3>
					</div> -->
					<input type="hidden" name="pageInput" value="52">
					<div class="page">
						<a class="" style="color:#b43d3d ;">1</a>
						<a href="javascript:;" data-page="2">2</a>

						<a href="javascript:;" class="page_next" onclick="xia();">下页</a>
					</div>
					<em><span class="now">1</span>/<span class="num">2</span>页&nbsp;&nbsp;共<span class="total">2</span>条</em>
				</div>
			</div>
		</div>
		<script type="text/javascript">
		</script>
		<div class="footer" style="background-color: #1e2831;">
			<div class="center">
				<p>2014-2017 汇谷电子科技有限公司 版权所有：ICP备12027515号-1</p>
			</div>
		</div>
		<div class="fixedTop" style="position:relative">
		</div>

		<!--请将以下码嵌入到您网页源代码的最后面，通常是</body></HTML>之后,这样在服务器升级维护的时候也不会影响您的网页打开呈现速度。-->
		<!-- <script src="__INDEX__/js/demand.js" type="text/javascript" charset="utf-8"></script> -->

		<script src="__INDEX__/js/main.js" type="text/javascript" charset="utf-8"></script>
		<script src="__INDEX__/js/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<script>

			$('.choice_kind li').click(function(){
				$("#page-box .now").text('1')
				$(this).parents(".choice_kind").find("li").removeClass("active").end().find(".freeman_none").css("display",'none');
				$(this).addClass("active");
				$(this).parent().find(".more_choice").css('display','block');
				if($(this).attr("class").indexOf("freeman_none")>-1){
					$(this).parents(".choice_kind").find("span:eq(0)").html($(this).text()+":").css("color",'#ff5454').attr("data",$(this).attr('data'))
				}else{
					$(this).parents(".choice_kind").find("span:eq(0)").html($(this).parents(".choice_kind").find("span:eq(0)").attr("text")).css("color",'#333').attr("data",$(this).attr('data'))
				}

				var cla = $(this).parent().attr('class');
				var id = $(this).attr('data-id');
				//alert(id);
				host = window.location.host
				if (cla=='ty') {
					window.location.href='http://'+host+'/index/cases/index/ty/'+id;
				}else if(cla=='xiao'){
					window.location.href='http://'+host+'/index/cases/index/xiao/'+id;
				}else if(cla=='sys'){
					window.location.href='http://'+host+'/index/cases/index/sys/'+id;
				}else{
					window.location.href='';
				}


			})
			$(".more_choice").click(function(){
				$(this).parent().find(".freeman_none").css("display",'block')
				$(this).css("display",'none')
			})
			// $(function() {
			// 	demandlist()
			// })
			/*nav 点击变色*/

			$(".navs i").click(function() {
				$(".navs i").removeClass("actives");
				tt = $(".navs i").index($(this));
				var tts = $(".navs i")[tt];
				tts.className = "actives is";
			});

			var heg = $(".sou").width() * 0.53 / 2;
			$(".sou").height(heg);
			$(document).bind("contextmenu copy selectstart", function() {
				return false;
			});
			/*禁用ctrl+c ctrl+v*/
			$(document).keydown(function(e) {
				if(e.ctrlKey && (e.keyCode == 65 || e.keyCode == 67)) {
					return false;
				}
			})

			/*var he = $(".round").height() + 50;
			$(".page-div").width($(".round").width());
			$(".page-div").height($(".round").height())
			$(".page-div").css("top", "-" + he + "px");*/

			function xia() {
				var pl1 = document.getElementById("project-list1");
				if(pl1.style.display == "none") {
					alert("当前为最后一页")

				} else {
					$(".project-list:nth-child(1)").css("display", "none");
					$(".project-list:nth-child(2)").css("display", "block");
					$(".page a:nth-child(2)").css("color", "#b43d3d");
					$(".page a:nth-child(1)").css("color", "black");
				}
			}
			$(".page a").click(function() {

				if($(this).text() == "1") {
					$(".page a:nth-child(1)").css("color", "#b43d3d");
					$(".page a:nth-child(2)").css("color", "black");
					$(".project-list:nth-child(1)").css("display", "block");
					$(".project-list:nth-child(2)").css("display", "none");
				} else if($(this).text() == "2") {
					$(".page a:nth-child(2)").css("color", "#b43d3d");
					$(".page a:nth-child(1)").css("color", "black");
					$(".project-list:nth-child(1)").css("display", "none");
					$(".project-list:nth-child(2)").css("display", "block");
				}
			})

			function one() {
				if($(".navs .actives").text() == "需求") {
					window.location.href = "index.html";
				} else if($(".navs .actives").text() == "案例") {
					window.location.href = "indexs2.html";
				}else if($(".navs .actives").text() == "人才"){
					/*window.location.href = "essential2.html";*/
				}else if($(".navs .actives").text() == "IT联合办公"){
					window.location.href = "it.html";
				}
			}
			$("#choice .choice_kind:nth-child(1) ul li").click(function() {
				var dataid = $(this).data("id");
				if (dataid!=0) {
					$("#choice .main").css("display", "none");
					$("#choice .abc"+dataid).css("display", "block");
					$("#choice .system").css("display","none");
					$("#choice .share").css("display", "block");
				}else{
					$("#choice .main").css("display", "none");
					$("#choice .abc0").css("display", "block");
					$("#choice .system").css("display","none");
					$("#choice .share").css("display", "block");
				}
			})
		</script>
		<script type="text/javascript">



		</script>
		<!--<script type="text/javascript" src="//s.union.360.cn/164203.js" async defer></script>-->
	</body>

</html>