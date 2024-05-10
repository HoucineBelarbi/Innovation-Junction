<?php

class validate {
	
	public $f_name;
	public $l_name;
	public $day_n;
	public $month_n;
	public $year_n;
	public $date_n;
	public $adress;
	public $email;
	public $password;
	public $password_again;
	public $phone;
	public $niveau;
	public $sexe;
	public $captcha;
	private $list_sexe=array("H","F");
	public $error;
	
	public function scan($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	public function scan_text($data)
	{
	  $data = addslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	 
	}
	public function scan_text_out($data)
	{
	  $data =stripslashes($data);
	  return $data;
	 
	}
	public function html2math($data)
	{
		
	$data=str_replace("\\(","$",$data);
	$data=str_replace("\\)","$",$data);
	$data=str_replace("\\","($)",$data);
	  return $data;
	 
	}
	public function math2html($data)
	{
	$data=str_replace("($)","\\",$data);
	$data=str_replace("../","",$data);
	  return $data;
	 
	}
	public function scan_html($data)
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  
	  return $data;
	}
	public function get_error($error)
	{
		$this->error=NULL;
		switch ($error)
		{
			
			case ('l_name') :
			$this->error='اللقب مكتوب بطريقة غير صحيحة';
			break;
			case ('f_name'):
			$this->error='الاسم مكتوب بطريقة غير صحيحة';
			break;
			case "isdate":
			$this->error='خطأ في كتابة التاريخ';
			break;
			case "adress":
			$this->error="العنوان مكتوب بطريقة غير صحيحة";			
			break;
			case "email":
			$this->error="البريد الاكتروني الذي ادخلته خاطئ";			
			break;
			case "password":
			$this->error="الرقم السري يكون ممزوج ما بين الارقام و الحروف";			
			break;
			case "password_again":
			$this->error="خطأ في اعادة كتابة الرقم السري";			
			break;
			case "phone":
			$this->error="رقم الهاتف الذي ادخلته خاطئ";			
			break;
			case "niveau":
			$this->error="الرجاء اختيار المستوى المناسب";			
			break;
			case "sexe":
			$this->error="اختر الجنس من فضلك";			
			break;
			case "captcha":
			$this->error="خطأ في كتابة الكود";			
			break;
			
			default:
			 $this->error="خطأ في البيانات";
			 break;
		}
	}
	
	public function validate_f_name($name)
	{
		$name=$this->scan($name);
		if( strlen($name)<3 or strlen($name)>80)
		{
			$this->get_error('f_name');
			return false ;
		}
		else {
			
			return true;
			}
	}
	public function validate_l_name($name)
	{
		$name=$this->scan($name);
		if( strlen($name)<3 or strlen($name)>80)
		{
			$this->get_error('l_name');
			return false ;
		}
		else {
			
			return true;
			}
	}
	
	public function validate_date($day_n=NULL,$month_n=NULL,$year_n=NULL)
	{
		$this->error=NULL;
		$day_n=$this->scan($day_n);
		$month_n=$this->scan($month_n);
		$year_n=$this->scan($year_n);
		if($day_n>=1 and $day_n<=31 and $month_n>=1 and $month_n<=12 and $year_n>date('Y')-101 and $year_n<=date('Y')) 
		{
			$test_date=$day_n .'/'.$month_n. '/'.$year_n;
			$test_arr  = @explode('-', $test_date);
			if (@checkdate($test_arr[1], $test_arr[2], $test_arr[0])) 
			{
				$this->get_error('isdate');	
				return false;
			}
			else
			{
				$this->date_n=$year_n. '/'.$month_n .'/'.$day_n;;
				 return true;
			}
		}
		else 
		{
			$this->get_error('isdate');
			return false;
		}
	}
	
	public function scan_s($data)
	{
	   $data = stripslashes($data);
	   $data = htmlspecialchars($data);
	   return $data;
	
	}
	public function validate_adress($adress)
	{
		$adress=$this->scan_s($adress);
		if(strlen($adress)<150 and strlen($adress)>=10  ) return true; 
		else 
		{
		$this->get_error('adress');
		return false;
		}
	}
	
	public function validate_email($email)
	{
		$email=$this->scan($email);
		if(filter_var($email, FILTER_VALIDATE_EMAIL) )return true; 
		else 
		{
		$this->get_error('email');
		return false;
		}
	}
	
	public function validate_link($link)
		{
			$link=$this->scan($link);
		if(!preg_match("/^(http\:\/\/)?(www\.)?(youtube\.com|youtu\.be)\/watch\?v\=\w+$/", $link)) return true;
		else 
		{
			$this->get_error('email');
			return false;
		}
		}
	public function validate_password($password)
	{
		$password=$this->scan($password);
		if(preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $password)) return true; 
		else 
		{
		$this->get_error('password');
		return false;
		}
	}
	
	public function validate_password_again($password,$password_again)
	{
		$password=$this->scan($password);
		$password_again=$this->scan($password_again);
		if($password==$password_again)return true; 
		else 
		{
		$this->get_error('password_again');
		return false;
		}
	}
	
	public function validate_phone($phone)
	{
		$phone=$this->scan($phone);
		if(preg_match('/^0[5-7][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]$/', $phone))
		{
			return true;
		}
		else
		{
			$this->get_error('phone');
			return false;
		}
	}
	
	public function validate_niveau($niveau,$list_niveau=NULL)
	{
		
		$niveau=$this->scan($niveau);
		if(in_array($niveau,$list_niveau))return true;
		else 
		{
		$this->get_error('niveau');
		return false;
		}
	}
	
	public function validate_sexe($sexe)
	{
		$sexe=$this->scan($sexe);
		if(in_array($sexe,$this->list_sexe))return true;
		else 
		{
		$this->get_error('sexe');
		return false;
		}
	}
	
	static function hello ()
	{
		echo "hello tout le monde"; 
	}
	
	public function make_date($date_am,$format='d/m/y')
	{
		$date_am=date($format, strtotime($date_am));
		
		return $date_am;
	}
	public function validate_form($list_niveau=NULL)
{
	if($this->validate_f_name($this->f_name))
	{
		if($this->validate_l_name($this->l_name))
		{
			if($this->validate_date($this->day_n,$this->month_n,$this->year_n))
			{
				if($this->validate_adress($this->adress))
				{
					if($this->validate_email($this->email))
					{
						if($this->validate_password($this->password))
						{
							if($this->validate_password_again($this->password,$this->password_again))
							{
								if($this->validate_phone($this->phone))
								{
									if($this->validate_niveau($this->niveau,$list_niveau))
									{
										if($this->validate_sexe($this->sexe))
										{
											 return true;
										}
										else 
										{
											  return false;
										}  
									}
									else 
									{
										  return false;
									} 
								}
								else 
								{
									  return false;
								} 
							}
							else 
							{
								  return false;
							} 
						}
						else 
						{
							  return false;
						} 
					}
					else 
					{
						  return false;
					}
				}
				else 
				{
					  return false;
				}
			}
			else 
			{
				  return false;
			} 
		}
		else 
		{
			  return false;
		}
	}
	else 
	{
		 return false;
	}
}


public function validate_update()
{
	if($this->validate_f_name($this->f_name))
	{
		if($this->validate_l_name($this->l_name))
		{
			if($this->validate_date($this->day_n,$this->month_n,$this->year_n))
			{
				if($this->validate_adress($this->adress))
				{
					
					if($this->validate_phone($this->phone))
					{
						if($this->validate_niveau($this->niveau))
						{
							if($this->validate_sexe($this->sexe))
							{
								 return true;
							}
							else 
							{
								  return false;
							}  
						}
						else 
						{
							  return false;
						} 
					}
					else 
					{
						  return false;
					} 
								
				}
				else 
				{
					  return false;
				}
			}
			else 
			{
				  return false;
			} 
		}
		else 
		{
			  return false;
		}
	}
	else 
	{
		 return false;
	}
}

}




?>