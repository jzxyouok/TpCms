<?php
namespace Admin\Controller;

class UploadController extends CommonController
{
    // 允许的图片类型
    protected $imageAllowType = array('gif', 'jpg', 'jpeg', 'png', 'bmp');
    // 允许的图片大小, 3M
    protected $imageAllowSize = 3145728;

    public function encode()
    {
        $file = base64_decode(I('post.file'));

        // 类型判断
        $fileType = explode('/', getimagesizefromstring($file)['mime']);

        if (empty($fileType) || $fileType['0'] != 'image' || !in_array($fileType[1], $this->imageAllowType)) {
            $this->ajaxReturn([
                'state' => 0,
                'message' => '只允许上传以下格式的图片: '.implode(', ', $this->imageAllowType),
            ]);
        }

        // 大小判断
        if (strlen($file) > $this->imageAllowSize) {
            $this->ajaxReturn([
                'state' => 0,
                'message' => '图片不能大于'.$this->imageAllowSize,
            ]);
        }

        //取得自定义的上传目录
        $type = I('post.type','avatar');

        //根据传过来的type决定上传路径
        $basePath = PUBLIC_PATH.'/upload';

        //根据日期划分子目录
        $dataPath = explode('-',date('Y-m-d'));

        $subPath = "/".$type."/".$dataPath['0']."/".$dataPath['1']."/".$dataPath['2']."/";

        //最终路径
        $path = $basePath.$subPath;

        //判断目录是否存在，不存在则创建
        if(!is_dir($path)){
            mkdir($path , 0777 , true);
        }

        //文件后缀
        $extension = $fileType[1];

        $fileName = md5($file).'.'.$extension;

        //最终文件
        $image = $path.$fileName;

        //上传完返回图片相对于public目录路径供保存到数据库
        $returnPath = '/Public/upload'.$subPath.$fileName;

        if($res = file_put_contents($image,$file)){
            $this->ajaxReturn([
                'state' => 1,
                'path' => $returnPath
            ]);
        }

        $this->ajaxReturn([
            'state' => 0,
            'path' => '上传失败'
        ]);
    }
}