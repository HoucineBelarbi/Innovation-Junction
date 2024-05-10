<?php
//include('../config/config.php');
//include('validate.php');
class annonce extends validate 
{
public $title;
public $expliquation;
public $date_debut;
public $date_fin;
public $limit;
public $niveau;
public $maxe;
public $add=false;
public $dossier=array();
public $population=array();
public $capacity;
public $validate;
public $inscription=false;



public function  __construct ()
{
	global $config;
	$this->config=$config;
	
}

public function validate_annonce()
{
	$this->title_text=$this->scan($this->title);
	$this->expliquation=$this->scan_html($this->expliquation);
	$this->date_debut=$this->date_debut;
	$this->date_fin=$this->date_fin;
	foreach($this->population as $key=>$val)
	{
		$this->population["$key"]=$val;
		
	}
	$this->capacity=$this->scan($this->capacity);
	return true;
}
public function add()
{
		if($this->validate_annonce())
		{
$this->config->query="INSERT INTO `annonce` (`id`, `title`, `expl`, `date_debut`, `date_fin`, `capacite`, `open`) VALUES (NULL, '$this->title', '$this->expliquation', '$this->date_debut', '$this->date_fin', '$this->capacity', '$this->inscription');
";

			$this->config->pripare();
			$last_id=$this->config->last_insert_id;			
			foreach($this->population as $key=>$val)
			{
			 $this->config->query="INSERT INTO population(`annonce`,`niveau`) VALUE('$last_id','$val');";
			 $this->config->pripare();
			}

			$this->validate=true;
			$this->add=true;
			return true;
		}
		else
		{
			$this->error_annonce();
			$this->validate=false;
			$this->add=false;
			return false;
		}
}
public function if_annonce($annonce)
{
	$query="SELECT count(*) as count FROM annonce WHERE id='".$annonce."'";
	$this->config->rows($query);
	if($this->config->rows)
	{
		return true;
	}
	else 
	{
		return false;
	}
}	

public function get_info($annonce)
{
	
	if($this->if_annonce($annonce))
		{
			$this->config->query="SELECT annonce.id,title,expl,date_debut,date_fin,capacite,`open`, niveau as id_niveau, niveau.nom as niveau  from annonce,population,niveau where annonce.id='".$annonce."' and  annonce.id=population.annonce and population.niveau=niveau.id ";
			$this->config->pripare();
				if($this->config->pripare)
				{
				$this->config->excute();
				$this->if_annonce($annonce);
				$this->limit=$this->config->rows;
				$this->id=$this->config->data_array['id'];
				$this->capacity=$this->config->data_array['capacite'];
				$this->date_debut=$this->config->data_array['date_debut'];
				$this->date_fin=$this->config->data_array['date_fin'];
				$this->niveau=$this->config->data_array['niveau'];
				$this->title=$this->config->data_array['title'];
				$this->expliquation=$this->config->data_array['expl'];
				//$this->population=$this->config->data_array['population'];
				$this->inscription=$this->config->data_array['open'];
				return true;
				}
				else
				{
					$this->error_annonce();
				}
		}
		else
		{
			$this->error_annonce();
			return false;
		}
}

public function reserv($annonce,$client)
{
	$annonce=(int)$annonce;
	$client=(int)$client;
	if($annonce>0 and $client>0)
	{
		$this->config->query="INSERT INTO population(`annonce`,`niveau`) VALUE('$last_id','$val');";
		$this->config->pripare();
		if($this->config->pripar)
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


private function error_annonce($error=NULL)
{
	switch($error)
	{

		default:
		$this->error_annonce='حدث خطأ نعمل على اصلاحه';
		return false;
		
	}
}



}



/*
*/



?>
