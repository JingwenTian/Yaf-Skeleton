<?php 
class FbyLawyerModel extends Db_Base
{
	protected $_db;
	protected $_table = 'fby_lawyer';
	
	public $field = array
    (
		'lawyerid'=> array('type'=>'int(10) unsigned', 'comment'=> '��ʦID'),
        'username'=> array('type'=>'varchar(20)', 'comment'=> '��¼�˺�'),
        'password'=> array('type'=>'varchar(40)', 'comment'=> '����'),
        'cnname'=> array('type'=>'varchar(100)', 'comment'=> '��������'),
        'enname'=> array('type'=>'varchar(30)', 'comment'=> '����ƴ��'),
        'usertype'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '�û����ͣ�0��ʦ��1��ҵ��2���ˣ�3����'),
        'idcard'=> array('type'=>'varchar(30)', 'comment'=> '���֤'),
        'company'=> array('type'=>'varchar(60)', 'comment'=> '����'),
        'provincecn'=> array('type'=>'varchar(30)', 'comment'=> 'ʡ����'),
        'provinceen'=> array('type'=>'varchar(30)', 'comment'=> 'ʡƴ��'),
        'provinceid'=> array('type'=>'smallint(5) unsigned', 'comment'=> 'ʡID'),
        'citycn'=> array('type'=>'varchar(30)', 'comment'=> '��������'),
        'cityen'=> array('type'=>'varchar(30)', 'comment'=> '����ƴ��'),
        'cityid'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '����ID'),
        'address'=> array('type'=>'varchar(100)', 'comment'=> '��ϸ��ַ'),
        'map'=> array('type'=>'varchar(50)', 'comment'=> '�ٶȵ�ͼ��Ϣ'),
        'phone'=> array('type'=>'varchar(20)', 'comment'=> '�绰'),
        'fax'=> array('type'=>'varchar(20)', 'comment'=> '�����'),
        'mobile'=> array('type'=>'varchar(15)', 'comment'=> '�ֻ���'),
        'email'=> array('type'=>'varchar(50)', 'comment'=> '����'),
        'post'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '�ʱ�'),
        'zhiye_shijian'=> array('type'=>'smallint(5) unsigned', 'comment'=> 'ִҵ���/����ʱ��/����ʱ��'),
        'zhiye_zhenghao'=> array('type'=>'varchar(30)', 'comment'=> 'ִҵ֤��/Ӫҵִ��'),
        'zhiye_zuzhi'=> array('type'=>'varchar(30)', 'comment'=> '��֯��������'),
        'qq'=> array('type'=>'varchar(20)', 'comment'=> 'QQ����'),
        'qq_weixin'=> array('type'=>'varchar(30)', 'comment'=> '��Ѷ΢��'),
        'weibo_qq'=> array('type'=>'varchar(30)', 'comment'=> '��Ѷ΢��'),
        'openid'=> array('type'=>'varchar(255)', 'comment'=> '΢��openid'),
        'wx_last_time'=> array('type'=>'varchar(20)', 'comment'=> '����ץȡ�������'),
        'wx_caiji_time'=> array('type'=>'int(10)', 'comment'=> '���²ɼ�ʱ��'),
        'wx_sync_channel_id'=> array('type'=>'int(11) unsigned', 'comment'=> 'ͬ������ƽ̨���µ���Ŀid'),
        'wwz_isauth'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '΢��վ��Ȩ��0������1-7����������'),
        'wwz_template'=> array('type'=>'varchar(30)', 'comment'=> '΢��վģ��'),
        'wwz_tip'=> array('type'=>'varchar(255)', 'comment'=> '΢��վ����ܰ��ʾ����ʽ��title/content���������л��洢��'),
        'wwz_ad'=> array('type'=>'varchar(255)', 'comment'=> '΢��վ������'),
        'wwz_config'=> array('type'=>'varchar(500)', 'comment'=> '΢��վ������(wwz_title,wwz_face,wx_id,wx_name)'),
        'wwz_nav'=> array('type'=>'varchar(255)', 'comment'=> '΢��վ����'),
        'wwz_onlinetime'=> array('type'=>'int(10) unsigned', 'comment'=> '΢��վ����ʱ��'),
        'num_article'=> array('type'=>'int(10) unsigned', 'comment'=> '��ʦ��������'),
        'pc_isauth'=> array('type'=>'tinyint(1) unsigned', 'comment'=> 'PC��վ��Ȩ��0ͨ����1-7��ʾ��ʾ���ٲ���'),
        'domain'=> array('type'=>'varchar(30)', 'comment'=> '�󶨵�����'),
        'inputtime'=> array('type'=>'int(10) unsigned', 'comment'=> '�˺Ŵ���ʱ��'),
        'login_state'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '��¼״̬��0���ԣ�1��ֹ'),
        'login_num'=> array('type'=>'mediumint(8) unsigned', 'comment'=> '��¼����'),
        'login_time'=> array('type'=>'int(10) unsigned', 'comment'=> '���һ�ε�¼ʱ��'),
        'login_ip'=> array('type'=>'varchar(20)', 'comment'=> '����¼IP'),
	    'islibrary'=> array('type'=>'tinyint(1) unsigned', 'comment'=> '�Ƿ��زĿ⣬0���ǣ�1��'),		
        'api_fabao365id'=> array('type'=>'int(10) unsigned', 'comment'=> '�������˺�ID'),
        'partinfo'=> array('type'=>'smallint(5) unsigned', 'comment'=> '��ݣ��������Ϣ')
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