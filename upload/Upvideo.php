<?php
namespace App\HttpController\Api;
use App\HttpController\Base;
use App\Lib\Upload\Video as VideoClass;
use App\Lib\Upload\Image as ImageClass;
/**
 * 视频上传
 */
class Upvideo extends Base
{
    /**
     * [videoUpload 视频上传]
     * @return [type] [description]
     */
    public function videoUpload(){
        $request = $this->Request();
        
        try {
            $file = new VideoClass($request);
            $file = $file->upload();
        } catch (\Exception $e) {
            return $this->writeJson(400,$e->getMessage(),[]);
        }
        if(empty($file)){
            return $this->writeJson(400,"上传失败",[]);
        }
        $data =[
                'url'=>$file
            ];
        return $this->writeJson(200,"上传成功",$data);

    }
    /**
     * [imageUpload 图片上传]
     * @return [type] [description]
     */
    public function imageUpload(){
        $request = $this->Request();
        
        try {
            $file = new ImageClass($request);
            $file = $file->upload();
        } catch (\Exception $e) {
            return $this->writeJson(400,$e->getMessage(),[]);
        }
        if(empty($file)){
            return $this->writeJson(400,"上传失败",[]);
        }
        $data =[
                'url'=>$file
            ];
        return $this->writeJson(200,"上传成功",$data);

    }
}
