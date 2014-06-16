jQuery(function($) {
	$(".chosen-select").chosen();

	$("#idnumber").blur(function() {
		checkIdnum();
	});

	$("#add-admin-form input").focus(function() {
		$(this).closest('.form-group').removeClass('has-warning');
		$(this).closest('.form-group').removeClass('has-error');
		$(this).closest('.form-group').removeClass('has-success');
		$(this).closest('.form-group').removeClass('has-info');
		$(this).next().children().html(null);
	});
});
/**
 * 显示提示信息
 * @param  {object} o    [description]
 * @param  {string} cstr [提示div的class(has-warning|has-error|has-success|has-info)]
 * @param  {string} msg  [提示信息]
 * @return {boolen}      [false]
 */
function showTips(o, cstr, msg) {
	o.closest('.form-group').addClass(cstr);
	if (msg != '' && msg != null) {
		o.next().children().html(msg);
	};
	return;
}
/**
 * 检查用户名
 * @return boolen [description]
 */
function checkUsername() {
	var u = $("#username");
	if ($.trim(u.val()) == '') {
		showTips(u, 'has-error', '请输入用户名！');
		return;
	};
	$.post('/admin/auth/check_admin_username', {name: u.val()}, function(d){
		if (d.info == 1) {
			showTips(u, 'has-error', '该用户名已经存在！');
			return;
		};
	}, 'json');
}
/**
 * 检查密码和重复密码
 * @return {boolen} [description]
 */
function checkPassword() {
	var u = $("#password");
	var ru = $("#repassword");
	if ($.trim(u.val()) == '') {
		showTips(u, 'has-error', '请输入密码！');
		return;
	};
	if ($.trim(ru.val()) == '') {
		showTips(ru, 'has-error', '请再次输入密码！');
		return;
	};
	if ($.trim(u.val()) != $.trim(ru.val())) {
		showTips(ru, 'has-error', '两次输入的密码不一致！');
		return;
	};
}
/**
 * 检查真实姓名
 * @return {boolen} [description]
 */
function checkRealname() {
	var o = $("#realname"),
		v = $.trim(o.val());
	if (v.length <= 0) {
		showTips(o, 'has-error', '请输入真实姓名！');
		return;
	};
	if (/^[\u4e00-\u9fa5]+$/.test(v)) {
		if (v.length > 5) {
			showTips(o, 'has-error', '中文名字不能超过5个子!');
			return;
		};
	} else {
		if (v.length > 50) {
			showTips(o, 'has-error', '英文名字不能超过50个字符!');
			return;
		};
	};
}
/**
 * 检查性别
 * @return {[type]} [description]
 */
function checkSex() {
	var o = $("#sex"),
		v = $.trim(o.val());
	if (v == '') {
		showTips(o, 'has-error', '请选择性别！');
		return;
	};
}
/**
 * 检查管理类型
 * @return {[type]} [description]
 */
function checkType() {
	var o = $("#type"),
		v = $.trim(o.val());
	if (v == '') {
		showTips(o, 'has-error', '请选择管理类型！');
		return;
	};
}
/**
 * 检查身份证号码
 * @return {[type]} [description]
 */
function checkIdnum() {
	var o = $("#idnumber"),
		v = $.trim(o.val());
	if (v == '') {
		showTips(o, 'has-error', '请输入身份证号码!');
		return;
	};
	if (v.length != 18) {
		showTips(o, 'has-error', '请正确输入18位身份证号码!');
		return;
	};
}