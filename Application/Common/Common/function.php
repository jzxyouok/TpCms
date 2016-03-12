<?php

function validateCode($width=80,$height=30,$font_size =20)
{
    //创建图片
    $im = imagecreate($width,$height);
    imagecolorallocate($im,rand(156,255),rand(156,255),rand(156,255)); //第一次对 imagecolorallocate() 的调用会给基于调色板的图像填充背景色
    $fontColor = imageColorAllocate ( $im, 000, 000, 000 );   //字体颜色
    $fontstyle = realpath('Public'). '/assets/fonts/Roboto Mono.ttf';   //字体样式，这个可以从c:\windows\Fonts\文件夹下找到，我把它放到和authcode.php文件同一个目录，这里可以替换其他的字体样式

    //产生随机字符
    $randFourStr='';
    for($i = 0; $i < 4; $i ++) {
        $randAsciiNumArray = array(rand(48,57),rand(65,90));
        $randAsciiNum = $randAsciiNumArray [rand ( 0, 1 )];
        $randStr = chr( $randAsciiNum );
        imagettftext($im,$font_size,rand(0,20)-rand(0,25),5+$i*20,rand(20,26),$fontColor,$fontstyle,$randStr);
        $randFourStr.= $randStr;
    }

    //保存验证码到$_SESSION
    session('verify_code', $randFourStr);

    //干扰线
    for ($i=0;$i<8;$i++){
        $lineColor = imagecolorallocate($im,rand(0,255),rand(0,255),rand(0,255));
        imageline ($im,rand(0,$width),0,rand(0,$width),$height,$lineColor);
    }
    //干扰点
    /*for ($i=0;$i<250;$i++){
        imagesetpixel($im,rand(0,$width),rand(0,$height),$fontColor);
    }*/
    header ( 'Content-type: image/png' );
    imagepng($im);
    imagedestroy($im);
}

// 检测输入的验证码是否正确，$code为用户输入的验证码字符串
function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}

function dd($var = '')
{
    $var = func_get_args();
    foreach($var as $item){
        dump($item);
    }
    exit;
}

function array_except($array , $unset = [])
{
    foreach($array as $k => $v){
        if(in_array($k,$unset)){
            unset($array[$k]);
        }
    }

    return $array;
}

function active()
{
    $params = func_get_args();
    $current_action = CONTROLLER_NAME.'_'.ACTION_NAME;
    $class = '';
    if(in_array($current_action,$params)){
        $class = 'active';
    }

    return $class;
}