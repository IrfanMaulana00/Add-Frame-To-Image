<?php
putenv('GDFONTPATH=' . realpath('.'));

function cekurl($url){
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	curl_setopt($ch, CURLOPT_HEADER, 1);
	curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/78.0.3904.87 Safari/537.36',
		'cookie:_gcl_au=1.1.1634096601.1588922242; SPC_IA=-1; SPC_EC=-; SPC_F=ErFGfEaDnUnriKEpuCdkMXgDy96Q91em; REC_T_ID=e9f1c28e-90fb-11ea-bc99-3c15fb7e9bad; SPC_U=-; csrftoken=qc4ogxScMXcdBQ8nJufS6qN8upANfMAb; welcomePkgShown=true; AMP_TOKEN=%24NOT_FOUND; SPC_CT_63a2db29="1588922281.QCZkdF1DlsdDsHqZlRZCTYHYkfjOsCVlvzvhUiwwl3U="; _dc_gtm_UA-61904553-8=1; _ga=GA1.3.771077742.1588922246; _gid=GA1.3.2004889898.1588922246; _fbp=fb.2.1588922242475.1575422633; SPC_R_T_ID="O7iJLuesyppUUb6cDP4fzvBoWufFRdhQkFK2VAw6sKuaNg0P+acfc4QUYEHUnjVhLZffDCLf3Dri65PvZKSqthxWJSxmZWfaAnydxZJaCvY="; SPC_T_IV="6dBHRfPHSvllmBjsewcrYw=="; SPC_R_T_IV="6dBHRfPHSvllmBjsewcrYw=="; SPC_T_ID="O7iJLuesyppUUb6cDP4fzvBoWufFRdhQkFK2VAw6sKuaNg0P+acfc4QUYEHUnjVhLZffDCLf3Dri65PvZKSqthxWJSxmZWfaAnydxZJaCvY="; SPC_SI=uy1fk0yfsl1opk0qhztq9fm83pg339fe'
	));

	$content = curl_exec($ch);
	$contentType = curl_getinfo($ch, CURLINFO_CONTENT_TYPE);
	curl_close($ch);
	
	return $contentType;
}

function hexColorAllocate($im,$hex){
    $hex = ltrim($hex,'#');
    $a = hexdec(substr($hex,0,2));
    $b = hexdec(substr($hex,2,2));
    $c = hexdec(substr($hex,4,2));
    return imagecolorallocate($im, $a, $b, $c); 
}

$frame = 'frame.png';
$gambar = 'sample.jpg';

$png = imagecreatefrompng($frame);
$jpeg = imagecreatefromjpeg($gambar);

list($width, $height) = getimagesize($gambar);
list($newwidth, $newheight) = getimagesize($frame);

$out = imagecreatetruecolor($width, $height);
$black = imagecolorallocate($out, 255, 45, 1);
$font_path = 'D:\ngods\php\frame\oswald.ttf';
$size = 10;
$text = "@anjaybang";

$text_size = imagettfbbox($size, 0, $font_path, $text);
$text_width = max([$text_size[2], $text_size[4]]) - min([$text_size[0], $text_size[6]]);
$text_height = max([$text_size[5], $text_size[7]]) - min([$text_size[1], $text_size[3]]);
$centerX = CEIL(($width - $text_width) / 2);
$centerX = $centerX<0 ? 0 : $centerX;
$centerY = CEIL(($height - $text_height) / 2);
$centerY = $centerY<0 ? 0 : $centerY;

imagecopyresampled($out, $jpeg, 0, 0, 0, 0, $width, $width, $width, $height);
imagecopyresampled($out, $png, 0, 0, 0, 0, $width, $height, $newwidth, $newheight);
imagealphablending($out,true);
imagettftext($out, $size, 0, $centerX, $centerY*0.09, $black, $font_path, $text);
//gambar, size, rotasi, x, y, watna, font, text

imagejpeg($out, 'out.jpg', 100);

?>
