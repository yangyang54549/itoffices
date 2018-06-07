function yans() {
			  	 $("a.send1").addClass("disabled");
                if($("#phone").val() == "") {
                   $(".overtop").text("请输入手机号码"); 
                
																overtop();
                    $("a.send1").remove("disabled");
                }  else {            
                	if(!(/^1[3456789]\d{9}$/.test($("#phone").val()))) {
						$(".overtop").text("手机号码有误，请重填"); overtop();
						$("a.send1").remove("disabled");
					} else {                         
                            $.post("{:url('login/codemsg')}",{mobile:$("#phone").val()},function(data) {
                                if (data.code==1) {                               	 
                                    var s = 60;
                                    var j = setInterval(function() {
                                        s = s - 1;
                                        $("a.send1").html(s + "秒后重新获取");
                                        if(s == 0) {
                                            clearInterval(j);
                                            $("a.send1").remove("disabled");
                                            $("a.send1").html("请重新获取");
                                        }
                                    }, 1000)
                                }else{
                                   $(".overtop").text(data.msg); $("a.send1").remove("disabled");overtop();
                                }
                            })
					}
				}
			}
			
				function overtop() {
					$("#form>div:nth-child(1)").after($("body>p.overtop").clone(true));
					$("#form .overtop").css("background-color", "rgba(0,0,0,0.7)");
					$("#form .overtop").css("display", "block");
					setTimeout(function() {
						$("#form .overtop").css("opacity", "0");
						$("#form .overtop").remove();
					}, 1000);
				}
				/*项目类型*/
				$(".publish-more").css("display", "none");

				var tt1 = 0;
				var lei1;
				var lei2;
				var lei1s;
				var lei2s;
				$(".type .item-type").click(function() {
					var ts = $(".type .item-type")[tt1];
					ts.className = "item-type";
					tt1 = $(".type .item-type").index($(this));
					var tts = $(".type .item-type")[tt1];
					tts.className = "selected item-type";

					lei1s = $(this).data('type');
					lei1 = tts.innerText;

				});
/*下一步*/
var hy;
var hys;
				$(".btn").click(function() {
					if($(".type .selected").text() == "") {
						$(".overtop").text("请选择项目类型");
						overtop();
					} else {
						if($(".item-value").find("option:selected").text() == "请选择") {
							$(".overtop").text("请选择项目所属行业");
							overtop();
						} else {
							$("#app").css("display", "none");
							$(".publish-more").css("display", "block");
							/*项目行业*/
							hy = $(".item-value").find("option:selected").text();
							hys = $(".item-value").find("option:selected").val();

						}
						/*alert($(".item-value").find("option:selected").text())		*/
					}

				})
				$(document).bind("contextmenu copy selectstart", function() {
					return false;
				});
				/*禁用ctrl+c ctrl+v*/
				$(document).keydown(function(e) {
					if(e.ctrlKey && (e.keyCode == 65 || e.keyCode == 67)) {
						return false;
					}
				})

				$(".head .nav li:eq(3) a").addClass("active")
				/*您期望的项目外包周期*/
				var tt2 = 0;
				$(".time .item-time").click(function() {
					var ts = $(".time .item-time")[tt2];
					ts.className = "item-time";
					tt2 = $(".time .item-time").index($(this));
					var tts = $(".time .item-time")[tt2];
					tts.className = "selected item-time";
					lei2s = $(this).data('term');
					lei2 = tts.innerText;

				});
				/*项目紧急程度*/
				var an = 0;
				var an1;
				var an1s;
				$(".item-input .urgency").click(function() {
					var ts = $(".item-input .urgency")[an];
					ts.className = "urgency";
					an = $(".item-input .urgency").index($(this));
					var tts = $(".item-input .urgency")[an];
					tts.className = "selected urgency";
					an1s = $(this).data('jinji');
					an1 = tts.innerText;
				});

				$(".beijin").click(function() {
					$(".beijin").css("display", "none");
					if(){
						window.location.href = "index.html";
					}
					
				})

				/*上一步*/
				$(".btn-pre").click(function() {
					$("#app").css("display", "block");
					$(".publish-more").css("display", "none");
				})
				
				/*验证*/
				var phone = document.getElementById("phone"); //手机号
				var Name = document.getElementById("Name"); //姓名
				var note = document.getElementById("note"); //短信验证
				var company = document.getElementById("company"); //公司名称
				var budget = document.getElementById("budget"); //项目预算
				var reference = document.getElementById("reference"); //参考网站
				var brief = document.getElementById("brief"); //项目简介
				var project = document.getElementById("project"); //项目名称

				yanZheng(phone, /^[\s\S]*.*[^\s][\s\S]*$/);

				yanZheng(Name, /^[\s\S]*.*[^\s][\s\S]*$/);

				yanZheng(note, /\d{6}/);

				yanZheng(budget, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(project, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(reference, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(company, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(project, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(project, /^[\s\S]*.*[^\s][\s\S]*$/);
				yanZheng(project, /^[\s\S]*.*[^\s][\s\S]*$/);

				$('#brief').focus(
					$('#brief').blur(function() {
						if(this.value == "") {
							this.nextSibling.innerHTML = "必填项";
							this.style.borderColor = "red";
							this.nextSibling.style.color = "red";
							this.nextSibling.style.marginLeft = "15px";
						} else {
							this.style.borderColor = "#f5f5f5";
							this.nextSibling.innerHTML = "正确";
							this.nextSibling.style.color = "white";
						}
					})
				);
				$(".btn-fabu").click(function() {
							/*手机号*/
							yanz(phone, /^[\s\S]*.*[^\s][\s\S]*$/);
							/*短信验证*/
							yanz(note, /\d{6}/);

							kk(budget);
							kk(project);
							kk(reference);
							kk(company);
							kk(brief);
							kk(Name);
							kk(project);
							if(project.value == "") {
								$(".overtop").text("项目名为空,请填写完整");
								overtop();
							} else {
								if(brief.value == "") {
									$(".overtop").text("项目简介为空,请填写完整");
									overtop();
								} else {
									if(reference.value == "") {
										$(".overtop").text("参考网站/项目为空,请填写完整");
										overtop();
									} else {
										if(budget.value == "") {
											$(".overtop").text("项目预算为空,请填写完整");
											overtop();
										} else {
											if($(".time .selected").text() == "") {
												$(".overtop").text("请选择项目外包周期");
												overtop();
											} else {
												if(company.value == "") {
													$(".overtop").text("公司名为空,请填写完整");
													overtop();
												} else {
													if(Name.value == "") {
														$(".overtop").text("姓名为空，请输入");
														overtop();
													} else {
														if(phone.value == "") {
															$(".overtop").text("请重新输入手机号");
															overtop();
														} else {
															if(note.value == "") {
																$(".overtop").text("请重新输入短信验证");
																overtop();
															} else {

															lei1s/*项目类型*/

															lei2s/*项目外包周期*/

															hys/*项目行业*/

															an1s;/*项目紧急程度*/

															var xname = project.value;/*项目名称*/

															var jbrief = brief.value;/*项目简介*/

															var ck = reference.value;/*参考网站/项目*/

															var ys = budget.value;/*项目预算*/

															var comp = company.value;/*公司名*/

															var gname = Name.value;/*姓名*/

															var p1 = phone.value;/*手机号*/

															var notes = note.value;/*短信验证*/

			                                            $.post(
			                                                "{:url('demand/publish')}",
			                                                {name:xname,money:ys,industry:hys,type:lei1s,period:lei2s,urgency:an1s,info:jbrief,reference:ck,company_name:comp,user_name:gname,mobile:p1},
			                                                function(data){
			  														if (data.code==1) {
																		$(".beijin").css("display", "block");
			  														}else{
																		$(".overtop").text("提交失败");
																		overtop();
			  														}
			                                                   }
			                                                )
															}
														}
													}

												}
											}
										}
									}
								}
							}
							});