/*$("#right-img").click(function(){
				$(".imgs").css("display", "block");
			})
			$(".imgs").click(function(){
				$(this).css("display", "none");
			})
			$("#right-a").click(function(){
				var hrefs = $(this).attr("href");
				if(hrefs !="javascript:void(0)"){
					
				}else{
					$(".imgs").css("display", "block");
				}
			})*/
function quweinongchang(){
				var h4text =  $("#right-h4").text();
				if(h4text == "趣味农场.系统开发"){
					$("#right-img").attr('src',"__INDEX__/img/qw.png");
				}else if(h4text == "奥一农场.系统开发"){
					$("#right-img").attr('src',"__INDEX__/img/images/nongchangs.png");
				}else if(h4text == "禅那客栈3380元／年起"){
					$("#right-img").attr('src',"__INDEX__/img/images/channa.png");
				}else if(h4text == "驾校小程序3380元／年起"){
					$("#right-img").attr('src',"__INDEX__/img/images/yue.png");
				}else if(h4text == "简心摄影3380元／年起"){
					$("#right-img").attr('src',"__INDEX__/img/images/jianxin.png");					 
				}else if(h4text == "美容美发私人定制预约"){
					$("#right-img").attr('src',"__INDEX__/img/apps/s1.png");					 
				}else if(h4text == "美容祛痘"){
					$("#right-img").attr('src',"__INDEX__/img/apps/s2.png");					 
				}else if(h4text == "向往日本预约"){
					$("#right-img").attr('src',"__INDEX__/img/apps/s3.png");					 
				}else if(h4text == "恒瑞家政服务"){
					$("#right-img").attr('src',"__INDEX__/img/apps/s4.png");					 
				}else if(h4text == "婚纱摄影预约"){
					$("#right-img").attr('src',"__INDEX__/img/apps/c1.png");					 
				}else if(h4text == "辣妈养娃"){
					$("#right-img").attr('src',"__INDEX__/img/apps/j1.png");					 
				}else if(h4text == "母婴保健"){
					$("#right-img").attr('src',"__INDEX__/img/apps/j2.png");					 
				}else if(h4text == "日本高端旅行"){
					$("#right-img").attr('src',"__INDEX__/img/apps/l1.png");					 
				}else if(h4text == "Askiu的温馨小镇"){
					$("#right-img").attr('src',"__INDEX__/img/apps/l2.png");					 
				}else if(h4text == "精品公寓"){
					$("#right-img").attr('src',"__INDEX__/img/apps/l3.png");					 
				}else if(h4text == "精品宾馆"){
					$("#right-img").attr('src',"__INDEX__/img/apps/l4.png");					 
				}else if(h4text == "尊霸披萨"){
					$("#right-img").attr('src',"__INDEX__/img/apps/n1.png");					 
				}else if(h4text == "广州美食家"){
					$("#right-img").attr('src',"__INDEX__/img/apps/n2.png");					 
				}else if(h4text == "点餐小程序"){
					$("#right-img").attr('src',"__INDEX__/img/apps/n3.png");					 
				}else if(h4text == "邵阳日报"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w1.png");					 
				}else if(h4text == "日本奥运体育科普"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w2.png");					 
				}else if(h4text == "婚礼定制"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w3.png");					 
				}else if(h4text == "建投商务网"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w4.png");					 
				}else if(h4text == "庭院设计"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w5.png");					 
				}else if(h4text == "婚纱摄影"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w6.png");					 
				}else if(h4text == "健康育发会"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w7.png");					 
				}else if(h4text == "茶叶展示"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w8.png");					 
				}else if(h4text == "串串加盟"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w9.png");					 
				}else if(h4text == "开发外包"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w10.png");					 
				}else if(h4text == "东圣康诺健身"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w11.png");					 
				}else if(h4text == "华恒法律咨询"){
					$("#right-img").attr('src',"__INDEX__/img/apps/w12.png");					 
				}else if(h4text == "FCC国潮服装电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d1.png");					 
				}else if(h4text == "欧莱德化妆品电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d2.png");					 
				}else if(h4text == "映尼女装电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d3.png");					 
				}else if(h4text == "左为女装电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d4.png");					 
				}else if(h4text == "鞋业商城"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d5.png");					 
				}else if(h4text == "中国珠宝首饰电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d6.png");					 
				}else if(h4text == "零售饮料"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d7.png");					 
				}else if(h4text == "旨享见康保健品"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d8.png");					 
				}else if(h4text == "严选优活酒类电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d9.png");					 
				}else if(h4text == "白酒类电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d10.png");					 
				}else if(h4text == "酒吧类电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d11.png");					 
				}else if(h4text == "烧烤小吃电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d12.png");					 
				}else if(h4text == "茶叶电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d13.png");					 
				}else if(h4text == "正品手机购电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d14.png");					 
				}else if(h4text == "电视家用电器电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d16.png");					 
				}else if(h4text == "手绘板数码电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d17.png");					 
				}else if(h4text == "红木家具电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d18.png");					 
				}else if(h4text == "家装卫浴电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d19.png");					 
				}else if(h4text == "凡品灯饰电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d20.png");					 
				}else if(h4text == "书法字画电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d21.png");					 
				}else if(h4text == "跆拳道健身电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d22.png");					 
				}else if(h4text == "律师法务电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d23.png");					 
				}else if(h4text == "鲜花电商"){
					$("#right-img").attr('src',"__INDEX__/img/apps/d24.png");					 
				}
				$("#imgs").attr('src',$("#right-img").attr("src"));
			}