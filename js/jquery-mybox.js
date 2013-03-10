// JavaScript Document
jQuery.extend(jQuery, { 
	// jQuery UI alert弹出提示 
	jqalert: function(text, title, fn) { 
		var html = 
			'<div class="dialog" id="dialog-message">' + 
			' <p>' + 
			//' <span class="ui-icon ui-icon-circle-check" style="float: left; margin: 0 7px 0 0;"></span>' + text + 
			' <span style="float: left; margin: 0 7px 0 0;"></span>' + text + 
			' </p>' + 
			'</div>'; 
			
		$(html).dialog({
			resizable: false,
			modal: true,
			show: {effect: 'fade',duration: 300},
			open: function ()
			{
				//$(this).load('../test.html');
			},
			title: title || "提示信息",
			buttons: {
				"确定": function(){
					var dlg = $(this).dialog("close"); 
					fn && fn.call(dlg); 
				}
			},
			close:function(event, ui){
				$(this).dialog("destroy");
				$("#dialog-message").remove();
			}
		});
	},
	// jQuery UI confirm弹出确认提示 
	jqconfirm: function(text, title, fn1, fn2) { 
		var html = 
		'<div class="dialog" id="dialog-confirm">' + 
		' <p>' + 
		//' <span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>' + text + 
		' <span style="float: left; margin: 0 7px 20px 0;"></span>' + text + 
		' </p>' + 
		'</div>'; 
		return $(html).dialog({ 
			//autoOpen: false, 
			resizable: false, 
			modal: true, 
			show: {effect: 'fade', duration: 300}, 
			title: title || "提示信息", 
			buttons: { 
				"确定": function() { 
					var dlg = $(this).dialog("close"); 
					fn1 && fn1.call(dlg, true); 
				}, 
				"取消": function() { 
					var dlg = $(this).dialog("close"); 
					fn2 && fn2(dlg, false); 
				} 
			},
			close:function(event, ui){
				$(this).dialog("destroy");
				$("#dialog-confirm").remove();
			}
		}); 
	}, 
	// jQuery UI 模态dialog框
	jqmybox:{
		show:function(myurl,mytitle,myheight,mywidth) { 
			var html = '<div class="dialog" id="dialog-mybox"></div>'; 
			$(html).dialog({
				resizable: false,
				height: myheight,
      	width: mywidth,
				modal: true,
				show: {effect: 'fade',duration: 300},
				open: function(){$(this).load(myurl);},
				title: mytitle,
				//buttons: dlgbtns,
				close:function(event, ui){
					$(this).dialog("destroy");
					$("#dialog-mybox").remove();
				}
			});
		},
		hide:function(){
			$("#dialog-mybox").dialog("close");
		}
	},
})