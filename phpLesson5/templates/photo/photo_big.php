<? 

if (isset($_GET['id_photo']) && $_GET['id_photo'] > 0)  {
	$WHERE_photos = "WHERE $table_photos.id_photo='" .  $_GET['id_photo'] . "' ";   
	} 
else {
	$WHERE_photos = '';
	}

if ($WHERE_photos != '') {  //добавляем лайк
	$sql = "UPDATE 
			$table_photos
		SET 
			likes=(likes + 1)
		$WHERE_photos
		";
	//echo $sql . '<br>';
	$result = mysqli_query($connection,$sql) or die("Невозможно выполнить запрос на добавления лайка");
}

$sql = "SELECT 
			*
		FROM 
			$table_photos "
		. $WHERE_photos;
		
//echo $sql . '<br>';;
$result = mysqli_query($connection,$sql) or die("Невозможно выполнить запрос на выборку");

$photo = '';
for ($i = 1; $row = mysqli_fetch_array($result);$i++) {

	$id_photo_list[$i]     = $row['id_photo'];
	$photo_big_list[$i]    = $row['photo_big']; //echo $_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i] . '<br>';
	//$photo_thumb_list[$i]  = $row['photo_thumb'];
	$photo_alt_list[$i]    = $row['photo_alt']; 
	$likes_list[$i]    = $row['likes'];
	
		
		
		if ($photo_big_list[$i] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i]) )   {
						
			if ($photo_alt_list[$i] != '') {
				$photo_title_list[$i] = '<div class="photoTitle">' . $photo_alt_list[$i] . '</div>';
				$photo_alt_list[$i]   = ' alt="' . $photo_alt_list[$i] . '" title="' . $photo_alt_list[$i] . '"';
			}
			//else $photo_alt_list[$i] = '';	

			$size = ''; 
			$size =  getimagesize($_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i]) ;    
			$photo_big_list[$i] = '<img src="' . $photo_big_list[$i] . '"' . $photo_alt_list[$i] . $size[3] . '>';
			$photo .= '<div>' . $photo_big_list[$i] . '<div class="like">' . $likes_list[$i] . '</div>' . $photo_title_list[$i] . '</div>';
		}
	
}

echo $photo;
?>
  
    
    