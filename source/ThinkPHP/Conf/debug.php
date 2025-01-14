<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2014 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

/**
 * ThinkPHP 默认的调试模式配置文件
 */
defined('THINK_PATH') or exit();
// 调试模式下面默认设置 可以在应用配置目录下重新定义 debug.php 覆盖
return  array(
/**
* 原生配置
*/
//    'LOG_RECORD'            =>  true,  // 进行日志记录
//    'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
//    'LOG_LEVEL'             =>  'EMERG,ALERT,CRIT,ERR,WARN,NOTIC,INFO,DEBUG,SQL',  // 允许记录的日志级别
//    'DB_FIELDS_CACHE'       =>  false, // 字段缓存信息
//    'DB_SQL_LOG'            =>  true, // 记录SQL信息
//    'TMPL_CACHE_ON'         =>  false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
//    'TMPL_STRIP_SPACE'      =>  false,       // 是否去除模板文件里面的html空格与换行
//    'SHOW_ERROR_MSG'        =>  true,    // 显示错误信息
//    'URL_CASE_INSENSITIVE'  =>  true,  // URL区分大小写
 
 
/**
* 以下为修改的配置
*/       
    'LOG_RECORD'            =>  false,  // 进行日志记录
    'LOG_EXCEPTION_RECORD'  =>  true,    // 是否记录异常信息日志
    'LOG_LEVEL'             =>  '',  // 允许记录的日志级别
    'DB_FIELDS_CACHE'       =>  false, // 字段缓存信息
    'DB_SQL_LOG'            =>  false, // 记录SQL信息
    'TMPL_CACHE_ON'         =>  false,        // 是否开启模板编译缓存,设为false则每次都会重新编译
    'TMPL_STRIP_SPACE'      =>  false,       // 是否去除模板文件里面的html空格与换行
    'SHOW_ERROR_MSG'        =>  true,    // 显示错误信息
    'URL_CASE_INSENSITIVE'  =>  true,  // URL区分大小写
    
/**
* 新增配置
*/
	'SHOW_RUN_TIME' => true,  //运行时间显示
	'SHOW_ADV_TIME' => true,  //显示详细的运行时间
	'SHOW_DB_TIMES' => true,  //显示数据库的操作次数
	'SHOW_CACHE_TIMES'=>true, //显示缓存操作次数
	'SHOW_USE_MEM' =>  true, //显示内存开销
);