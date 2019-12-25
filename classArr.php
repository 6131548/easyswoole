<?php
//反射机制
namespace App\Lib;

/*
反射机制
 */
class  ClassArr {
	/**
	 * [uploadClassStat d反射机制中的类]
	 * @return [type] [description]
	 */
	public function uploadClassStat(){
		return [
			'video' =>'App\Lib\Upload\Video',
			'image' =>'App\Lib\Upload\Image',
			'txt' =>'App\Lib\Upload\TXT',
		];
	}
	/**
	 * [initClass 反射机制返回]
	 * @param  [type]  $type           [description]
	 * @param  [type]  $supportedClass [实现的类的数组]
	 * @param  array   $pram           [传递的参数]
	 * @param  boolean $needInstance   [是否需要静态类]
	 * @return [type]                  [description]
	 */
	public function initClass($type,$supportedClass,$pram=[],$needInstance=true){
		if(!array_key_exists($type, $supportedClass)){
			return false ;
		}
		$className = $supportedClass[$type];
		return $needInstance ? (new \ReflectionClass($className))->newInstanceArgs($pram) : $className;
	}
}
