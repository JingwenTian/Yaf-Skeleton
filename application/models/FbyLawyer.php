<?php 
class FbyLawyerModel extends Db_Base
{
	protected $_db;
	protected $_table = 'fby_lawyer';
	
	public $field = array
    (
		'lawyerid'=> array('type'=>'int(10) unsigned', 'comment'=> '律师ID'),
        'username'=> array('type'=>'varchar(20)', 'comment'=> '登录账号'),
        'password'=> array('type'=>'varchar(40)', 'comment'=> '密码'),
        'cnname'=> array('type'=>'varchar(100)', 'comment'=> '姓名中文'),
        'enname'=> array('type'=>'varchar(30)', 'comment'=> '姓名拼音'),
        'usertype'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '用户类型：0律师，1企业，2个人，3律所'),
        'idcard'=> array('type'=>'varchar(30)', 'comment'=> '身份证'),
        'company'=> array('type'=>'varchar(60)', 'comment'=> '律所'),
        'provincecn'=> array('type'=>'varchar(30)', 'comment'=> '省中文'),
        'provinceen'=> array('type'=>'varchar(30)', 'comment'=> '省拼音'),
        'provinceid'=> array('type'=>'smallint(5) unsigned', 'comment'=> '省ID'),
        'citycn'=> array('type'=>'varchar(30)', 'comment'=> '城市中文'),
        'cityen'=> array('type'=>'varchar(30)', 'comment'=> '城市拼音'),
        'cityid'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '城市ID'),
        'address'=> array('type'=>'varchar(100)', 'comment'=> '详细地址'),
        'map'=> array('type'=>'varchar(50)', 'comment'=> '百度地图信息'),
        'phone'=> array('type'=>'varchar(20)', 'comment'=> '电话'),
        'fax'=> array('type'=>'varchar(20)', 'comment'=> '传真号'),
        'mobile'=> array('type'=>'varchar(15)', 'comment'=> '手机号'),
        'email'=> array('type'=>'varchar(50)', 'comment'=> '邮箱'),
        'post'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '邮编'),
        'zhiye_shijian'=> array('type'=>'smallint(5) unsigned', 'comment'=> '执业年份/成立时间/出生时间'),
        'zhiye_zhenghao'=> array('type'=>'varchar(30)', 'comment'=> '执业证号/营业执照'),
        'zhiye_zuzhi'=> array('type'=>'varchar(30)', 'comment'=> '组织机构代码'),
        'qq'=> array('type'=>'varchar(20)', 'comment'=> 'QQ号码'),
        'qq_weixin'=> array('type'=>'varchar(30)', 'comment'=> '腾讯微信'),
        'weibo_qq'=> array('type'=>'varchar(30)', 'comment'=> '腾讯微博'),
        'openid'=> array('type'=>'varchar(255)', 'comment'=> '微信openid'),
        'wx_last_time'=> array('type'=>'varchar(20)', 'comment'=> '文章抓取最后日期'),
        'wx_caiji_time'=> array('type'=>'int(10)', 'comment'=> '最新采集时间'),
        'wx_sync_channel_id'=> array('type'=>'int(11) unsigned', 'comment'=> '同步公众平台文章的栏目id'),
        'wwz_isauth'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '微网站授权，0正常，1-7正在制作中'),
        'wwz_template'=> array('type'=>'varchar(30)', 'comment'=> '微网站模板'),
        'wwz_tip'=> array('type'=>'varchar(255)', 'comment'=> '微网站总温馨提示，格式：title/content，数组序列化存储。'),
        'wwz_ad'=> array('type'=>'varchar(255)', 'comment'=> '微网站宣传语'),
        'wwz_config'=> array('type'=>'varchar(500)', 'comment'=> '微网站配置项(wwz_title,wwz_face,wx_id,wx_name)'),
        'wwz_nav'=> array('type'=>'varchar(255)', 'comment'=> '微网站导航'),
        'wwz_onlinetime'=> array('type'=>'int(10) unsigned', 'comment'=> '微网站上线时间'),
        'num_article'=> array('type'=>'int(10) unsigned', 'comment'=> '律师文章数量'),
        'pc_isauth'=> array('type'=>'tinyint(1) unsigned', 'comment'=> 'PC网站授权，0通过，1-7表示显示跟踪步骤'),
        'domain'=> array('type'=>'varchar(30)', 'comment'=> '绑定的域名'),
        'inputtime'=> array('type'=>'int(10) unsigned', 'comment'=> '账号创建时间'),
        'login_state'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '登录状态，0可以，1禁止'),
        'login_num'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '登录次数'),
        'login_time'=> array('type'=>'int(10) unsigned', 'comment'=> '最后一次登录时间'),
        'login_ip'=> array('type'=>'varchar(20)', 'comment'=> '最后登录IP'),
	    'islibrary'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '是否素材库，0不是，1是'),		
        'api_fabao365id'=> array('type'=>'int(10) unsigned', 'comment'=> '法邦网账号ID'),
        'partinfo'=> array('type'=>'smallint(5) unsigned', 'comment'=> '年份，表分区信息')
    );

    public $pk = 'lawyerid';
	
	public function getLawyerList()
	{
		$field = [lawyerid,username,password,cnname,enname,usertype,idcard,company,provincecn,provinceen,provinceid,citycn,cityen,cityid,address,map,phone,fax,mobile,email,post,zhiye_shijian,zhiye_zhenghao,zhiye_zuzhi,qq,qq_weixin,weibo_qq,openid,wx_last_time,wx_caiji_time,wx_sync_channel_id,wwz_isauth,wwz_template,wwz_tip,wwz_ad,wwz_config,wwz_nav,wwz_onlinetime,num_article,pc_isauth,domain,inputtime,login_state,login_num,login_time,login_ip,api_fabao365id,partinfo,islibrary];
		$where = ['lawyerid[<]'=>10];
		$data = $this->_db->select("$this->_table",
					$field,
					$where
				);
		return $data;
		//return $this->_db->last_query();
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	



}