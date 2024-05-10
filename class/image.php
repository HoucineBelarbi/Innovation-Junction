<?php 

class Image 
{
	public $maxe=5;
	public $stemp='../style/img/sadoukinvest.png';
	public $directory='pic_lesson';
	public $directory_from_her='pic_lesson';
	public $width_b=800;
	public $height_b=600;
	public $width_s=260;
	public $height_s=200;
	public $max_size="3145728000055555555";
	public $extention=array('jpg','jpeg','png','JPG');
	function save_png($data_file,$path)
	{
		return imagejpeg($data_file,$path,90, PNG_ALL_FILTERS);
	}
	
	public function removeAccents($str) {
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή','(',')');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η','x','x');
  return utf8_encode(str_replace($a, $b, $str));
}
	
	
	public function resize_image($file, $w, $h,$data=false) {
    list($width, $height) = getimagesize($file);
	if($data==false)
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION);
		switch ($ext)
		{
			case 'png':
			$src = @imagecreatefrompng($file);
			break;
			case 'jpeg':
			$src = @imagecreatefromjpeg($file);
			break ;
			case 'jpg' or 'JPG':
			$src = @imagecreatefromjpeg($file);
			break ;
			default :
			$src=$file;
		}
	}
	else
	{
		$src=$file;
	}
	
   
    

	 ////////////////////
  
	// Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci

	// Copie le cachet sur la photo en utilisant les marges et la largeur de la
	// photo originale  afin de calculer la position du cachet 
	$dst = imagecreatetruecolor($w, $h);
	@imagecopyresampled($dst, $src, 0, 0, 0, 0, $w, $h, $width, $height);
    return $dst;
}


 public function watermarque($file,$stemp,$data=false)
 {
	 if($data==false)
	 {
		 $ext = pathinfo($file, PATHINFO_EXTENSION);
			switch ($ext)
			{
				case 'png':
				$src = @imagecreatefrompng($file);
				break;
				case 'jpeg':
				$src = @imagecreatefromjpeg($file);
				break ;
				case 'jpg'  or 'JPG':
				$src = @imagecreatefromjpeg($file);
				break ;
				default :
				$src=$file;
			}	
	 }
	 else
	 {
		 $src=$file;
	 }
	 
	$ext_p = pathinfo($this->stemp, PATHINFO_EXTENSION);
	switch ($ext_p)
	{
		case 'png':
		 $stamp = imagecreatefrompng($this->stemp);
		break;
		case 'jpeg' or 'jpg':
		 $stamp = imagecreatefromjpeg($this->stemp);
		break ;
		default :
		$this->stemp=$this->stemp;
	}
	
	// Définit les marges pour le cachet et récupère la hauteur et la largeur de celui-ci
	$marge_right = 70;
	$marge_bottom = 50;
	$sx = imagesx($stamp);
	$sy = imagesy($stamp);
	
	// Copie le cachet sur la photo en utilisant les marges et la largeur de la
	// photo originale  afin de calculer la position du cachet 
	@imagecopy($src, $stamp, imagesx($src) - $sx - $marge_right, imagesy($src) - $sy - $marge_bottom, 0, 0, imagesx($stamp), imagesy($stamp));
	
	// Affichage et libération de la mémoire
	return $src;
 }
 
 	public function upload($images)
	{
			$num_files = count($images['image']['tmp_name']);//count file upload
						if($num_files<=$this->maxe)
						{
				
							for($i=0; $i<$num_files; $i++)
							{
								$name=$this->removeAccents($images['image']['name'][$i]);
								$name=date('Y-m-d-h-i-sa').$name;
								$tmp_name=$images['image']['tmp_name'][$i];
								$size=$images['image']['size'][$i];
								$type=$images['image']['type'][$i];
								$ext=pathinfo($name, PATHINFO_EXTENSION);
								if($num_files<$this->maxe)
								{
									if(!is_uploaded_file($tmp_name))
									{	
										echo "<span class='label label-info center-block text-center'><h4>انت لم تختر صور للرفع!</h4></span>";
									}else
									{
										if(in_array($ext,$this->extention))
										{
											if($size<=$this->max_size)
											{
												$this->directory_from_her="../".$this->directory;
												$path = $this->directory_from_her.'/'.$name;
												if(!file_exists($this->directory_from_her))
														{
															mkdir($this->directory_from_her,0777,true);
														}
							
												if(@copy($tmp_name, $path))
													{
														$bigfile=$this->resize_image($path,$this->width_b,$this->height_b);
														$smalfile=$this->resize_image($path,$this->width_s,$this->height_s);
														$bigfile=$this->watermarque($bigfile,$this->stemp,true);
														$this->save_png($bigfile,$path);
														/*$this->save_png($smalfile,$this->directory.'/_s'.$name);	*/	
														$success_upload[]=$name;
													
									
														if($i==($num_files-1))
														{
															return $success_upload;
															
														}
														
														
													}else
													{
														$faild_upload[]=$name;
														echo "cant upload";
													}
												
											}
											else
											{
												$faild_upload[]=$name;
											}
										}
										else
										{
											$faild_upload[]=$name;
											
										}
									}
								}
								else
								{
									echo "<div class='alert alert-danger'><strong>
tu peux pas avoir plus de 8 images a lannonce</strong></div>";
									break;
								}
							unset($_POST);
							}
						}
						else
						{
							echo "maximun ".$this->maxe." images";
						}
					
	}
}



?>