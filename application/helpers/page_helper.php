<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * 后台分页页码
 * @param  array $pagearr 包含了总数total,当前页码cur,每页显示条数offset,显示页码个数links
 * @param  array  $search  检索条件
 * @return string          页码字符串
 */
function show_back_page($pagearr,$search=array()){
	$pagearr['offset']=isset($pagearr['offset'])&&$pagearr['offset']?$pagearr['offset']:20;
	$pagearr['cur']=$pagearr['cur']?$pagearr['cur']:1;
	$pagearr['links']=isset($pagearr['links'])&&$pagearr['links']>0?$pagearr['links']:5;

	if (strpos($_SERVER['REQUEST_URI'], '?')) {
		$page_url = rtrim(base_url(), '/') . substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '?')+1);
	} else {
		$page_url = rtrim(base_url(), '/') . $_SERVER['REQUEST_URI'] . '?';
	}
	unset($search['page']);
	if (count($search) > 0) {
		foreach ($search as $pk => $pv) {
			$page_url .= $pk . '=' . $pv . '&';
		}
	}
	$page_url .= 'page=';
	$pagestr = '<ul class="pagination">';
	$totalpage = ceil($pagearr['total']/$pagearr['offset']);
	if($totalpage<2){
		return $pagestr;
	}
	if($pagearr['cur']>$pagearr['links']){
		$pagestr .= '<li><a href="'.$page_url.'1"><i class="icon-angle-left"></i></a></li>';
	}
	if($pagearr['cur']>1){
		$pagestr .= '<li class="prev"><a href="'.$page_url.($pagearr['cur']-1).'"><i class="icon-double-angle-left"></i></a></li>';
	}
	$prestart = $pagearr['cur'] - $pagearr['links'];
	$start = $prestart > 1 ? $prestart : 1;
	$end = $pagearr['cur'] + $pagearr['links'];
	$end = $end > $totalpage ? $totalpage : $end;
	for($i=$start; $i<$pagearr['cur']; $i++){
		$pagestr .= '<li><a href="'.$page_url.$i.'">'.$i.'</a></li>';
	}
	$pagestr .= '<li class="active"><a href="javascript:void(0)">'.$i.'</a></li>';
	for($i=$pagearr['cur'];$i<$end;$i++){
		$pagestr .= '<li><a href="'.$page_url.($i+1).'">'.($i+1).'</a></li>';
	}
	if($pagearr['cur']<$totalpage){
		$pagestr .= '<li class="next"><a href="'.$page_url.($pagearr['cur']+1).'"><i class="icon-double-angle-right"></i></a></li>';
	}
	if($end<$totalpage){
		$pagestr .= '<li><a href="'.$page_url.$totalpage.'"><i class="icon-angle-right"></i></a></li>';
	}
	$pagestr .= "</ul>";
	return $pagestr;
}