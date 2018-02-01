/*手机验证 60s  公用*/
	var sends = {
	checked:1,
	send:function(){
			var numbers = /^1\d{10}$/;
			var val = $('#phone').val().replace(/\s+/g,""); //获取输入手机号码
			if($('.div-phone').find('span').length == 0 && $('.div-phone a').attr('class') == 'send1'){
				if(!numbers.test(val) || val.length ==0){
					$('.div-phone').append('<span class="error">手机格式错误</span>');
					return false;
				}
			}
			if(numbers.test(val)){
				var time = 60;
				$('.div-phone span').remove();
				function timeCountDown(){
					if(time==0){
						clearInterval(timer);
						$('.div-phone a').addClass('send1').removeClass('send0').html("发送验证码");
						sends.checked = 1;
						return true;
					}
					$('.div-phone a').html(time+"S");
					time--;
					return false;
					sends.checked = 0;
				}
				$('.div-phone a').addClass('send0').removeClass('send1');
				timeCountDown();
				var timer = setInterval(timeCountDown,1000);
			}
	}
}
/*正则验证  失去焦点*/
			function yanZheng(tag, reg) {
				tag.onblur = function() {					
					if(reg.test(this.value)) {
						this.style.borderColor = "#f5f5f5";
						this.nextSibling.innerHTML = "";
						this.nextSibling.style.color = "white";						
					} else {
						this.style.borderColor = "red";
						this.nextSibling.style.color = "red";
						this.nextSibling.style.marginLeft = "15px";
						if(this.value == "") {
							this.nextSibling.innerHTML = "必填项";
						} else {
							this.nextSibling.innerHTML = "输入有误";
						}						
					}
				};
			}
			/*非空验证*/
				
				function kk(ss){
					var ks =  /^[\s\S]*.*[^\s][\s\S]*$/
					if(ks.test(ss.value)) {
						ss.style.borderColor = "#f5f5f5";
						ss.nextSibling.innerHTML = "";
						ss.nextSibling.style.color = "white";											
					} else {
						ss.style.borderColor = "red";
						ss.nextSibling.style.color = "red";
						ss.nextSibling.style.marginLeft = "15px";						
						if(ss.value == "") {
							ss.nextSibling.innerHTML = "必填项"
						
						} else {
							ss.nextSibling.innerHTML = "输入有误"
						
						}
					}
				}
/*正则验证*/				
function yanz(tag, reg) {									
			if(reg.test(tag.value)) {
				tag.style.borderColor = "#f5f5f5";				
				tag.nextSibling.innerHTML = "";
				tag.nextSibling.style.color = "#ffffff";
				return 1;
			} else {
				tag.style.borderColor = "red";
				tag.nextSibling.style.color = "red";
				tag.nextSibling.style.marginLeft = "15px";
				if(tag.value == "") {
					tag.nextSibling.innerHTML = "必填项";
				} else {
					tag.nextSibling.innerHTML = "输入有误";
				}	
				return 2;
			}				
}

//添加文件   
			function attachFile() {
				document.getElementById("fileInput").click();
				//调用选择文件事件    
				var filepathname = document.getElementById("fileInput").value;
				if(filepathname == "") {
					return;
				}
				showFile(filepathname);
			}
			//展示文件  
			function showFile(filepathname) {
				var tab = document.getElementById("filetable");
				var len = tab.rows.length;
				if(len >= 5) {
					alert("最多添加5个文件！");
					return;
				}
				var newRow = tab.insertRow();
				var newCell0 = newRow.insertCell(0);
				newCell0.innerHTML = "<img src='img/jia.png' class='container-img'/> <input type='text' class='container-left' name='showFileName' value='" + filepathname + "' size='100'/>";
				var newCell1 = newRow.insertCell(1);
				newCell1.innerHTML = "<input type='button' class='container-right' onclick='deleteFile(this);' value='删除'/>";
				$(".container-img").css("width","25px");
				$(".container-img").css("margin-right","10px");
				$(".container-left").css("width","300px");
				$(".container-right").css("width","100px");
			}
			//删除文件   
			function deleteFile(obj) {
				var rowNum = obj.parentElement.parentElement.rowIndex;
				var tab = document.getElementById("filetable");
				tab.deleteRow(rowNum);
			}
/**/
$(document).bind("contextmenu copy selectstart", function(){
				return false;
			});
			/*禁用ctrl+c ctrl+v*/
			$(document).keydown(function(e){
				if(e.ctrlKey &&(e.keyCode ==65|| e.keyCode ==67)){
					return false;
				}
			})