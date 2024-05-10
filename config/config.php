<?php
class config
{
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
private $localhost='localhost';
private $db_user='root';
private $db_password='';
private $db_name='invest';
private $connect;
public $pripare;
public $error;
public $query;
public $data;
public $last_insert_id;
public $rows=0;
public $data_array;
public function __construct(){
if(@mysqli_connect($this->localhost,$this->db_user,$this->db_password)==true)
		{
			if(@mysqli_connect($this->localhost,$this->db_user,$this->db_password,$this->db_name)==true)
			{
				$this->connect=@mysqli_connect($this->localhost,$this->db_user,$this->db_password,$this->db_name);
				@mysqli_query($connect,"SET NAMES utf8");
				@mysqli_query($connect,"SET CHARACTER SET utf8");
				@mysqli_query($connect,"set charset utf8 ;");	
			}
			else
			{
			 die ($db_name.' not exist');
			}
		}
		else
		 {
			 die("faild connect to server");
		 }
}

public function pripare($query=NULL)
{
	$this->error=NULL;
	if($query!=NULL){$this->query="$query";}
	$this->data=mysqli_query($this->connect,$this->query);
	$this->last_insert_id=mysqli_insert_id($this->connect);
	if($this->data==true) 
	{
		$this->pripare=true;
		return true;
	} 
		else {
			$this->pripare=false;
			$this->error=mysqli_error($this->connect);
		return false;}
}

public function excute()
{
	if($this->pripare())
	{
	$this->data_array=mysqli_fetch_assoc($this->data);
	 return true;
	}
	else 
	{
	return false;
	}
	
}

public function rows($query=NULL)
{
	if($query!=NULL){$this->query=$query;}
	$this->query=str_replace(' from ',', count(*) as count from ',$this->query);
	if($this->pripare())
	{
	$data=mysqli_fetch_assoc($this->data);
	$this->rows=$data['count'];
	 return true;
	}
	else 
	{
	$this->rows=0;
	return false;
	}
}

public function test()
{
	echo 'hello i am here ';
}

}


?>