<?php
class Db_PdoMySql
{
	//数据库链接
	protected $db;
	
	//数据库配置
	protected $_config;		
	
	//pdo对象
	static $instance = array();
	
	//查询参数
	public $options = array();	
		
	//错误信息
	public $error = array();	
	
	public $join = array();
	
	//缓存
	private $cache = array();	
	
	//数据库连接
	static function &instance($pConfig = 'default')
	{
		if(empty(self::$instance[$pConfig]))
		{
			$database = Yaf_Registry::get("config")->database->$pConfig->toArray();
						
			self::$instance[$pConfig] = @new PDO
			(
				 $database['dsn'], 
				 $database['username'], 
				 $database['password'], 
				 
				 array
				 (
					PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES ".$database['charset'],
				 )
			); 
		}

		return self::$instance[$pConfig];
	}
	
	
	//构造函数
	function __construct($pPK = 0, $pConfig = 'default')
	{
		$this->_config = $pConfig;
		
		//通过主键取出数据
		if($pPK && $pPK = abs($pPK))
		{
			if($tRow = $this->fRow($pPK))
			{
				foreach($tRow as $k1 => $v1) $this->$k1 = $v1;
			}
			else
			{
				foreach($this->field as $k1 => $v1) $this->$k1 = false;
			}
		}
	}
	
	//特殊方法实现
	function __call($pMethod, $pArgs)
	{
		//连贯操作的实现
		if(in_array($pMethod, array('field', 'table', 'where', 'order', 'limit', 'page', 'having', 'group', 'lock', 'distinct'), true))
		{
			$this->options[$pMethod] = $pArgs[0];
			return $this;
		}
		
		//统计查询的实现
		if(in_array($pMethod, array('count', 'sum', 'min', 'max', 'avg')))
		{
			$field = isset($pArgs[0])? $pArgs[0]: '*';
			return $this->fOne("$pMethod($field)");
		}
		
		//根据某个字段获取记录
		if('ff' == substr($pMethod, 0, 2))
		{
			
			return $this->where(strtolower(substr($pMethod, 2)) . "='{$pArgs[0]}'")->fRow();
		}
	}
		
	function query($sql)
	{
		$tArgs = func_get_args();
		$tSql = array_shift($tArgs);

		$this->db = &self::instance($this->_config);

		if($tArgs)
		{
			$tQuery = $this->db->prepare($tSql);
			$tQuery->execute($tArgs);
		}
		else
		{
			$tQuery = $this->db->query($tSql);				
		}
		
		if(!$tQuery) return array();
					
		return $tQuery->fetchAll(PDO::FETCH_ASSOC);
	}		
	
	function exec($pSql)
	{
		$this->db = &self::instance($this->_config);
		
		if($tReturn = $this->db->exec($pSql))
		{
			$this->error = array();
		}
		else
		{
			$this->error = $this->db->errorInfo();
			isset($this->error[1]) || $this->error = array();
		}
		
		return $tReturn;
	}
	
	//关联数据
	function join($pTable, $pWhere, $pPrefix = '')
	{
		$this->join[] = " $pPrefix JOIN $pTable ON $pWhere ";
		return $this;
	}		
	
	//过滤危险数据
	private function _filter(&$pData)
	{
		foreach($pData as $k1 => &$v1)
		{
			if(empty($this->field[$k1]))
			{
				unset($pData[$k1]);
				continue;
			}
			
			$v1 = strtr($v1, array('\\' => '', "'" => "\'"));
		}
		
		return $pData? true: false;
	}
	
	//查询参数
	private function _options($pOpt = array())
	{
		//合并查询条件
		$tOpt = $pOpt ? array_merge($this->options, $pOpt): $this->options;
		
		$this->options = array();
		
		//数据表
		empty($tOpt['table']) && $tOpt['table'] = $this->table;
		empty($tOpt['field']) && $tOpt['field'] = '*';
		
		//查询条件
		if(isset($tOpt['where']) && is_array($tOpt['where'])) foreach($tOpt['where'] as $k1 => $v1) if(isset($this->field[$k1]) && is_scalar($v1))
		{
			//整型格式化
			if(false !== strpos($this->field[$k1]['type'], 'int'))
			{
				$tOpt['where'][$k1] = intval($v1);
			}
			
			//浮点格式化
			elseif(false !== strpos($this->field[$k1]['type'], 'decimal'))
			{
				$tOpt['where'][$k1] = floatval($v1);
			}
		}
		
		return $tOpt;
	}
	

	//查找一条
	function fRow($pId = 0)
	{
		$tOpt = $pId ? $this->_options(array('where' => $this->pk . '=' . abs($pId))): $this->_options();
		
		$tOpt['where'] = empty($tOpt['where'])? '':' WHERE '.$tOpt['where'];
		$tOpt['order'] = empty($tOpt['order'])? '':' ORDER BY '.$tOpt['order'];

		//SQL出错时，会报出SQL语句，需要处理
		if($tResult = $this->query('SELECT '.$tOpt['field'].' FROM '.$tOpt['table'].$tOpt['where'].$tOpt['order'].' LIMIT 0,1'))
		{
			return $tResult[0];
		}
		
		return array();
	}
	
	//查找一字段 (基于fRow)
	function fOne($pField){
		$this->field($pField);
		if(($tRow = $this->fRow()) && isset($tRow[$pField])){
			return $tRow[$pField];
		}
		return false;
	}	
	
	//查找多条
	function fList($pOpt = array())
	{
		if(!is_array($pOpt))
		{
			$pOpt = array('where' => $this->pk . (strpos($pOpt, ',')? ' IN(' . $pOpt . ')': '=' . $pOpt));
		}
		
		$tOpt = $this->_options($pOpt);
		$tSql = 'SELECT ' . $tOpt['field'] . ' FROM ' . $tOpt['table'];
		$this->join && $tSql .= implode(' ', $this->join);
		empty($tOpt['where']) || $tSql .= ' WHERE ' . $tOpt['where'];
		empty($tOpt['group']) || $tSql .= ' GROUP BY ' . $tOpt['group'];
		empty($tOpt['order']) || $tSql .= ' ORDER BY ' . $tOpt['order'];
		empty($tOpt['having']) || $tSql.= ' HAVING '.$tOpt['having'];
		empty($tOpt['limit']) || $tSql .= ' LIMIT ' . $tOpt['limit'];
		return $this->query($tSql);
	}	
	
	//查询并处理为哈西数组 ( 基于 fList )
	function fHash($pField)
	{
		$this->field($pField);
		$tList = array();
		$tField = explode(',', $pField);
		if(2 == count($tField)) foreach($this->fList() as $v1) $tList[$v1[$tField[0]]] = $v1[$tField[1]];
		else foreach($this->fList() as $v1) $tList[$v1[$tField[0]]] = $v1;
		return $tList;
	}

	//添加记录
	function insert($pData, $pReplace = false)
	{
		if($this->_filter($pData))
		{
			$field = join(',', array_keys($pData));
			$val = join("','", $pData);
			
			$sql = ($pReplace? "REPLACE": "INSERT") . " INTO $this->table($field) VALUES ('$val')";

			if($this->exec($sql))
			{
				return $this->db->lastInsertId();
			}
		}
		
		return 0;
	}

	//删除记录
	function delete()
	{
		if($tArgs = func_get_args())
		{
			//主键删除
			$tSql = "DELETE FROM $this->table WHERE ";
			
			if(intval($tArgs[0]) || count($tArgs) > 1)
			{
				$tSql.= $this->pk . ' IN(' . join(',', array_map("intval", $tArgs)) . ')';
				return $this->exec($tSql);
			}
			
			//条件删除
			false === strpos($tArgs[0], '=') && exit('删除条件错误!');
			
			return $this->exec($tSql . $tArgs[0]);
		}
		
		//连贯删除
		$tOpt = $this->_options();
		if(empty($tOpt['where'])) return false;
		$tSql = "DELETE FROM " . $tOpt['table'] . " WHERE " . $tOpt['where'];
		
		return $this->exec($tSql);
	}	
	
	//更新记录
	function update($pData)
	{
		//过滤
		if(!$this->_filter($pData)) return false;
		
		//条件
		$tOpt = array();
		
		if(array_key_exists($this->pk, $pData))
		{
			$tOpt = array('where' => "$this->pk='{$pData[$this->pk]}'");
		}
		
		$tOpt = $this->_options($tOpt);
		
		//更新
		if($pData && !empty($tOpt['where']))
		{
			foreach($pData as $k1 => $v1) $tSet[] = "$k1='$v1'";		
			
			return $this->exec("UPDATE " . $tOpt['table'] . " SET " . join(',', $tSet) . " WHERE " . $tOpt['where']);
		}
		
		return false;
	}
	
	//保存记录(自动区分新增/修改)
	function save($pData)
	{
		return isset($pData[$this->pk])? $this->update($pData): $this->insert($pData);
	}
}