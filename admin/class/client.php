<?php
session_start();
//include('../config/config.php');
//include('validate.php');
class client extends validate 
{
public $query;
public $is_login;
public $is_user;
public $data;
public $db_error;
public $config;

// get function class=config in config.php
public function  __construct ()
{
	global $config;
	$this->config=$config;
	
	if(isset($_SESSION['email_ad'])or isset($_SESSION['password_ad']))
	{
		if(isset($_SESSION['email_ad'])){$this->email=$_SESSION['email_ad'];} else{$this->email=NULL;}
		if(isset($_SESSION['password_ad'])){$this->password=$_SESSION['password_ad'];} else{ $this->password= NULL ;}
		
		if(!$this->if_user()){$this->logout();}
	}
}

private function db_error($error=NULL,$etat=NULL)
{
	switch($error)
	{
		case 'email':
			switch ($etat)
			{
				case 'dublicate':
				$this->db_error='الايميل الذي ادخلته مستعمل من قبل';
				return $this->db_error;
				break;
				case 'indisponible':
				$this->db_error='الايميل الذي ادخلته لا يرتبط باي حساب';
				return $this->db_error;
				break;
				default:
			}
		break;
		case 'not user':
		$this->db_error='البيانات التي ادخلتها خاطئة';
		return $this->db_error;
		break;
		default:
		$this->db_error='حدث خطأ نعمل على اصلاحه';
		return false;
		
	}
}
public function validate_frm_login()
{
	$this->error=NULL;
		if($this->validate_email($this->email))
		{
			if($this->validate_password($this->password))
			{			
					return true;
			}
			else
			{
				$this->get_error('password');
				return false;
			}
		}
		else
		{
			$this->get_error('email');
			return false;
		}
	
}

public function if_user()
{
	if($this->validate_frm_login())
	{
		$this->config->query="select * from admin where email='$this->email' and password='$this->password'";
		$this->config->rows();
		if($this->config->rows==1)
		{
			return true;
			
		}
		else 
		{
			$this->db_error('email','indisponible');
			return false;
		}
	}
}

public function login()
{
	if($this->if_user())
	{
		$_SESSION['email_ad']=$this->email;
		$_SESSION['password_ad']=$this->password;
		return true;
	}
	else{
		$this->db_error('not user');
		return false;
	}
}
	
public function add()
{
	// get count email;
	$query_count="SELECT count(*) as count FROM admin where email='".$this->email."'";
	
	//gadd new client
	$query_add="
		INSERT INTO `admin` (`id`, `f_name`, `l_name`,`date_n`,`adress`,`email`,`password`,`phone`,`niveau`,`sexe`) 
		VALUES (NULL, '$this->f_name', '$this->l_name','$this->date_n','$this->adress','$this->email','$this->password','$this->phone','$this->niveau','$this->sexe')";
		
	if($this->config->rows($query_count))
	{
		if($this->config->rows==0)
		{
			if($this->config->pripare($query_add))
			{
				return true;
			}
			else
			{

				
				$this->db_error();
				return false;
			}
		}
		else
		{
			$this->db_error('email','dublicate');
			return false;
		}
	}
	else
	{

		$this->db_error=$this->config->query;
		return false;
		}
	
}


public function update()
{
	if($this->validate_update())
	{
		$this->config->query='';
		if($this->config->pripare())
		{
			return true;
			
		}
		else
		{
			return false;
		}
	}
}

public function logout()
{
	session_destroy();
}
}



/*
*/



?>