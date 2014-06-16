/*$.validator.setDefaults({
	debug: true,
	// submitHandler: function() { $("#add-admin-form").submit(); }
});*/
$(document).ready(function(){
	$(".chosen-select").chosen();

	$("#save").click(function() {
			$("#add-admin-form").submit();
		/*if ($("#add-admin-form").valid()) {
			$('#add-admin-form').removeAttr("onsubmit");
			alert(222);
		};*/
	});

	$("#add-admin-form").validate({
		rules: {
			username: {
				required: true,
				rangelength: [5, 50],
				remote: {
					url:'/admin/auth/check_admin_username',
					type: 'post',
					data: {
						name: function() { return $('#username').val(); }
					}
				}
			},
			password: {
				required: true,
				minlength: 6
			},
			repassword: {
				required: true,
				minlength: 6,
				equalTo: "#password"
			},
			realname: {
				required: true,
				rangelength: [3, 10]
			},
			sex: { required: true },
			type: { required: true },
			idnumber: {
				required: true,
				rangelength: [18, 18]
			},
			mobil: {
				required: true,
				number: true,
				maxlength: 11
			},
			uemail: {
				required: true,
				email: true
			},
			qq: { number: true },
			agencyid: { required: true },
			schoolarea: { required: true },
			emergency: {
				required: true,
				rangelength: [3, 10]
			},
			contactmobil: {
				required: true,
				number: true,
				maxlength: 11
			}
		},
		messages: {
			username: {
				required: "请输入用户名！",
				rangelength: "用户名长度不符（5-50）！",
				remote: "用户名已经存在！"
			},
			password: {
				required: "请输入密码！",
				minlength: "密码不能少于6个字符！"
			},
			repassword: {
				required: "请再次输入密码！",
				minlength: "密码不能少于6个字符!",
				equalTo: "您输入的密码不一致！"
			},
			realname: {
				required: "请输入真实姓名！",
				rangelength: "真实姓名长度不符（3-10）！"
			},
			sex: "请选择性别！",
			type: "请选择管理员类型！",
			idnumber: {
				required: "请输入身份证号！",
				rangelength: "身份证号长度不符！"
			},
			mobil: {
				required: "请输入手机号码！",
				number: "格式不正确！",
				maxlength: "手机号码长度不符！"
			},
			uemail: {
				required: "请输入邮箱！",
				email: "邮箱格式不正确！"
			},
			qq: "QQ格式不正确！",
			agencyid: "请选择机构！",
			schoolarea: "请选择校区！",
			emergency: {
				required: "请输入紧急联系人！",
				rangelength: "紧急联系人长度不符（3-10）！"
			},
			contactmobil: {
				required: "请输入紧急联系人电话！",
				number: "紧急联系电话不正确！",
				maxlength: "紧急联系电话长度不正确！"
			}
		},
		highlight: function(element, errorClass) {
			$(element).closest('.form-group').addClass('has-error');
		},
		unhighlight: function(element, errorClass) {
			$(element).closest('.form-group').removeClass('has-error');
		},
		errorElement: "span",
		errorClass: "middle",
		errorPlacement: function(error, element) {
			error.appendTo( element.next('span') );
		},
		focusCleanup: true,
		submitHandler: function (form) {
			form.submit();
		}
	});
});
