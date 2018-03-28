<?php
error_reporting(0); 
header("content-type:image/jpeg");
mb_internal_encoding("UTF-8");
$name = $_REQUEST['name']?$_REQUEST['name']:"名称";
$id = $_REQUEST['id']?$_REQUEST['id']:"职位";
$xuanyan = $_REQUEST['xuanyan']?$_REQUEST['xuanyan']:"宣言";
$dst_path = 'image/subbg.jpg';
$member_path = $_REQUEST['photo']?$_REQUEST['photo']:"";;
$top_path = 'image/imgtop.png';
//创建图片的实例
$dst = imagecreatefromstring(file_get_contents($dst_path));
$member = imagecreatefromstring(file_get_contents($member_path));
$top = imagecreatefromstring(file_get_contents($top_path));
//获取水印图片的宽高

//list($member_w, $member_h) = getimagesize($member_path);
$member_w = 450;
$member_h = 450;
list($top_w, $top_h) = getimagesize($top_path);

//将水印图片复制到目标图片上，最后个参数50是设置透明度，这里实现半透明效果
//imagecopymerge($dst, $src, 100, 100, 0, 0, $src_w, $src_h, 100);

//如果水印图片本身带透明色，则使用imagecopy方法
imagecopy($dst, $member, 155, 245, 0, 0, $member_w, $member_h);
imagecopy($dst, $top, 100, 150, 0, 0, $top_w, $top_h);

$black = imagecolorallocate($dst, 500, 500, 500);
$black2 = imagecolorallocate($dst, 38, 244, 253);
$black3 = imagecolorallocate($dst, 106, 29, 255);
$text = $name;
$xid = '我是'.$id;
$font = './font/W-HYYaKuHeiW.ttf';
$font2 = './font/fzht.TTF';

imagettftext($dst, 38, 0, 180, 815, $black, $font2, $xid);
imagettftext($dst, 48, 0, 466, 815, $black, $font2, $text);
imagettftext($dst, 52, 0, 72, 1045, $black3, $font, $xuanyan);
imagettftext($dst, 52, 0, 69, 1042, $black2, $font, $xuanyan);

//输出图片
list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
switch ($dst_type) {
    case 1://GIF
        header('Content-Type: image/gif');
        imagegif($dst);
        break;
    case 2://JPG
        header('Content-Type: image/jpeg');
        imagejpeg($dst);
        break;
    case 3://PNG
        header('Content-Type: image/png');
        imagepng($dst);
        break;
    default:
        break;
}
imagedestroy($dst);
imagedestroy($member);
imagedestroy($top);

?>