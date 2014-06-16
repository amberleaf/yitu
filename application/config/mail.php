<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Mail配置
| -------------------------------------------------------------------------
*/

$mail['useragent']		= 'admin';						//用户代理 "admin"
$mail['smtp_host']		= 'mail.dezhi.com';				//SMTP 服务器地址
$mail['smtp_user']		= 'monitor@dezhi.com';			//账户
$mail['smtp_pass']		= 'dezhi123';					//账户密码
$mail['protocol']		= 'smtp';						//协议
$mail['smtp_timeout']	= 60;							//超时（秒）
$mail['wordwrap']		= TRUE;							//是否自动换行
$mail['mailtype']		= 'html';						//邮件类型（text，html）
$mail['charset']		= 'utf-8';						//编码类型
$mail['validate']		= TRUE;							//是否验证邮件地址

$config['mail'] = $mail;
$config['mail-hash-key'] = '4b29a21e5aa032dd4f5a1590c29016f2';

/* End of file mail.php */
/* Location: ./application/config/mail.php */