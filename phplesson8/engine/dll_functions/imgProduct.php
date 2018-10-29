<?
//функция обработки товара
function imgProduct($img) {
	if ($img != '' && file_exists($_SERVER['DOCUMENT_ROOT'] . $img))   {
			$size          = @getimagesize($_SERVER['DOCUMENT_ROOT'] . $img);   
			 
		}
		else {
			if (file_exists($_SERVER['DOCUMENT_ROOT'] . "/img/shablon-images/no_photo.png"))   {
			$size          = @getimagesize($_SERVER['DOCUMENT_ROOT'] . "/img/shablon-images/no_photo.png");
			$img = "/img/shablon-images/no_photo.png";
			}
			else {
				return '';
			}
		}
	$array_img[0]   = $img;
	$array_img[1]	= $size[3];
	return $array_img;
}
?>