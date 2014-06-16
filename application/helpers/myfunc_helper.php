<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//输出安全的html，完全去掉 js、会执行html效果，如：<b>文字</b> 会被加粗显示
function h($text, $tags = null){
	$text	=	trim($text);
	$text	=	preg_replace('/<!--?.*-->/','',$text);
	//完全过滤注释
	$text	=	preg_replace('/<!--?.*-->/','',$text);
	//完全过滤动态代码
	$text	=	preg_replace('/<\?|\?'.'>/','',$text);
	//完全过滤js
	$text	=	preg_replace('/<script?.*\/script>/','',$text);

	$text	=	str_replace('[','&#091;',$text);
	$text	=	str_replace(']','&#093;',$text);
	$text	=	str_replace('|','&#124;',$text);
	//过滤换行符
	$text	=	preg_replace('/\r?\n/','',$text);
	//br
	$text	=	preg_replace('/<br(\s\/)?'.'>/i','[br]',$text);
	$text	=	preg_replace('/(\[br\]\s*){10,}/i','[br]',$text);
	//过滤危险的属性，如：过滤on事件lang js
	while(preg_match('/(<[^><]+) (lang|on|action|background|codebase|dynsrc|lowsrc)[^><]+/i',$text,$mat)){
		$text=str_replace($mat[0],$mat[1],$text);
	}
	while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
		$text=str_replace($mat[0],$mat[1].$mat[3],$text);
	}
	if(empty($tags)) {
		$tags = 'table|tbody|td|th|tr|i|b|u|strong|img|p|br|div|span|em|ul|ol|li|dl|dd|dt|a|alt|h[1-9]?';
		$tags.= '|object|param|embed';	// 音乐和视频
	}
	//允许的HTML标签
	$text	=	preg_replace('/<(\/?(?:'.$tags.'))( [^><\[\]]*)?>/i','[\1\2]',$text);
	//过滤多余html
	$text	=	preg_replace('/<\/?(html|head|meta|link|base|basefont|body|bgsound|title|style|script|form|iframe|frame|frameset|applet|id|ilayer|layer|name|style|xml)[^><]*>/i','',$text);
	//过滤合法的html标签
	while(preg_match('/<([a-z]+)[^><\[\]]*>[^><]*<\/\1>/i',$text,$mat)){
		$text=str_replace($mat[0],str_replace('>',']',str_replace('<','[',$mat[0])),$text);
	}
	//转换引号
	while(preg_match('/(\[[^\[\]]*=\s*)(\"|\')([^\2\[\]]+)\2([^\[\]]*\])/i',$text,$mat)){
		$text = str_replace($mat[0], $mat[1] . '|' . $mat[3] . '|' . $mat[4],$text);
	}
	//过滤错误的单个引号
	// 修改:2011.05.26 kissy编辑器中表情等会包含空引号, 简单的过滤会导致错误
//	while(preg_match('/\[[^\[\]]*(\"|\')[^\[\]]*\]/i',$text,$mat)){
//		$text=str_replace($mat[0],str_replace($mat[1],'',$mat[0]),$text);
//	}
	//转换其它所有不合法的 < >
	$text	=	str_replace('<','&lt;',$text);
	$text	=	str_replace('>','&gt;',$text);
    $text   =   str_replace('"','&quot;',$text);
    //$text   =   str_replace('\'','&#039;',$text);
	 //反转换
	$text	=	str_replace('[','<',$text);
	$text	=	str_replace(']','>',$text);
	$text	=	str_replace('|','"',$text);
	//过滤多余空格
	$text	=	str_replace('  ',' ',$text);
	return $text;
}

//输出纯文本，过滤掉html标签、js标签 如：<b>文字</b> <script>alert('123');</script> 过滤后显示为： 文字alert('123');
function text($text,$parseBr=false){
    $text = htmlspecialchars_decode($text);
    $text	=	safe($text,'text');
    if(!$parseBr){
        $text	=	str_ireplace(array("\r","\n","\t","&nbsp;"),'',$text);
        $text	=	htmlspecialchars($text,ENT_QUOTES);
    }else{
        $text	=	htmlspecialchars($text,ENT_QUOTES);
        $text	=	nl2br($text);
    }
    $text	=	trim($text);
    return $text;
}

// for text()
function safe($text,$type='html',$tagsMethod=true,$attrMethod=true,$xssAuto = 1,$tags=array(),$attr=array(),$tagsBlack=array(),$attrBlack=array()){

    //无标签格式
    $text_tags	=	'';

    //只存在字体样式
    $font_tags	=	'<i><b><u><s><em><strong><font><big><small><sup><sub><bdo><h1><h2><h3><h4><h5><h6>';

    //标题摘要基本格式
    $base_tags	=	$font_tags.'<p><br><hr><a><img><map><area><pre><code><q><blockquote><acronym><cite><ins><del><center><strike>';

    //兼容Form格式
    $form_tags	=	$base_tags.'<form><input><textarea><button><select><optgroup><option><label><fieldset><legend>';

    //内容等允许HTML的格式
    $html_tags	=	$base_tags.'<ul><ol><li><dl><dd><dt><table><caption><td><th><tr><thead><tbody><tfoot><col><colgroup><div><span><object><embed>';

    //专题等全HTML格式
    $all_tags	=	$form_tags.$html_tags.'<!DOCTYPE><html><head><title><body><base><basefont><script><noscript><applet><object><param><style><frame><frameset><noframes><iframe>';

    //过滤标签
    $text	=	strip_tags($text, ${$type.'_tags'} );

        //过滤攻击代码
        if($type!='all'){
            //过滤危险的属性，如：过滤on事件lang js
            while(preg_match('/(<[^><]+) (onclick|onload|unload|onmouseover|onmouseup|onmouseout|onmousedown|onkeydown|onkeypress|onkeyup|onblur|onchange|onfocus|action|background|codebase|dynsrc|lowsrc)([^><]*)/i',$text,$mat)){
                $text	=	str_ireplace($mat[0],$mat[1].$mat[3],$text);
            }
            while(preg_match('/(<[^><]+)(window\.|javascript:|js:|about:|file:|document\.|vbs:|cookie)([^><]*)/i',$text,$mat)){
                $text	=	str_ireplace($mat[0],$mat[1].$mat[3],$text);
            }
        }
        return $text;
}



/**
 * 转换为安全的纯文本
 *
 +++++++++++++++++++++++++++++++++++++++++++++
 * 建议用此函数过滤表单值
 +++++++++++++++++++++++++++++++++++++++++++++
 * @param string  $text
 * @param boolean $parse_br    是否转换换行符
 * @param int     $quote_style ENT_NOQUOTES:(默认)不过滤单引号和双引号 ENT_QUOTES:过滤单引号和双引号 ENT_COMPAT:过滤双引号,而不过滤单引号
 * @return string|null string:被转换的字符串 null:参数错误
 */
function t($text, $parse_br = false, $quote_style = ENT_NOQUOTES)
{
	if (is_numeric($text))
		$text = (string)$text;

	if (!is_string($text))
		return null;

	if (!$parse_br) {
		$text = str_replace(array("\r","\n","\t"), ' ', $text);
	} else {
		$text = nl2br($text);
	}

	//$text = stripslashes($text);
	$text = htmlspecialchars($text, $quote_style, 'UTF-8');

	return $text;
}


if(!function_exists('sub_str')) {
        /**
         * 截取UTF-8编码下字符串的函数
         *
         * @param   string      $str        被截取的字符串
         * @param   int         $length     截取的长度
         * @param   bool        $append     是否附加省略号
         *
         * @return  string
         */
        function sub_str($str, $length = 0, $append = true)
        {
            $str = trim($str);
            $strlength = strlen($str);
       
            if ($length == 0 || $length >= $strlength)
            {
                return $str;
            }
            elseif ($length < 0)
            {
                $length = $strlength + $length;
                if ($length < 0)
                {
                    $length = $strlength;
                }
            }
       
            if (function_exists('mb_substr'))
            {
                $newstr = mb_substr($str, 0, $length, 'utf-8');
            }
            elseif (function_exists('iconv_substr'))
            {
                $newstr = iconv_substr($str, 0, $length, 'utf-8');
            }
            else
            {
                $newstr = substr($str, 0, $length);
            }
       
            if ($append && $str != $newstr)
            {
                $newstr .= '...';
            }
       
            return $newstr;
        }
}


function show_message($message,$actionurl=array(),$target='_self'){
	$CI =& get_instance();
	$CI->load->vars('message',$message);
	$CI->load->vars('actionurl',$actionurl);
	$CI->load->vars('target',$target);
	$message = $CI->load->view('message.php','',true);
	echo $message;exit;
}

function top_redirect($url){
	header("Content-Type: text/html; charset=utf-8");
	$str = '<script type="text/javascript">';
	$str .= 'top.location.href="'.$url.'"';
	$str .= '</script>';
	echo $str;exit;
}

function show_jsonmsg($data){
	if(is_array($data)){
		$return = $data;	
	}else{
		$return = array('status'=>$data);
	}
	echo json_encode($return);exit;
}

function md5pass($pass,$salt){
	return md5(substr(md5($pass),0,10).$salt);
}

function get_image_url($url){
	if(substr($url,0,4)=='http'){
		return $url;	
	}else{
		return base_url($url);
	}
}

function get_full_url($url){
	if(substr($url,0,4)=='http'){
		return $url;
	}else{
		return site_url($url);
	}
}

function show_page($pagearr,$search=array()){
	$pagearr['pagenum']=isset($pagearr['pagenum'])&&$pagearr['pagenum']?$pagearr['pagenum']:20;
	$pagearr['currentpage']=$pagearr['currentpage']?$pagearr['currentpage']:1;
	$pagearr['numlinks']=isset($pagearr['numlinks'])&&$pagearr['numlinks']>0?$pagearr['numlinks']:5;

	$page_url = rtrim(base_url(), '/') . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')+1);
	unset($search['page']);
	foreach ($search as $pk => $pv) {
		$page_url .= $pk . '=' . $pv . '&';
	}
	$page_url .= 'page=';
	$pagestr = '';
	$totalpage = ceil($pagearr['totalnum']/$pagearr['pagenum']);
	if($totalpage<2){
		return $pagestr;
	}
	if($pagearr['currentpage']>$pagearr['numlinks']){
		$pagestr .= '<a href="{$page_url}1">首页</a>';
	}
	if($pagearr['currentpage']>1){
		$pagestr .= '<a href="'.$page_url.($pagearr['currentpage']-1).'">上一页</a>';
	}
	$prestart = $pagearr['currentpage']-$pagearr['numlinks'];
	$start = $prestart>1?$prestart:1;
	$end = $pagearr['currentpage']+$pagearr['numlinks'];
	$end = $end>$totalpage?$totalpage:$end;
	for($i=$start;$i<$pagearr['currentpage'];$i++){
		$pagestr .= '<a href="'.$page_url.$i.'">'.$i.'</a>';
	}
	$pagestr .= '<strong>'.$i.'</strong>';
	for($i=$pagearr['currentpage'];$i<$end;$i++){
		$pagestr .= '<a href="'.$page_url.($i+1).'">'.($i+1).'</a>';
	}
	if($pagearr['currentpage']<$totalpage){
		$pagestr .= '<a href="'.$page_url.($pagearr['currentpage']+1).'">下一页</a>';
	}
	if($end<$totalpage){
		$pagestr .= '<a href="'.$page_url.$totalpage.'">末页</a>';
	}
	echo $pagestr;exit;
	return $pagestr;
}

function replacekeyword($keywods,$urls,$content){
	$content = preg_replace("#(<a(.*))(>)(.*)(<)(\/a>)#isU", '\\1-]-\\4-[-\\6', $content);
	$content = @preg_replace("#(^|>)([^<]+)(?=<|$)#sUe", "highlight('\\2', \$keywods, \$urls, '\\1')", $content);
	$content = preg_replace("#(<a(.*))-\]-(.*)-\[-(\/a>)#isU", '\\1>\\3<\\4', $content);
	return $content;
}

function highlight($string, $words, $result, $pre){
	global $replaced;
	$string = str_replace('\"', '"', $string);
		foreach ($words as $key => $word){
			if($replaced[$word] == 1){
				continue;
			}
			$string = preg_replace("#".preg_quote($word)."#", $result[$key], $string,1);
			if(strpos($string, $word) !== FALSE){
				$replaced[$word] = 1;
			}
		}
	return $pre.$string;
}
/*
 * $type:1、文件夹 2、文件
 * $path:1、路径
 */
function dirfile_check($dirfile_items) {
	foreach($dirfile_items as $key => $item) {
		$item_path = $item['path'];
		if($item['type'] == 'dir') {
			if(!dir_writeable(FCPATH.$item_path)) {
				if(is_dir(FCPATH.$item_path)) {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nodir';
				}
			}else {
				$dirfile_items[$key]['status'] = 1;
				$dirfile_items[$key]['current'] = '+r+w';
			}
		} else {
			if(file_exists(FCPATH.$item_path)) {
				if(is_writable(FCPATH.$item_path)) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = 0;
					$dirfile_items[$key]['current'] = '+r';
				}
			} else {
				if(dir_writeable(dirname(FCPATH.$item_path))) {
					$dirfile_items[$key]['status'] = 1;
					$dirfile_items[$key]['current'] = '+r+w';
				} else {
					$dirfile_items[$key]['status'] = -1;
					$dirfile_items[$key]['current'] = 'nofile';
				}
			}
		}
	}
	return $dirfile_items;
}

function dir_writeable($dir) {
	$writeable = 0;
	if(!is_dir($dir)) {
		@mkdir($dir, 0777);
	}
	if(is_dir($dir)) {
		if($fp = @fopen("$dir/test.txt", 'w')) {
			@fclose($fp);
			@unlink("$dir/test.txt");
			$writeable = 1;
		} else {
			$writeable = 0;
		}
	}
	return $writeable;
}

function get_suffix($str){
	$arr = explode('.',$str);
	$num = count($arr);
	if($num>0){
		$res = $arr[$num-1];
		return $res;
	}else{
		return false;
	}
}

function splitsql($sql) {
	$sql = str_replace("\r", "\n", $sql);
	$ret = array();
	$num = 0;
	$queriesarray = explode(";\n", trim($sql));
	unset($sql);
	foreach($queriesarray as $query) {
		$queries = explode("\n", trim($query));
		$ret[$num] = '';
		foreach($queries as $query) {
			$ret[$num] .= $query[0] == "#" ? NULL : $query;
		}
		$num++;
	}
	return($ret);
}

function mult_to_single($arr,$key='id'){
	$newarr = array();
	foreach($arr as $item){
		$newarr[$item[$key]] = $item;
	}
	return $newarr;
}

function mult_to_idarr($arr,$key='id'){
	$newarr = array();
	foreach($arr as $item){
		$newarr[] = $item[$key];
	}
	return $newarr;
}

function cmp_func($a, $b) {
	global $order;
	if ($a['is_dir'] && !$b['is_dir']) {
		return -1;
	} else if (!$a['is_dir'] && $b['is_dir']) {
		return 1;
	} else {
		if ($order == 'size') {
			if ($a['filesize'] > $b['filesize']) {
				return 1;
			} else if ($a['filesize'] < $b['filesize']) {
				return -1;
			} else {
				return 0;
			}
		} else if ($order == 'type') {
			return strcmp($a['filetype'], $b['filetype']);
		} else {
			return strcmp($a['filename'], $b['filename']);
		}
	}
}
	/*
	 * utf8按宽度截取
	 */
	function cn_sub_str($str, $width = 0, $end = '...', $x3 = 0) {
		global $CNG; // 全局变量保存 x3 的值
		if ($width <= 0 || $width >= strlen($str)) {
			return $str;
		}
		$arr = str_split($str);
		$len = count($arr);
		$w = 0;
		$width *= 10;
		// 不同字节编码字符宽度系数
		$x1 = 11;	// ASCII
		$x2 = 16;
		$x3 = $x3===0 ? ( $CNG['cf3']  > 0 ? $CNG['cf3']*10 : $x3 = 21 ) : $x3*10;
		$x4 = $x3;
		$e = '';
		for ($i = 0; $i < $len; $i++) {
			if ($w >= $width) {
				$e = $end;
				break;
			}
			$c = ord($arr[$i]);
			if ($c <= 127) {
				$w += $x1;
			}
			elseif ($c >= 192 && $c <= 223) {	// 2字节头
				$w += $x2;
				$i += 1;
			}
			elseif ($c >= 224 && $c <= 239) {	// 3字节头
				$w += $x3;
				$i += 2;
			}
			elseif ($c >= 240 && $c <= 247) {	// 4字节头
				$w += $x4;
				$i += 3;
			}
		}
		return implode('', array_slice($arr, 0, $i) ). $e;
	}
?>
