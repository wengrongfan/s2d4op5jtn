<?php
namespace Common\Controller;
use Think\Controller;

class CommonController extends Controller{
	
    public function _empty(){
		$this->error('此操作无效');
    }

    /**
     * *删除文件
     * @return Boolean          [description]
     */
    public function unlink($Path)
    {
        $Path="./Public/".$Path;
        if(file_exists($Path))
        {
            $result = unlink($Path);
            if($result)
            {
                return TRUE;
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return TRUE;        
        }
    }

    /**
     * *生成缩略图
     * @return Boolean          [description]
     */
    public function createThumb($path, $width = '', $height = '')
    {
        $image = new \Think\Image();
        $image->open($path);
        if(empty($width) && empty($height))
        {
            $image->thumb(C('SOFT_THUMB_WIDTH'), C('SOFT_THUMB_HEIGHT'), $image::IMAGE_THUMB_FIXED);
        }
        else
        {
            $image->thumb($width, $height, $image::IMAGE_THUMB_FIXED);
        }
        $image->save($path);
        return $path;
    }
}