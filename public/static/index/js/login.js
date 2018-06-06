
	function quehuan1(){
				$(".login .login1").css("display","none");
				$(".login .login2").css("display","block");
			}

			function quehuan2(){
				$(".login .login2").css("display","none");
				$(".login .login1").css("display","block");
			}
			function none(){
  						$(".beijin").css("display", "none");
						$(".good").css("display", "none");
  					}
  					function block(s){
  						$(".beijin").css("display", "block");
						$(".good").css("display", "block");
						$(".good .texts").text(s);
  					}
function loginNone(){
				$(".login_background").css("display","none");
				$(".login").css("display","none");
			}
			function login1s() {
                if($("#phones").val() == "") {
                    block("请输入手机号码");
                }  else {
                	if(!(/^1[3456789]\d{9}$/.test($("#phones").val()))) {
						block("手机号码有误，请重填");
					} else {
						if($("#j_captcha").val()!=""){

							var mobile = $("#phones").val();
							var code = $("#j_captcha").val();
							$.post("{:url('login/checkindex')}",{mobile:mobile,code:code},function(data) {
								if (data.code==1) {
									block("登录成功");
									window.location.href='{:url("user/index")}';
								}else{
									block(data.msg);
								}
							})
						}else{
							block("请输入短信验证码");
						}
					}
				}
			}
			  