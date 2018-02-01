

function demandlist(){
	/*var demandStatusNum=0;*/
/*             需求列表数据    start                           */
	//resetDemandList()
	function resetDemandList(page){
		resetDemandList(page)
	}
	function resetDemandList(pageNum){
		var servicetag1 = $('.choice_kind').eq(0).find('span:eq(0)').attr('data');
	    var status = $('.choice_kind').eq(1).find('span:eq(0)').attr('data');
			$.ajax({
	        url : url + '/demand/demands.html',
	        type : "post",
	        data : {
	            'v' : '2.0',
	            'source' : 2,
	            'page' : pageNum,
	            'limit' : 9,
	            'status' : status,
	            'serviceTag1' : servicetag1
	        },
	        success : function (data) {
	            // var dataset = $.parseJSON(data);
	            var demandlist = data.data.list;
	            $('.demandlist ul').empty();
	            if(isEmpty(demandlist)){
	            	$(".demandlist ul").html("<p style='line-height:200px;text-align:center;font-size:14px;margin-bottom:50px;'>暂无此类型的需求</p>")
		            $("#page-box").css("display",'none')
		            return false;
		        }
	            var servicezifu=0;
	            var str=''
	            for(var i=0;i<demandlist.length;i++){
	            	/*if(!isEmpty(demandlist[i].serviceTag1) ){
	                	var strlength=demandlist[i].serviceTag1 +'-'+ demandlist[i].serviceTag2 +'' +demandlist[i].channel;
	    	            if(!isEmpty(strlength)){
	    	            	servicezifu=strlength.replace(/[^\x00-\xFF]/g,'**').length;
	    	            }
	                }*/
		            if(isEmpty(demandlist[i].channel)){
			            demandlist[i].channel = '保密';
		            }
		            /*if(demandlist[i].status==0){
		            	var img_bg="img_pos_f00"
		            }else if(demandlist[i].status==1){
		            	var img_bg="img_pos_000"
		            }else if(demandlist[i].status==2){
		            	var img_bg="img_pos_ccc"
		            }else if(demandlist[i].status==4){
		            	var img_bg="img_pos_green"
		            }
		            if(servicezifu<28){
		            	$('.demandlist ul').append('<li><a href="'+url+'/demand/info-2.0-'+ demandlist[i].id +'-2.shtml"><div class="content"><div class="img_pos '+img_bg+'">'+demand_status(demandlist[i].status)+'</div><h3>'+demandlist[i].title+'</h3><p class="end_time">发布时间：</p><div class="demandlist-date">'+ timeTransformation(demandlist[i].createTime) +'</div><div class="demandlist-d"><span>'+ (demandlist[i].serviceTag1 +'-'+ demandlist[i].serviceTag2) +'</span><span>'+ (demandlist[i].channel) +'</span></div><div class="demandlist-p">￥'+demandlist[i].budget+'</div><div class="demandlist-c"><span>已申请<i>'+ demandlist[i].applyCount +'</i>人</span><span>已浏览<i>'+demandlist[i].seeCount+'</i>人</span></div></div></a></li>');
					}else{
						$('.demandlist ul').append('<li><a href="'+url+'/demand/info-2.0-'+ demandlist[i].id +'-2.shtml"><div class="content"><div class="img_pos '+img_bg+'">'+demand_status(demandlist[i].status)+'</div><h3>'+demandlist[i].title+'</h3><p class="end_time">发布时间：</p><div class="demandlist-date">'+ timeTransformation(demandlist[i].createTime) +'</div><div class="demandlist-d"><span>'+ (demandlist[i].serviceTag1 +'-'+ demandlist[i].serviceTag2.slice(0,8)) +'</span><span>'+ (demandlist[i].channel.slice(0,6)) +'</span></div><div class="demandlist-p">￥'+demandlist[i].budget+'</div><div class="demandlist-c"><span>已申请<i>'+ demandlist[i].applyCount +'</i>人</span><span>已浏览<i>'+demandlist[i].seeCount+'</i>人</span></div></div></a></li>');
					}
		            servicezifu=0;*/

		            str+='<div class="demandBox" tid="'+demandlist[i].id+'" onclick="window.location.href=\''+url+'/demand/info-2.0-'+demandlist[i].id+'-2.shtml\'">'
					switch(demandlist[i].status){
						case 0:
							str+='<div class="marking" style="background-image:url('+url_resetimg+'/demand_status_f00.png)">招募中</div>';
							break;
						case 1:
							str+='<div class="marking"  style="background-image:url('+url_resetimg+'/demand_status_000.png)">执行中</div>'
							break;
						case 2:
							str+='<div class="marking"  style="color:#000;background-image:url('+url_resetimg+'/demand_status_ccc.png)">已完成</div>'
							break;
						case 4:
							str+='<div class="marking"  style="background-image:url('+url_resetimg+'/demand_status_yellow.png)">对接中</div>'
							break;
					}
					str+='<div class="demandTitle">'+demandlist[i].title+'</div>'
					str+='<div class="accomplishDate">'
					str+='<span>发布时间</span>'
					str+='<span>'+timeTransformation(demandlist[i].createTime)+'</span>'
					str+='</div>'
					str+='<div class="abbreviationBox">'
					if(demandlist[i].channel){
						str+='<span>'+demandlist[i].channel+'</span>';
					}
					if(demandlist[i]["serviceTag1"]){
						str+='<span>'+demandlist[i]["serviceTag1"]+'</span>'
					}
					str+='<em class="clear"></em></div>'
					str+='<div class="unitPriceBox">'+demandlist[i].budget+'</div>'
					str+='<div class="bottomColor">'
					str+='<div class="applyFor">已申请'+demandlist[i].applyCount+'人</div>'
					str+='<div class="lookOver">已浏览'+demandlist[i].seeCount+'人</div>'
					str+='</div></div>'
	            }
	            $('.demandlist ul').append(str);
	            var aLi = $('.demandlist ul .demandBox');
	            for(var i=0;i<aLi.length;i++){
	                if(i%3 == 2){
	                    aLi[i].style.marginRight = '0';
	                }
	            }

	            if(data.data.totalCount%9 >0){
	                $('input[type="hidden"]').val(parseInt(data.data.totalCount/9)+1);
	                $('#page-box .num').text(parseInt(data.data.totalCount/9)+1);
	            }else{
	                $('input[type="hidden"]').val(parseInt(data.data.totalCount/9));
	                $('#page-box .num').text(parseInt(data.data.totalCount/9));
	            }

	            $('#page-box .total').text(data.data.totalCount);

	            $('.page').pagination({
	                coping:true,
	                count:2,
	                homePage:'首页',
	                endPage:'末页',
	                prevContent:'上页',
	                nextContent:'下页',
	                current: pageNum,
	                callback:function(options){
	                    var page = options.getCurrent();
	                    $('.now').text(page);
	                    // 这里写ajax请求。传递到后端的参数里一定要有当前页的页码哟。
	                    //demandList(page);
	                    resetDemandList(page)
	                }
	            });
	        }
	    });
	}
	/*             需求列表数据    end                      */
	/*             需求列表事件   start              */
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
		alert('fdshjk');
		resetDemandList()
	})
	$(".more_choice").click(function(){
		$(this).parent().find(".freeman_none").css("display",'block')
		$(this).css("display",'none')
	})
	/*             需求列表事件   end               */
}
/*             需求详情的推荐列表数据   start              */
function demandinfo(){
	$.ajax({
			url:url+"/demand/demands.shtml",
			type:"post",
			data:{
				page:1,
				limit:4,
			},
			success:function(e){
				var recommedstr="";
				for(var i=0;i<e.data.list.length;i++){
					recommedstr+='<a class="recommend-a" href="'+url+'/demand/info-2.0-'+e.data.list[i].id+'-2.shtml"><div>NO.'+(i+1)+'</div><div><p>'+e.data.list[i].title+'</p><p style="color:red;">'+e.data.list[i].budget+'</p></div></a>'
				}
				$('.demand-recommend').prepend(recommedstr)
			}
	})
}

/*             需求详情的推荐列表数据   end               */
/*             申请干活   start              */
function applyDemand(id){
    $.ajax({
        url : url + '/demand/apply.shtml',
        type : "post",
        data : {
            'v' : '2.0',
            'source' : 2,
            'id' : id
        },
        success : function (data) {

            if(data.code == '0'){
                show_alert('申请成功！');
                /*setTimeout(function(){
                    window.location.href = window.location.href;
                },1000);*/
            }else{
            	if(data.message){
            		show_alert(data.message);
	    		};
                /*setTimeout(function(){
                    $('#show_alert_bg').hide();
                    $('#show_alert').hide();
                },2000);*/
			}

        }
    });
}
/*             申请干活   end               */
function show_alert(str){
    if(!document.getElementById('show_alert_bg')){
        // 不存在，则添加
        $('<div id="show_alert_bg" onclick="" style="padding-top:10%;z-index:10000000;"><div id="show_alert"><div>'+ str +'</div>我们会尽快与您取得联系，请保持手机畅通<div class="showAlertJudge" onclick="window.location.href=window.location.href">确定</div></div></div>').appendTo('body');
    }else{
        $('#show_alert_bg').show();
        $('#show_alert').show();
    }
}
function returnGo(){
    $('#show_alert_bg').hide();
    $('#show_alert').hide();
}
/*             需求详情的推荐列表数据   start              */

/*             需求详情的推荐列表数据   end               */