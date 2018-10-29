<? 
$sql ="SELECT 
			*
		FROM 
			$table_photos 
		ORDER BY
			likes DESC
			";
		
//echo $sql . '<br>';;
$result = mysqli_query($connection,$sql) or die("Невозможно выполнить запрос на выборку");
$photo = '';
for ($i = 1; $row = mysqli_fetch_array($result);$i++) {

	$id_photo_list[$i]     = $row['id_photo'];
	$photo_big_list[$i]    = $row['photo_big'];
	$photo_thumb_list[$i]  = $row['photo_thumb'];
	$photo_alt_list[$i]    = $row['photo_alt']; 
	$likes_list[$i] 	   = $row['likes']; 
	
	
		if ($photo_alt_list[$i] != '') {
			$photo_alt_list[$i] = ' alt="' . $photo_alt_list[$i] . '" title="' . $photo_alt_list[$i] . '"';
		}	
		//else $photo_alt_list[$i] = '';
		if ($photo_thumb_list[$i] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_list[$i]))   {
			$size 		=  getimagesize($_SERVER['DOCUMENT_ROOT'] . $photo_thumb_list[$i]);  
			$photo_thumb_list[$i] = '<img src="' . $photo_thumb_list[$i] . '"' . $photo_alt_list[$i] . $size[3] . '>';
			if ($photo_big_list[$i] != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $photo_big_list[$i]) )   {
				$photo_thumb_list[$i] = '<a href="' . $pathAlbum . '?id_photo=' . $id_photo_list[$i] . '">'
											. $photo_thumb_list[$i] .
										'</a>';
			}
			$photo_thumb_list[$i] = '<div>' . $photo_thumb_list[$i] . '<div class="like">' . $likes_list[$i] . '</div></div>';
			$photo .= $photo_thumb_list[$i];
		}
}


echo $photo;		
		

?>
  
    
    