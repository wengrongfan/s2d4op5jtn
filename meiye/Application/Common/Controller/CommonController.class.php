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
    public function createThumb($path)
    {
        if($path == '')
        {
            return FALSE;
        }

        $image = new \Think\Image();
        $image->open($path);
        $image->thumb(C('SOFT_THUMB_WIDTH') , C('SOFT_THUMB_HEIGHT') , $image::IMAGE_THUMB_FIXED);
        $image->save($path);
        return $path;
    }
}