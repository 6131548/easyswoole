<?php 
namespace App\Lib\Upload;
use App\Lib\Upload\Base;
 class Video extends Base{
 	/**
 	 * [$fileType 文件类型]
 	 * @var string
 	 */
 	public $fileType = "video";
 	/**
 	 * [$sizeMax 文件大小]
 	 * @var [type]
 	 */
 	public $sizeMax = 20*1024;
 	/**
 	 * [$fileEtType 文件后缀]
 	 * @var [type]
 	 */
 	public $fileEtType=[
// 			 'mp4',
 			'x-flx'
 		];
 		
 }
