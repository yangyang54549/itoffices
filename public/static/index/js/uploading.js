
				//    使用canvas对大图片进行压缩
				function compress(img) {
					var initSize = img.src.length;
					var width = img.width;
					var height = img.height;
					//如果图片大于四百万像素，计算压缩比并将大小压至400万以下
					var ratio;
					if((ratio = width * height / 4000000) > 1) {
						ratio = Math.sqrt(ratio);
						width /= ratio;
						height /= ratio;
					} else {
						ratio = 1;
					}
					canvas.width = width;
					canvas.height = height;
					//        铺底色
					ctx.fillStyle = "#fff";
					ctx.fillRect(0, 0, canvas.width, canvas.height);
					//如果图片像素大于100万则使用瓦片绘制
					var count;
					if((count = width * height / 1000000) > 1) {
						count = ~~(Math.sqrt(count) + 1); //计算要分成多少块瓦片
						//            计算每块瓦片的宽和高
						var nw = ~~(width / count);
						var nh = ~~(height / count);
						tCanvas.width = nw;
						tCanvas.height = nh;
						for(var i = 0; i < count; i++) {
							for(var j = 0; j < count; j++) {
								tctx.drawImage(img, i * nw * ratio, j * nh * ratio, nw * ratio, nh * ratio, 0, 0, nw, nh);
								ctx.drawImage(tCanvas, i * nw, j * nh, nw, nh);
							}
						}
					} else {
						ctx.drawImage(img, 0, 0, width, height);
					}
					//进行最小压缩
					var ndata = canvas.toDataURL('image/jpeg', 0.1);
					console.log('压缩前：' + initSize);
					console.log('压缩后：' + ndata.length);
					console.log('压缩率：' + ~~(100 * (initSize - ndata.length) / initSize) + "%");
					tCanvas.width = tCanvas.height = canvas.width = canvas.height = 0;
					return ndata;
				}
				//    图片上传，将base64的图片转成二进制对象，塞进formdata上传
				function upload(basestr, type, $li) {
					var text = window.atob(basestr.split(",")[1]);
					var buffer = new Uint8Array(text.length);
					var pecent = 0,
						loop = null;
					for(var i = 0; i < text.length; i++) {
						buffer[i] = text.charCodeAt(i);
					}
					var blob = getBlob([buffer], type);
					var xhr = new XMLHttpRequest();
					var formdata = getFormData();
					formdata.append('imagefile', blob);
					xhr.open('post', '/cupload');
					xhr.onreadystatechange = function() {
						if(xhr.readyState == 4 && xhr.status == 200) {
							var jsonData = JSON.parse(xhr.responseText);
							var imagedata = jsonData[0] || {};
							var text = imagedata.path ? '上传成功' : '上传失败';
							console.log(text + '：' + imagedata.path);
							clearInterval(loop);
							//当收到该消息时上传完毕
							$li.find(".progress span").animate({
								'width': "100%"
							}, pecent < 95 ? 200 : 0, function() {
								$(this).html(text);
							});
							if(!imagedata.path) return;
							$(".pic-list").append('<a href="' + imagedata.path + '">' + imagedata.name + '（' + imagedata.size + '）<img src="' + imagedata.path + '" /></a>');
						}
					};
					//数据发送进度，前50%展示该进度
					xhr.upload.addEventListener('progress', function(e) {
						if(loop) return;
						pecent = ~~(100 * e.loaded / e.total) / 2;
						$li.find(".progress span").css('width', pecent + "%");
						if(pecent == 50) {
							mockProgress();
						}
					}, false);
					//数据后50%用模拟进度
					function mockProgress() {
						if(loop) return;
						loop = setInterval(function() {
							pecent++;
							$li.find(".progress span").css('width', pecent + "%");
							if(pecent == 99) {
								clearInterval(loop);
							}
						}, 100)
					}
					xhr.send(formdata);
				}
				/**
				 * 获取blob对象的兼容性写法
				 * @param buffer
				 * @param format
				 * @returns {*}
				 */
				function getBlob(buffer, format) {
					try {
						return new Blob(buffer, {
							type: format
						});
					} catch(e) {
						var bb = new(window.BlobBuilder || window.WebKitBlobBuilder || window.MSBlobBuilder);
						buffer.forEach(function(buf) {
							bb.append(buf);
						});
						return bb.getBlob(format);
					}
				}
				/**
				 * 获取formdata
				 */
				function getFormData() {
					var isNeedShim = ~navigator.userAgent.indexOf('Android') &&
						~navigator.vendor.indexOf('Google') &&
						!~navigator.userAgent.indexOf('Chrome') &&
						navigator.userAgent.match(/AppleWebKit\/(\d+)/).pop() <= 534;
					return isNeedShim ? new FormDataShim() : new FormData()
				}
				/**
				 * formdata 补丁, 给不支持formdata上传blob的android机打补丁
				 * @constructor
				 */
				function FormDataShim() {
					console.warn('using formdata shim');
					var o = this,
						parts = [],
						boundary = Array(21).join('-') + (+new Date() * (1e16 * Math.random())).toString(36),
						oldSend = XMLHttpRequest.prototype.send;
					this.append = function(name, value, filename) {
						parts.push('--' + boundary + '\r\nContent-Disposition: form-data; name="' + name + '"');
						if(value instanceof Blob) {
							parts.push('; filename="' + (filename || 'blob') + '"\r\nContent-Type: ' + value.type + '\r\n\r\n');
							parts.push(value);
						} else {
							parts.push('\r\n\r\n' + value);
						}
						parts.push('\r\n');
					};
					// Override XHR send()
					XMLHttpRequest.prototype.send = function(val) {
						var fr,
							data,
							oXHR = this;
						if(val === o) {
							// Append the final boundary string
							parts.push('--' + boundary + '--\r\n');
							// Create the blob
							data = getBlob(parts);
							// Set up and read the blob into an array to be sent
							fr = new FileReader();
							fr.onload = function() {
								oldSend.call(oXHR, fr.result);
							};
							fr.onerror = function(err) {
								throw err;
							};
							fr.readAsArrayBuffer(data);
							// Set the multipart content type and boudary
							this.setRequestHeader('Content-Type', 'multipart/form-data; boundary=' + boundary);
							XMLHttpRequest.prototype.send = oldSend;
						} else {
							oldSend.call(this, val);
						}
					};
				}


/*tijiao*/
function overtop(s) {
	$("body>p.overtop").text(s);
					$("#app>div:nth-child(1)").after($("body>p.overtop").clone(true));
					$("#app .overtop").css("background-color", "rgba(0,0,0,0.7)");
					$("#app .overtop").css("display", "block");
					setTimeout(function() {
						$("#app .overtop").css("opacity", "0");
						$("#app .overtop").remove();
					}, 1000);
				}
function bths(){

	/*获取select 选中的 text :
    $("#ddlregtype").find("option:selected").text();
获取select选中的 value:
    $("#ddlregtype ").val();*/
   
	if($("#project").val()!=""){
		if($("#budget").val()!=""){
			selects();
		}else{
			overtop("请输入项目金额");
		}
	}else{
		overtop("请输入项目名");
	}
}

function selects(){
	if($("#select select:nth-child(1)").val()!= 0){
			if($("#zy .selected").length>0){
				selected();
			}else{
				overtop("请选择案例功能");
			}
			}else{
				overtop("请选择案例类型");
			}
}
function selected(){
	if($("#xt .selected").length>0){
		imgs();
	}else{
		overtop("请选择案例系统类型");
	}
}
function imgs(){
	$(".img-list1 li").length
	if($(".img-list1 li").length!=1){
		overtop("请上传首页图");
	}else{
		if($(".img-list2 li").length!=1){
			if($("#budget-url").val()!=""){
				tuji();
			}else{
				overtop("预览二维码和预览url至少填一项");
			}
		}else{
			tuji();
		}
	}
}
function tuji(){
	if($(".img-list li").length>1&&$(".img-list li").length<5){
		if($("#brief").val()!=""){
			var str = ue.getContent();
			if(str!=""){
				vals();
			}else{
				overtop("请输入案例详情");
			}
		}else{
			overtop("请输入案例简介");
		}
	}else{
		overtop("图片集至少填2张，最多4张");
	}
}
function vals(){
	/*项目名*/
	var proje = $("#project").val();
	/*项目金额*/
	var budget = $("#budget").val();
	/*案例类型*/
	var sele1 = $("#select select").val();
	/*案例功能*/	
	var zy = new Array();
	for(var n=0;n<$("#zy .selected").length;n++){
		zy[n] = $("#zy .selected").eq(n).data("id");
	}
	/*案例系统类型 多选*/	
	var selected = new Array();
	for(var n=0;n<$("#xt .selected").length;n++){
		selected[n] = $("#xt .selected").eq(n).text();
	}
	/*案例展示类型*/
	var zs = $("#zs .selected").text();
	/*上传首页图*/
	var imgli1 = $(".img-list1 li:nth-child(1)").css("backgroundImage").replace('url(','').replace(')','');
	/*预览二维码*/
	if( $(".img-list2 li").length!=1){
		/*预览url*/
		var url = $("#budget-url").val();
	}else{
		var imgli2 = $(".img-list2 li:nth-child(1)").css("backgroundImage").replace('url(','').replace(')','');
		if($("#budget-url").val()!=""){
			var url = $("#budget-url").val();
		}
	}
	/*图片集*/

	var aCity0 = new Array();
	for(var i=0;i<$(".img-list li").length;i++){
		aCity0[i] = $(".img-list li").eq(i).css("backgroundImage").replace('url(','').replace(')','');
	}
	/*案例简介*/
	var brief = $("#brief").val();
	/*案例详情*/
	var str = ue.getContent();

				$.post("{:url('cases/add')}",{case_name:proje,money:budget,images:aCity0,brief:brief,img:imgli1,type:sele1,specific:sele2,system_type:selected,code:imgli2,preview:url,info:str,is_pp:zs},function(data) {

				})


}
