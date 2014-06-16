<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| Redis配置,如果需要redis缓存,则需要此文件.
| -------------------------------------------------------------------------
*/

$config['socket_type']	= 'tcp';
$config['host']			= '127.0.0.1';			//Redis服务器地址
$config['port']			= 6379;					//端口
$config['password']		= NULL;
$config['timeout']		= 0;					//缓存时间 0表示永久
$config['prefix']		= NULL;

/* End of file redis.php */
/* Location: ./application/config/redis.php */