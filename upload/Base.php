<?php
namespace App\Lib\Upload;
use App\Lib\Utils;
class Base{
	protected $array_key ;
	protected $request;
	protected $type;
	protected $clientMediaType;
	public function __construct($request){
		$this->request=$request;
		$file = $this->request->getSwooleRequest()->files;
		$types =  array_keys($file);
		$this->array_key = $types[0];
		$this->type=$file[$types[0]]['type'];
		// var_dump($this->type);
	}
	/**上传
	 * [upload description]
	 * @return [type] [description]
	 */
	public function upload(){
		
		$file = $this->request->getUploadedFile($this->array_key);
		// var_dump($file);
		$this->size=$file->getSize();
		$this->checkSize();
		$this->fileName = $file->getclientFileName();
		$this->clientMediaType = $file->getClientMediaType();
		$this->checkMediaType();
		$filename = $this->getFile($this->fileName);
		$flag =   $file->moveTo($filename);
		if(!empty($flag)){
			return $this->file;
		}
		return false;
	}
	/**
	 * [getFile 获取文件名]
	 * @param  [type] $this->fileName [description]
	 * @return [type]                 [description]
	 */
	protected function getFile($fileName){
		$pathinfo = pathinfo($fileName);
		$extension = $pathinfo["extension"];//后缀
		
		$dirname =  "/".$this->fileType."/".date("Y")."/".date("m")."/".date("d");
		$dir = EASYSWOOLE_ROOT . "/webroot" . $dirname ;
		if(!is_dir($dir)){
			mkdir($dir,0777,true);
		}
		$basename = "/" . Utils::getFileKey($pathinfo['filename']). "." . $extension;
		$this->file = $dirname . $basename ;
		return $dir.$basename;
		
	}
	
	/**
	 * 判断文件大小
	 */
	protected function checkSize(){
		if($this->size>$this->sizeMax){
			return false;
		}
	}
	/**
	 * [checkMediaType 判断文件格式]
	 * @return [type] [description]
	 */
	public function checkMediaType(){
		$clientMediaType = explode('/', $this->clientMediaType);
		$clientMediaType =  $clientMediaType[1] ?? "";
		if(empty($clientMediaType)){
			throw new \Exception("文件{$this->type}文件不合法");
		}
		if(!in_array($clientMediaType, $this->fileEtType)){
			throw new \Exception("文件{$this->type}文件不合法");
			
		}
		return true;
	}
} 
