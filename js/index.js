$(function() {
	$("#selleft").change(
		function()
		{
			//$.jqalert($(this).find("option:selected").text());
			window.location.href="./index.php?leftglid="+$(this).val();
		}
	);
	
	$("#selright").change(
		function()
		{
			window.location.href="./index.php?rightglid="+$(this).val();
		}
	);
});

function register()
{
	var url="../register_ui.php";
	var title="注册用户";
	$.jqmybox.show(url,title,210,240);
}

function usr_add_submit()
{
	var usr_form=$('#usr_add_form');		
	var usr_name=usr_form.find('[name=name]').val();
	if (usr_name.length <= 0)
	{
		$.jqalert("请输入用户名称！"); 
		return;
	}
	
	var usr_pwd_new=usr_form.find('[name=pwd_new]').val();
	if (usr_pwd_new.length <= 0)
	{
		$.jqalert("请输入用户密码！");
		return;
	}
	
	var usr_pwd_rp=usr_form.find('[name=pwd_rp]').val();
	if (usr_pwd_rp.length <= 0)
	{
		$.jqalert("请重复用户密码！");
		return;
	}
	
	if(usr_pwd_new != usr_pwd_rp)
	{
		$.jqalert("输入密码不一致！");
		return;
	}
	
	var usr_email=usr_form.find('[name=email]').val();
	if (usr_email.length <= 0)
	{
		$.jqalert("请输入用户Email！");
		return;
	}
	
	var send_data = "";
	send_data += "name=";
	send_data += usr_name;
	send_data += "&pwd=";
	send_data += usr_pwd_new;
	send_data += "&email=";
	send_data += usr_email;
	
	$.ajax({
		type:"POST",
		url:"./register_resp.php",
		data:send_data,
		dataType:"json",
		success:function(retmsg){
			if (retmsg.resflag == "success") {
				$.jqmybox.hide();
				
				var login_data = "";
				login_data += "name=";
				login_data += usr_name;
				login_data += "&pwd=";
				login_data += usr_pwd_new;
				usr_login_resp(login_data);
			}
			else {
				//提示出错
				$.jqalert(retmsg.fault);
			}
		},
	});
}

function usr_login()
{
	var url="../login_ui.php";
	var title="用户登陆";
	$.jqmybox.show(url,title,210,240);
}

function usr_login_submit()
{
	var usr_form=$('#usr_login_form');		
	var usr_name=usr_form.find('[name=name]').val();
	if (usr_name.length <= 0)
	{
		$.jqalert("请输入用户名称！"); 
		return;
	}
		
	var usr_pwd=usr_form.find('[name=pwd]').val();
	if (usr_pwd.length <= 0)
	{
		$.jqalert("请输入用户密码！"); 
		return;
	}
	
	var login_data = "";
	login_data += "name=";
	login_data += usr_name;
	login_data += "&pwd=";
	login_data += usr_pwd;
	usr_login_resp(login_data);
}

function usr_login_resp(send_data)
{
	$.ajax({
		type:"POST",
		url:"./login_resp.php",
		data:send_data,
		dataType:"json",
		success:function(retmsg){
			if (retmsg.resflag == "success") {
				$.jqmybox.hide();
				window.location.href="./index.php";
			}
			else {
				//提示出错
				$.jqalert(retmsg.fault);
			}
		},
	});
}

function usr_logout()
{
	$.ajax({
		type:"GET",
		url:"./logout_resp.php",
		data:"",
		dataType:"json",
		success:function(retmsg){
			if (retmsg.resflag == "success") {
				$.jqmybox.hide();
				window.location.href="./index.php?"+retmsg.outstr;
			}
			else {
				//提示出错
				$.jqalert("退出时出错");
			}
		},
	});
}

function add_love(girlid)
{
	var send_data = "";
	send_data += "girlid=";
	send_data += girlid;
	
	$.ajax({
		type:"POST",
		url:"./add_love_resp.php",
		data:send_data,
		dataType:"json",
		success:function(retmsg){
			if (retmsg.resflag == "success") {
				$.jqmybox.hide();
				window.location.href="./index.php";
			}
			else {
				//提示出错
				$.jqalert(retmsg.fault);
			}
		},
	});
}
