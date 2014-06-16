<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * ACL 相关配置文件如下:
 *  1: /application/config/acl.php
 *  2: /application/libraries/Acl.php
 *  3:/application/models/acl_model.php
 *  4:另外acl需要数据库支持,需要在autoload中设置:database和acl
 *  5:另外acl使用的是$active_record,所以需要在database中设置其为TRUE哦
 *  (tsh备注)
 */
//-----------------------acl权限配置表---------------
//后台权限::角色表
$config['acl_table_roles'] = 'yt_roles';

//后台权限::用户表
$config['acl_table_users'] = 'yt_admins';

//后台权限::用户表主要字段
$config['acl_users_fields'] = array('id' => 'id','role_id' => 'role_id');

//后台权限::权限表
$config['acl_table_permissions'] = 'yt_permissions';

//后台权限::权限表主要字段
$config['acl_permissions_fields'] = array('id' => 'id','key' => 'key');

//后台权限::角色权限分配表
$config['acl_table_role_permissions'] = 'yt_role_permissions';

//后台权限::角色权限表主要字段设置
$config['acl_role_permissions_fields'] = array('id' => 'id','role_id' => 'role_id','permission_id' => 'permission_id');

//后台权限::保存用户id的seesion的键
$config['acl_user_session_key'] = 'admin_id';

//后台权限::权限数组--即允许的功能列表,界面元素等保存在这个数组中.
//支持role与user两种授权方式.
$config['acl_restricted'] = array(

	'controller/method' => array(
		'allow_roles' => array(1),
		'allow_users' => array(1),
		'error_msg' => '你没有权限对此操作！'
	),

	'welcome/*' => array(
		'allow_roles' => array(1),
		'allow_users' => array(1),
		'error_msg' => '你没有权限对此操作！'
	)
);