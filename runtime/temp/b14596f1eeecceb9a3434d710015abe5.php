<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\GitHub\itoffice\public/../application/index\view\cases\inside.html";i:1516946672;}*/ ?>
<!DOCTYPE html>
<html>

	<head>
		<meta charset="UTF-8">
		<title>IT联合办公</title>
		<link rel="stylesheet" type="text/css" href="__INDEX__/css/header.css" />

		<script src="__INDEX__/js/js/jquery.js" type="text/javascript" charset="utf-8"></script>
		<style type="text/css">
			@font-face {
				font-family: "微软雅黑";
			}

			input:not([type]),
			input[type="email" i],
			input[type="number" i],
			input[type="password" i],
			input[type="tel" i],
			input[type="url" i],
			input[type="text" i] {
				padding: 1px 0px;
			}

			user agent stylesheet input {
				-webkit-appearance: textfield;
				background-color: white;
				-webkit-rtl-ordering: logical;
				cursor: auto;
				padding: 1px;
				border-width: 2px;
				border-style: inset;
				border-color: initial;
				border-image: initial;
			}

			user agent stylesheet input,
			textarea,
			select,
			button {
				text-rendering: auto;
				color: initial;
				letter-spacing: normal;
				word-spacing: normal;
				text-transform: none;
				text-indent: 0px;
				text-shadow: none;
				display: inline-block;
				text-align: start;
				margin: 0em;
				font: 400 13.3333px Arial;
			}

			user agent stylesheet input,
			textarea,
			select,
			button,
			meter,
			progress {
				-webkit-writing-mode: horizontal-tb;
			}

			input::-webkit-outer-spin-button,
			input::-webkit-inner-spin-button {
				-webkit-appearance: none !important;
				margin: 0;
				text-align: right;
				text-indent: 2em;
			}

			body,
			div,
			span,
			p,
			a,
			img,
			input,
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			button,
			ul,
			li,
			iframe {
				margin: 0;
				padding: 0;
			}

			body {
				-moz-user-select: none;
				/*firefox私有属性*/
				-webkit-user-select: none;
				/*webkit内核私有属性*/
				-ms-user-select: none;
				/*ie 私有属性*/
				-khtml-user-select: none;
				/*khtml 内核私有属性*/
				-o-user-select: none;
				/*Opera 私有属性*/
				user-select: none;
				/*css3 属性*/
			}

			a {
				display: block;
				text-decoration: none;
				color: #737373;
			}

			img {
				display: block;
			}

			.container {
				width: 100%;
				background-color: #F2F2F2;
			}
			/*one*/

			.container .current {
				margin-bottom: 20px;
				background-color: white;
				padding: 20px 0;
			}

			.center {
				width: 1200px;
				margin: 0 auto;
				overflow: hidden;
			}

			.center .left {
				background-image: url(__INDEX__/img/index/phone.png);
				padding: 40px 18px 80px 18px;
				width: 325px;
				margin: 0 auto;
				border-radius: 30px;
				float: left;
				margin-left: 150px;

			}

			.left {
				box-shadow: 0 4px 12px 0 rgba(28, 57, 81, 0.16);
				border: none;
			}

			.left:hover {
				box-shadow: 0 8px 20px 0 rgba(28, 57, 81, 0.24);
			}

			.center .right {
				position: relative;
				width: 565px;
				color: #333;
				float: right;
			}

			.right {
				margin-top: 20px;
				width: 600px;
				overflow: hidden;
			}
			/*two*/

			.submenu {
				width: 1200px;
				border-bottom: 1px solid #0368BD;
				overflow: hidden;
				height: 40px;
				background-color: white;
			}

			.submenu2 {
				position: fixed;
				top: 0;
				left: 50%;
				margin-left: -600px;
			}

			.submenu a {
				float: left;
				width: 120px;
				height: 40px;
				line-height: 40px;
				text-align: center;
				color: black;
				font-size: 16px;

			}

			.submenu .active {
				background-color: #0368BD;
				color: white;
			}

			#tables {

				width: 100%;
				border-collapse: collapse;
				border: 1px solid black;
				margin-bottom: 10px;
			}

			#tables>tr {
				width: 100%;
				border: 1px solid black;
			}

			#tables>tr>td {
				width: 25%;
				box-sizing: border-box;
				border: 1px solid black;
				height: 50px;
			}

			#tables tr td p {
				width: 100%;
				text-align: center;
				padding: 30px 0;
				font-size: 20px;
			}
			#tables tr:nth-child(1){
				background-color: #CCCCCC;
			}
			#tables tr:nth-child(2) td p,#tables tr:nth-child(3) td p,#tables tr:nth-child(4) td p,#tables tr:nth-child(5) td p{
				font-size: 22px;
			}
			.column h3 {
				width: 100%;
				text-align: center;
				padding: 65px 0;
				font-size: 26px;
			}

			.column>img {
				width: 90%;
				margin: 20px auto;
			}
			/*banner*/

			li {
				list-style: none;
			}

			.all {
				width: 322px;
				height: 560px;
				border: 1px solid #ccc;
				position: relative;
			}

			.screen {
				width: 322px;
				height: 560px;
				overflow: hidden;
				position: relative;
			}

			.screen li {
				width: 322px;
				height: 560px;
				overflow: hidden;
				float: left;
			}

			.screen li img {
				width: 322px;
				height: 560px;
			}

			.screen ul {
				position: absolute;
				left: 0;
				top: 0px;
				width: 3000px;
			}

			.all ol {
				position: absolute;
				right: 10px;
				bottom: 10px;
				line-height: 20px;
				text-align: center;
			}

			.all ol li {
				float: left;
				width: 20px;
				height: 20px;
				background: #fff;
				border: 1px solid #ccc;
				margin-left: 10px;
				cursor: pointer;
			}

			.all ol li.current {
				background: yellow;
			}

			#arr {
				display: none;
			}

			#arr span {
				width: 60px;
				height: 60px;
				position: absolute;
				left: 5px;
				top: 50%;
				margin-top: -20px;
				background: #000;
				cursor: pointer;
				line-height: 60px;
				text-align: center;
				font-weight: bold;
				font-family: '黑体';
				font-size: 50px;
				color: #fff;
				opacity: 0.3;
				border: 1px solid #fff;
			}

			#arr #right {
				right: 5px;
				left: auto;
			}

			.screen ol {
				opacity: 0;
			}
			/**/

			.right {
				position: relative;
			}

			.right h4 {
				font-size: 32px;
				height: 70px;
				line-height: 70px;
			}

			.right .money {
				width: 100%;
				height: 80px;
				overflow: hidden;
				margin: 20px 0;
			}

			.right .money span {
				float: left;
				color: #e51515;
				;
			}

			.right .money span:nth-child(1) {
				font-size: 18px;
				margin-top: 30px;
			}

			.right .money span:nth-child(2) {
				font-size: 48px;
			}

			.text {
				background-color: #f3f3f3;
			}

			.text div {
				width: 100%;
				overflow: hidden;
			}

			.text div p {
				float: left;
				margin: 10px 0;
			}

			.text div p:nth-child(1) {
				width: 20%;
				line-height: 25px;
				font-weight: 600;
				font-size: 20px;
				margin-left: 3%;
			}

			.text div p:nth-child(2) {
				width: 73%;
				line-height: 25px;
				font-size: 16px;
				font-weight: 500;
				margin-left: 2%;
			}
			.text div:nth-child(1) p:nth-child(2) {
				word-break:break-all;
								display:-webkit-box;
								-webkit-line-clamp:9;
								-webkit-box-orient:vertical;
								overflow:hidden;
			}
			.submits {
				width: 300px;
				background-color: #0368bd;
				height: 50px;
				line-height: 50px;
				border-radius: 5px;
				text-align: center;
				margin-top: 50px;
				color: white;
				font-size: 18px;
			}

			.code {
				width: 100px;
				position: absolute;
				top: 20px;
				right: 30px;
			}

			.code img {
				width: 100px;
			}

			.code p {
				width: 100px;
				background-color: #0368bd;
				height: 35px;
				line-height: 35px;
				border-radius: 5px;
				text-align: center;
				margin-top: 10px;
				color: white;
				font-size: 16px;
			}
			/*轮播弹出*/

			.phone,
			.forms {
				width: 100vw;
				height: 100vh;
				background-color: rgba(0, 0, 0, 0.9);
				position: fixed;
				top: 0;
				left: 0;
				z-index: 500;
				display: none;
			}

			.phone iframe {
				width: 390px;
				height: 690px;
				position: absolute;
				top: 50%;
				left: 50%;
				margin-left: -183px;
				margin-top: -343px;
				border: none;
			}
			/*表单*/

			.forms form::-webkit-scrollbar {
				display: none;

			}

			.forms form {
				height: 80vh;
				width: 1000px;
				background-color: white;
				padding: 10px;
				overflow: auto;
				position: fixed;
				top: 50%;
				left: 50%;
				margin-left: -500px;
				margin-top: -40vh;
				border-radius:10px ;
			}

			.forms form ul li:nth-child(1) {
				width: 900px;
				position: fixed;
				top: 10vh;
				right: 50%;
				margin-right: -450px;
				background-color: white;
			}

			/*.forms form ul li:nth-child(1) p {
				width: 60px;
				height: 60px;
				border-radius: 50%;
				background-color: white;
				position: fixed;
				top: 8vh;
			}*/

			.forms form ul {
				width: 80%;
				margin: 0 auto;
			}

			.forms form ul li {
				width: 100%;
				overflow: auto;
				margin-bottom: 20px;
				padding: 10px 0;
			}
			.forms form ul li .item-input span{
				display: block;
			}
			.forms form ul .item-li:nth-child(1) {
				font-size: 22px;
				line-height: 80px;
				height: 80px;
			}

			.forms form ul .item-li:nth-child(1) h3 {
				float: left;
			}

			.forms form ul .item-li:nth-child(1) p {
				float: right;
			}

			.forms form ul .item-li div {
				float: left;
			}

			.item-li div.item-name {
				width: 20%;
				text-align: right;
				line-height: 60px;
				font-size: 18px;
			}

			.item-li div.item-input {
				width: 70%;
				margin-left: 5%;
			}

			.item-li div.item-input input {
				width: 500px;
				height: 60px;
				line-height: 60px;
				font-size: 16px;
				padding: 0 5px;
				border-color: #f5f5f5;
				border: 2px solid #f5f5f5;
			/*-webkit- width: 500px;
				height: 60px;
				line-height: 60px;
				font-size: 16px;
				padding: 0 5px;
				border-color: #f5f5f5;
				border: 2px solid #f5f5f5;*/

			}

			.item-li div.item-input textarea {
				width: 500px;
				height: 120px;
				line-height: 60px;
				font-size: 16px;
				padding: 0 5px;
				border: 2px solid #f5f5f5;
			}

			.item-li div.item-input span {
				line-height: 25px;
				font-size: 14px;
			}

			.item-input input:hover {
				border: 2px solid #CCCCCC;
			}

			.item-li .item-input .btn {
				height: 50px;
				text-align: center;
				line-height: 50px;
				background-color: #0368bd;
				border-radius: 10px;
				color: white;
				border: none;
				margin-left: 30%;
				font-size: 18px;
			}

			.beijin {
				width: 100vw;
				height: 100vh;
				background-color: rgba(0, 0, 0, 0.5);
				position: fixed;
				top: 0;
				left: 0;
				z-index: 200;
				display: none;
			}

			.good {
				margin: 30vh auto;
				padding: 50px;
				width: 400px;
				background-color: white;
				border-radius: 10px;
			}

			.good h5,
			.good p {
				width: 100%;
				text-align: center;
			}

			.good h5 {
				font-size: 16px;
				margin: 0;
				margin-bottom: 20px;
			}

			.good p {
				font-size: 15px;
				font-weight: 600;
			}

			.qud {
				border: 1px solid red;
				color: red;
				border-radius: 10px;
				padding: 10px 0;
				margin-top: 20px;

			}
			  .navs{
			 	width: 90%;
			 	margin: 0 auto;
			 	padding: 10px;
			 }
			 .navs li{
			 	float: left;
			 }
			.navs .is{
				display: block;
				width: 90px;
				height: 38px;
				text-align: center;
				line-height: 40px;
				font-size: 14px;
				color: black;
				z-index: 100;
			}
			.navs a:hover{
				color: #fff !important;
				background: url(__INDEX__/img/navBg.png);
				background-size: 100%;
				/*background-color: #ff5454;*/
			}
			.actives {
				color: #fff !important;
				background: url(__INDEX__/img/navBg.png);
				background-size: 100%;
				/*background-color: #ff5454;*/

			}
			input{
   -webkit-padding:10px 0;
   -webkit-height: 60px;
  -webkit-font-size: 16px;
   -webkit-line-height: 40px;
}
		</style>
	</head>

	<body>
		<div style="width:100%;box-shadow:0 2px 4px 0 rgba(58,68,85,0.16);position:relative;z-index:99; background-color: rgba(0,0,0,0.1);" id="nav">
			<div class="head">
				<div class="logo">
					<a href="###">
						<!--<img src="https://www.315pr.com:443/resources/bootstrap/__INDEX__/img/logo_top1.png">--></a>
				</div>
				<ul class="navs">
					<li >
						<a href="it.html" class="is">IT联合办公</a>
					</li>
					<li>
						<a href="index.html" class="is">需求</a>
					</li>
					<li>
						<a href="indexs2.html" class="is actives">案例</a>
					</li>
					<li>
						<a href="###"class="is">人才</a>
					</li>
					<!--<li><a href="https://www.315pr.com:443/case/page.shtml">案例</a></li>-->
					<!-- <li><a href="https://www.315pr.com:443/smart/list.shtml">媒介</a></li> -->
					<!--<li><a href="https://www.315pr.com:443/report/page.shtml">资讯</a></li>-->

				</ul>
				<!--<div class="getInto">
			</div>
		<div class="nav_box">
			<a tolink="https://www.315pr.com:443/user/demandStart.shtml" class="nav_a">发布需求</a>
			<a tolink="https://www.315pr.com:443/supplier/reg.shtml" class="nav_a">申请供应商</a>
			<a class="nav_a" tolink="
			https://www.315pr.com:443/user/user_info.shtml
			">加入智库</a>
			<div class="nav_bg"></div>
		</div>-->
				<div style="clear:both"></div>
			</div>
		</div>
		<div class="container">
			<div class="current" id="phone_height">
				<div class="center">
					<div class="left" style="margin-bottom: 10px;">
						<div class="ban2" id="ban_pic1">
							<div class="all" id='box'>
								<div class="screen">
									<ul>
										<?php if(is_array($cases['images']) || $cases['images'] instanceof \think\Collection || $cases['images'] instanceof \think\Paginator): $i = 0; $__LIST__ = $cases['images'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>
										<li><img src="<?php echo $vos; ?>" /></li>
										<?php endforeach; endif; else: echo "" ;endif; ?>
									</ul>
									<ol>
										<!-- 动态创建的小方块，添加在这里，样式已经给写好了-->
									</ol>
								</div>
								<div id="arr"><span id="left">&lt;</span><span id="right">&gt;</span></div>
							</div>
						</div>
					</div>
					<div class="right">
						<h4> <?php echo $cases['case_name']; ?></h4>
						<div class="money">
							<span>
								￥
							</span>
							<span id="">
								<?php echo $cases['money']; ?>
							</span>
						</div>
						<div class="text">
							<div class="">
								<p>产品简介
								</p>
								<p><?php echo $cases['brief']; ?>
								</p>
							</div>
							<div class="">
								<p>产品类型
								</p>
								<p><?php echo $cases['type']; ?>
								</p>
							</div>
							<div class="">
								<p>主要功能
								</p>
								<p><?php echo $cases['specific']; ?>
								</p>
							</div>
							<div class="">
								<p>系统类型
								</p>
								<p>
								<?php if(is_array($system_type) || $system_type instanceof \think\Collection || $system_type instanceof \think\Paginator): $i = 0; $__LIST__ = $system_type;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$na): $mod = ($i % 2 );++$i;?>
								<?php echo $na; endforeach; endif; else: echo "" ;endif; ?>
								</p>
							</div>
						</div>
						<p class="submits">提交项目需求</p>
						<div class="code">
							<img src="<?php echo $cases['code']; ?>" />
							<p onclick="window.location='<?php echo $cases['preview']; ?>'">预览</p>
						</div>
					</div>
				</div>
			</div>
			<div class="current">
				<div class="center" id="center">
					<div class="submenu" id="nav2">
						<a href="#zero" class="active">项目报价</a>
						<a href="#one">功能菜单</a>
						<a href="#two">思维导图</a>
						<a href="#three">开发顾问</a>
					</div>
					<div class="column" id="column">
						<?php echo $cases['info']; ?>
						<!-- <div class="" id="column_1">
							<h3 id="zero">项目报价</h3>
						<table border="" cellspacing="" cellpadding="" id="tables">
							<tr>
								<td>
									<p>修改幅度</p>
								</td>
								<td>
									<p>开发报价</p>
								</td>
								<td>
									<p>开发周期</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>0%</p>
								</td>
								<td>
									<p>6000</p>
								</td>
								<td>
									<p>25天</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>10%</p>
								</td>
								<td>
									<p>65000</p>
								</td>
								<td>
									<p>30天</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>20%</p>
								</td>
								<td>
									<p>75000</p>
								</td>
								<td>
									<p>45天</p>
								</td>
							</tr>
							<tr>
								<td>
									<p>30%</p>
								</td>
								<td>
									<p>90000</p>
								</td>
								<td>
									<p>60天</p>
								</td>
							</tr>

						</table>
						</div>
						<div class="" id="column_2" style="width: 100%;">
							<h3 id="one">功能菜单</h3>
						<img src="__INDEX__/img/biao.png"  style="width: 100%;"/>
						</div>
						<div class="" id="column_3" style="width: 100%;">
								<h3 id="two">思维导图</h3>
						<img src="__INDEX__/img/5.18.png" style="width: 100%;"/>
						</div>
						<div class="" id="column_4" style="width: 100%;">
							<h3 id="three">开发顾问</h3>
						<img src="__INDEX__/img/service-instructions.jpg"style="width: 100%;" />
						</div> -->

					</div>
				</div>

			</div>

		</div>
		<div class="phone">
			<iframe src="banner.html" width="" height=""></iframe>
		</div>
		<div class="forms">
			<form action="" method="post">
				<ul>
					<li class="item-li">
						<h3>提交项目需求</h3>
						<p><img src="__INDEX__/img/icon/ca.png" style="width: 60px;" /></p>
					</li>
					<li class="item-li" style="margin-top: 10vh;">
						<div class="item-name">项目名称：</div>
						<div class="item-input"><input type="text" class="" id="Xname" placeholder="仅需对接平台"><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name">补充说明：</div>
						<div class="item-input"><textarea placeholder="可以将您不同于此项目的功能或者需求特别说明的事项写在这里..." id="brief" class=""></textarea><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name">您的姓名：</div>
						<div class="item-input"><input type="text" class="" id="names" placeholder="请输入您的姓名"><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name">微信：</div>
						<div class="item-input"><input type="text" class="" id="weixin" placeholder="请输入微信号"><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name">手机：</div>
						<div class="item-input"><input type="text" class="" id="ph" placeholder="请输入手机号" maxlength="11"><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name">邮箱：</div>
						<div class="item-input"><input type="text" class="" id="mail" placeholder="请输入邮箱"><span></span>

						</div>
					</li>
					<li class="item-li">
						<div class="item-name"></div>
						<div class="item-input">
							<!--<input type="button" value="联系我们" class="btn"/>-->
							<p class="btn">请联系我</p>

						</div>
					</li>
				</ul>

			</form>
		</div>
		<div class="beijin">
			<div class="good">
				<h5>提交项目需求成功！</h5>

				<p class="qud" id="qd">确定</p>
			</div>
		</div>
		<div class="footer" style="background-color: #1e2831;">
			<div class="center">
				<p>2014-2017 汇谷电子科技有限公司 版权所有：ICP备12027515号-1</p>
			</div>
		</div>
		<script src="__INDEX__/js/form.js" type="text/javascript" charset="utf-8"></script>
		<script type="text/javascript">
			$("#Xname").val($(".center .right h4").text());
			$(".submits").click(function() {
				$(".forms").css("display", "block");
			})
			$(".forms form li:nth-child(1) p").click(function() {
				$(".forms").css("display", "none");
			})
			$(".beijin").click(function() {
				$(".beijin").css("display", "none");
			})
			/*表单*/
			var xname = document.getElementById("Xname");
			var brief = document.getElementById("brief");
			var names = document.getElementById("names");
			var wei = document.getElementById("weixin");
			var phs = document.getElementById("ph");
			var mail = document.getElementById("mail");

			yanZheng(xname, /^[\s\S]*.*[^\s][\s\S]*$/);
			yanZheng(brief, /^[\s\S]*.*[^\s][\s\S]*$/);
			yanZheng(names, /^[\s\S]*.*[^\s][\s\S]*$/);
			yanZheng(wei, /^[a-z_\d]+$/);
			yanZheng(phs, /^[\s\S]*.*[^\s][\s\S]*$/);
			yanZheng(mail, /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/);
			$(".btn").click(function() {
				yanz(xname, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanz(brief, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanz(names, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanz(wei, /^[a-z_\d]+$/);
				yanz(phs, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanz(mail, /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+(.[a-zA-Z0-9_-])+/);
				if(xname.value == "") {
					alert("请输入项目名称")
				} else {
					if(brief.value == "") {
						alert("请输入补充说明")
					} else {
						if(names.value == "") {
							alert("请输入您的姓名")
						} else {
							if(weixin.value == "") {
								alert("请输入微信号")
							} else {
								if(ph.value == "") {
									alert("请输入手机号")
								} else {
									if(mail.value == "") {
										alert("请输入邮箱")
									} else {
										$(".forms").css("display", "none");
										$(".beijin").css("display", "block");
									}
								}
							}
						}
					}
				}
			})
		</script>
		<script type="text/javascript">
			$("input").onmouseover = function() {
				$("input").css("border-color", "#cccccc");
			};
			$("input").onmouseout = function() {
				$("input").css("border-color", "#f5f5f5");
			}

			$(".head .nav li:eq(2) a").addClass("active");
			$("#box .screen").click(function() {
				$(".phone").css("display", "block");
			})
			$(".phone").click(function() {
				$(".phone").css("display", "none");
			})
			/*第一个；轮播*/
			//获取元素
			var box = document.getElementById("box");
			var screen = box.children[0];
			var ul = screen.children[0];
			var lisUl = ul.children;
			var ol = screen.children[1];
			var arr = box.children[1];
			var arrLeft = arr.children[0];
			var arrRight = arr.children[1];

			//获取图片宽
			var imgWid = screen.offsetWidth;
			//获取宽度时，我们借助父元素的宽度，原因是因为图片加载速度比较慢，结构生成的快。
			//1 获取同等大小的父级元素的宽
			//2 在事件内获取
			//3 在window.onload中执行代码

			//根据图片张数创建小方块
			for(var i = 0; i < lisUl.length; i++) {
				var li = document.createElement("li");
				li.innerHTML = i + 1;
				ol.appendChild(li);
			}

			//跟每一个li添加事件效果
			var lisOl = ol.children;
			lisOl[0].className = "current";

			for(var i = 0; i < lisOl.length; i++) {
				lisOl[i].index = i;
				lisOl[i].onclick = function() {
					//检测抽回
					if(pic == lisUl.length - 1) {
						ul.style.left = 0 + "px";
					}

					for(var i = 0; i < lisOl.length; i++) {
						lisOl[i].className = "";
					}

					this.className = "current";
					//让ul运动
					animate(ul, -imgWid * this.index);

					pic = this.index;
				};
			}

			//左右按钮点击效果
			var pic = 0;
			//克隆第一张图片
			var firstPic = lisUl[0].cloneNode(true);
			ul.appendChild(firstPic);

			//点击右按钮
			arrRight.onclick = play;

			arrLeft.onclick = function() {
				if(pic == 0) {
					ul.style.left = -ul.offsetWidth + imgWid + "px";
					pic = lisUl.length - 1;
				}
				pic--;
				animate(ul, -pic * imgWid);

				for(var i = 0; i < lisOl.length; i++) {
					lisOl[i].className = "";
				}
				lisOl[pic].className = "current";

			};

			//自动播放
			var timer = null;

			timer = setInterval(play, 1500);

			//移入移出
			box.onmouseover = function() {
				arr.style.display = "block";
				clearInterval(timer);
			};

			box.onmouseout = function() {
				arr.style.display = "none";
				timer = setInterval(play, 1500);
			};

			function play() {
				if(pic == lisUl.length - 1) {
					//抽回
					ul.style.left = 0 + "px";
					//pic归零
					pic = 0;
				}
				//跑起来
				pic++;
				animate(ul, -pic * imgWid);

				//使用pic作为索引值
				for(var i = 0; i < lisOl.length; i++) {
					lisOl[i].className = "";
				}

				//如果显示的是假的第一张
				if(pic == lisUl.length - 1) {
					lisOl[0].className = "current";
				} else {
					lisOl[pic].className = "current";
				}

			};

			function animate(tag, target) {
				clearInterval(tag.timer);
				tag.timer = setInterval(function() {
					var leader = tag.offsetLeft;
					//step = ( target - leader ) / 10
					var step = (target - leader) / 10;
					//处理一下step的值，对step进行向上取整
					step = leader > target ? Math.floor(step) : Math.ceil(step);
					//leader = leader +  step
					leader = leader + step;

					//设置给left值
					tag.style.left = leader + "px";
					if(leader == target) {
						clearInterval(tag.timer);
					}
				}, 17);
			}
		</script>
		<script type="text/javascript">
			var righ = $(".forms form ul li:nth-child(1) p");
			setInterval(function() {
				var ri = ($(window).width() - 1000) / 2 - 40;
				$(".forms form ul li:nth-child(1) p").css("right", ri + "px");
			}, 1000);
			$("#nav2 a").click(function() {
				$("#nav2 a").removeClass("active");
				$(this).addClass("active");
			})
			var ph = document.getElementById("phone_height");
			var nav2 = document.getElementById("nav2");
			var nav = document.getElementById("nav");
			var column = document.getElementById("column");
			var col1 = document.getElementById("column_1");
			var col2 = document.getElementById("column_2");
			var col3 = document.getElementById("column_3");

			function myScroll() {
				return {
					top: window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0,
					left: window.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft || 0
				};
			}
			window.onscroll = function() {
				var pos = myScroll();
				var phs = nav.offsetHeight + ph.offsetHeight;
				var two = col1.offsetHeight+nav.offsetHeight + ph.offsetHeight;
				var tr2 = col2.offsetHeight+col1.offsetHeight+nav.offsetHeight + ph.offsetHeight;
				var tr3 = col3.offsetHeight+col2.offsetHeight+col1.offsetHeight+nav.offsetHeight + ph.offsetHeight;
				/*alert(two+" "+tr2+" "+tr3)*/
				if(pos.top > phs) {
					nav2.className = "submenu2 submenu";
					column.style.marginTop = "41px";
					$("#nav2 a").removeClass("active");
					$("#nav2 a:nth-child(1)").addClass("active");
					if(pos.top > two){
						$("#nav2 a").removeClass("active");
						$("#nav2 a:nth-child(2)").addClass("active");
						if(pos.top > tr2){
							$("#nav2 a").removeClass("active");
							$("#nav2 a:nth-child(3)").addClass("active");
							if(pos.top > tr3){
								$("#nav2 a").removeClass("active");
						$("#nav2 a:nth-child(4)").addClass("active");
							}
						}
					}

				} else {
					nav2.className = "submenu";
					column.style.marginTop = "0px";

				}

			};
		</script>
	</body>

</html>