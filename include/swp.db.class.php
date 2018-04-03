<?php
/*
 * 数据库对象
 */
class SWPDB {
    private $dbuser;
    private $dbpassword;
    private $dbname;
    private $dbhost;
    private $connect;
    private $show_errors=false;
    public $insert_id;

	public function __construct($host,$user,$password,$name,$code='utf8'){
        $this->dbuser=$user;
        $this->dbpassword=$password;
        $this->dbname=$name;
        $this->dbhost=$host;
        if(DEBUG&&DEBUG===true){
            $this->show_errors=true;
        }
		$this->connect=mysqli_connect($host,$user,$password);
		if($this->connect){
			mysqli_query($this->connect,'set names '.$code);
			mysqli_select_db($this->connect,$name);
        }
	}

	//执行不需要结果的sql:insert update等等
	public function query($queryString){
		$result = mysqli_query($this->connect,$queryString);
        if(preg_match('/^\s*(insert|replace)\s/i',$queryString)){
            $this->insert_id=mysqli_insert_id($this->connect);
        }
        if($this->show_errors){
            echo mysqli_error($this->connect);
        }
        return $result;
	}

	//获取一个变量
	public function get_var($queryString){
		$re=$this->query($queryString);
		$res=@mysqli_fetch_array($re,MYSQLI_NUM);
        return $res[0];
	}
    //获取一行记录
    public function get_row($queryString,$type=MYSQLI_ASSOC){
		$re=$this->query($queryString);
        return @mysqli_fetch_array($re,$type);
    }

	//获取多行记录，返回二维数组
	public function get_results($queryString,$type=MYSQLI_ASSOC){
		$re=$this->query($queryString);
		$res=array();
		while($a=@mysqli_fetch_assoc($re)){
			$res[]=$a;
		}
		if(empty($res)){
			return;
		}else{
			return $res;
		}
	}
    //自动关闭mysqli
	public function __destruct(){
		if($this->connect){
			mysqli_close($this->connect);
		}
	}
}
