<? 
	foreach ($filesThumb as $key => $value){
		if ($filesThumb[$key] != '.' && $filesThumb[$key] != '..')
		echo '<div><a href="' . $foldBig . $filesThumb[$key] . '" target=_blank><img src="' . $foldThumbs . $filesThumb[$key] . '"></a></div>';
	}
?>
  
    
    