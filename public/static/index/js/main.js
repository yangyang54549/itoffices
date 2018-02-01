/**
 * Created by sdyk on 16/11/24.
 */
//全局变量
//var url = window.location.protocol + '//' + window.location.host;
var url = "https://www.315pr.com";
//var url = 'http://testwww.315pr.com';
var admin_url = 'http://file.315pr.com';
//var url_img = "http://test1.315pr.com:38080/resources/bootstrap/img/";
//var url_img = "http://www.315pr.com/resources/bootstrap/img/";
var url_img = url + "/resources/bootstrap/img/";
var url_resetimg = url + "/resources/bootstrap/resetImg/";


/*     检索是否已超时         ('sessionTime')=='timeOut'   */
$(document).ajaxComplete(function(event,request, settings){
	if(request.responseText.indexOf('<input type="hidden" value="index"/>')>0){
		alert("登陆已过期")
		window.location.href=url+'/user/logout.shtml';
	}
	/*var data=request.responseText;
	  if(data.indexOf("http://file.315pr.com/upload/index_banner/banner1.png")>-1 && window.location.href!=url)//根据服务器端返回的数据判断
	  {
		  window.location.href=url;
	  }*/
});

/* ============= 是否为空 ============== */
function isEmpty(strVal){
	if(strVal == ''|| strVal == undefined || strVal == 'undefind'|| strVal == null || strVal == 'null' ){
		return true;
	}else{
		return false;
	}
}
function demand_status(num){
	switch(num){
	case 0:
		$(".demandlist .content .img_pos").addClass(".img_pos_f00")
		return "招募中";
		break;
	case 1:
		return "执行中";
		break;
	case 2:
		return "已完成";
		break;
	case 4:
		return "对接中";
		break;
	}
}

/*         上传插件       start             */
/*        obj 上传对象     callback 回调函数执行函数                        */
function attachFile(){
	var obj=arguments[0];
	if(arguments[1]){var callback=arguments[1];}
	var file_name = $(obj).val();
    var attachUrl = "";
    var option = {
        url : url+"/file/img.shtml",
        data : {
            'v' : '2.0',
            'source' : 2
        },
        type: "post",
        success : function(result){
            if(result.code == '0'){
            	attachUrl = result.data.url;
            	$(obj).parents("form").find('input[type="hidden"]').val(attachUrl)
            	$(obj).val("")
            	if(callback){callback(attachUrl,file_name)}
            }else{
            	if(result.message){
            		alert(result.message)
            	}
            }
        },
		error:function(a,b,c){
            $(obj).val("")
			alert("您上传文件大于10M，请重新上传!")
		}
    };
    if(arguments[2]){
    	for(var i=0;i<arguments[2].length;i++){
    		option[arguments[2][i].name]=arguments[2][i].val
    	}
    }
    $(obj).parents("form").ajaxSubmit(option);
}
/*         上传插件       end             */
/*         删除上传插件文件信息     start             */
/*         obj 文件名字dom对象    file_obj 上传form 对象        */
function deleteImg(obj,file_obj){
	$(obj).remove()
	$(file_obj).find("input[type='hidden']").val('')
}
/*         删除上传插件文件信息    end            */
/*          时间转换成  年月日          start                    */
function timeTransformation(timestr){
	 Date.prototype.format = function (format) { 
		    var o = { 
		    "M+": this.getMonth() + 1, 
		    "d+": this.getDate(), 
		    "H+": this.getHours(), 
		    "m+": this.getMinutes(), 
		    "s+": this.getSeconds(), 
		    "q+": Math.floor((this.getMonth() + 3) / 3), 
		    "S": this.getMilliseconds() 
		    } 
		    if (/(y+)/.test(format)) { 
		    format = format.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length)); 
		    } 
		    for (var k in o) { 
		        if (new RegExp("(" + k + ")").test(format)) { 
		            format = format.replace(RegExp.$1, RegExp.$1.length == 1 ? o[k] : ("00" + o[k]).substr(("" + o[k]).length)); 
		        } 
		    } 
		    return format; 
		}
		var temp = new Date(parseInt(timestr)); 
		var year = temp.getFullYear();
	    var month = temp.getMonth()+1;    //js从0开始取 
	    var date1 = temp.getDate(); 
	    var hour = temp.getHours(); 
	    var minutes = temp.getMinutes(); 
	    var second = temp.getSeconds();
	    var rTime=""+year+"-"+month+"-"+date1;
		return rTime;
}
/*          时间转换成  年月日          end                   */

