<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:69:"E:\GitHub\itoffice\public/../application/index\view\cases\phones.html";i:1517293282;}*/ ?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<title>IT联合办公</title>
		<style type="text/css">
			div,body,a,img,ul,li,ol,{
				margin: 0;
				padding: 0;
			}
			.left {
				background-image: url(__INDEX__/img/index/phone.png);
				padding: 40px 18px 80px 18px;
				width: 325px;
				margin: 0 auto;
				border-radius: 30px;
				float: left;
			}
		 .left{box-shadow: 0 4px 12px 0 rgba(28,57,81,0.16);border:none;}
	 .left:hover{box-shadow: 0 8px 20px 0 rgba(28,57,81,0.24);}
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


			.screen ul {
				padding: 0;
				margin: 0;
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
			.screen li {
				width: 322px;
				height: 560px;
				overflow: hidden;
				float: left;
			}
			.screen li img{
				width: 322px;
				height: 560px;
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

			#arr ,#arr1{
				display: none;
			}

			#arr span,#arr1 span {
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

			#arr #right,#arr1 #right{
				right: 5px;
				left: auto;
			}
			.screen ol{
				opacity: 0;
			}
		</style>
	</head>
	<body>
		<div class="left">
						<div class="ban2" id="ban_pic1">
							<div class="all" id='box'>
								<div class="screen">
									<ul>
										<?php if(is_array($images) || $images instanceof \think\Collection || $images instanceof \think\Paginator): $i = 0; $__LIST__ = $images;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vos): $mod = ($i % 2 );++$i;?>
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
		<script type="text/javascript">

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
	</body>
</html>
