<?php

/**
 * 处理代码表数据、记录配置信息
 *
 */
class Code {

    protected $_ci;
 
    private $_province =array(
        1=>array('province'=>'北京市','capital'=>'北京','areacode'=>'010','type'=>1),
		2=>array('province'=>'天津市','capital'=>'天津','areacode'=>'022','type'=>1),
		3=>array('province'=>'上海市','capital'=>'上海','areacode'=>'021','type'=>1),
		4=>array('province'=>'重庆市','capital'=>'重庆','areacode'=>'023','type'=>1),
		5=>array('province'=>'河北省','capital'=>'石家庄','areacode'=>'311','type'=>1),
		6=>array('province'=>'河南省','capital'=>'郑州','areacode'=>'371','type'=>1),
		7=>array('province'=>'湖北省','capital'=>'武汉','areacode'=>'027','type'=>1),
		8=>array('province'=>'湖南省','capital'=>'长沙','areacode'=>'731','type'=>1),
		9=>array('province'=>'江苏省','capital'=>'南京','areacode'=>'025','type'=>1),
		10=>array('province'=>'江西省','capital'=>'南昌','areacode'=>'791','type'=>1),
		11=>array('province'=>'辽宁省','capital'=>'沈阳','areacode'=>'024','type'=>1),
		12=>array('province'=>'吉林省','capital'=>'长春','areacode'=>'431','type'=>1),
		13=>array('province'=>'黑龙江省','capital'=>'哈尔滨','areacode'=>'451','type'=>1),
		14=>array('province'=>'陕西省','capital'=>'西安','areacode'=>'029','type'=>1),
		15=>array('province'=>'山西省','capital'=>'太原','areacode'=>'351','type'=>1),
		16=>array('province'=>'山东省','capital'=>'济南','areacode'=>'531','type'=>1),
		17=>array('province'=>'四川省','capital'=>'成都','areacode'=>'028','type'=>1),
		18=>array('province'=>'青海省','capital'=>'西宁','areacode'=>'971','type'=>1),
		19=>array('province'=>'安徽省','capital'=>'合肥','areacode'=>'551','type'=>1),
		20=>array('province'=>'海南省','capital'=>'海口','areacode'=>'898','type'=>1),
		21=>array('province'=>'广东省','capital'=>'广州','areacode'=>'020','type'=>1),
		22=>array('province'=>'贵州省','capital'=>'贵阳','areacode'=>'851','type'=>1),
		23=>array('province'=>'浙江省','capital'=>'杭州','areacode'=>'571','type'=>1),
		24=>array('province'=>'福建省','capital'=>'福州','areacode'=>'591','type'=>1),
		25=>array('province'=>'甘肃省','capital'=>'兰州','areacode'=>'931','type'=>1),
		26=>array('province'=>'云南省','capital'=>'昆明','areacode'=>'871','type'=>1),
		27=>array('province'=>'西藏自治区','capital'=>'拉萨','areacode'=>'891','type'=>1),
		28=>array('province'=>'宁夏回族自治区','capital'=>'银川','areacode'=>'951','type'=>1),
		29=>array('province'=>'广西壮族自治区','capital'=>'南宁','areacode'=>'771','type'=>1),
		30=>array('province'=>'新疆维吾尔自治区','capital'=>'乌鲁木齐','areacode'=>'991','type'=>1),
		31=>array('province'=>'内蒙古自治区','capital'=>'呼和浩特','areacode'=>'471','type'=>1),
		32=>array('province'=>'澳门特别行政区','capital'=>'澳门','areacode'=>'852','type'=>2),
		33=>array('province'=>'香港特别行政区','capital'=>'香港','areacode'=>'853','type'=>2),
		34=>array('province'=>'台湾省','capital'=>'台北','areacode'=>'886','type'=>2)
    );
     
    function __construct()
    {
        $this->_ci = & get_instance();
        log_message('debug', 'StaticCode Class Initialized');
    }
    
    public static function getInstance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getLoginUserStatus() {
        $list = $this->_delelteNotShow($this->_userStatus);
        foreach ($list['data'] as $id => $status) {
            if ($status['islogin'] == 1) {
                $ret[] = $id;
            }
        }
        return $ret;
    }
 
    
    public function getProvinceList(){
        return $this->_province;
    }
    
    public function getProvinceByAreaCode($code){
        foreach ($this->_province as $key=>$value){
             if(array_search($code, $value)){
                 return $value['province'];
             }
        }
    } 

}
