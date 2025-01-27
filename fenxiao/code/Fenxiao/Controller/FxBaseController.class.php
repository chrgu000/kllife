<?php

namespace Fenxiao\Controller;
use Think\Controller;
use Core\Model\ModelBase;
use Core\Model\MyHelp;
use Core\Model\BackAccountHelp;

define('UNLOGIN_URL', U('user/login', array('forward'=>base64_encode($_SERVER['REQUEST_URI']))));

abstract class FxBaseController extends Controller {
	
	// 当前页面标题
	protected $page_title = "";
	// 当前激活的菜单
	protected $menu_active = "";
	// 当前激活的菜单项
	protected $menu_current = "";	
	// 目录链接
	protected $menu_link = array();
	
	// 设置当前菜单链接
	protected function _setMenuLinkCurrent($menuText, $menuPage) {
		$this->menu_current = $menuPage;
		$this->menu_link = array(
			'f' => array(
				'mt'	=> '首页', 
				'lk'	=> C('TMPL_PARSE_STRING.{__GLOBAL_APPLICATION_URL__}')
			),
			's'	=> array(
				'mt'	=> $this->page_title, 
				'lk'	=> U(CONTROLLER_NAME)//C('TMPL_PARSE_STRING.{__GLOBAL_APPLICATION_URL__}').'/'.CONTROLLER_NAME
			),
			't'	=> array(
				'mt'	=> $menuText, 
				'lk'	=> C('TMPL_PARSE_STRING.{__GLOBAL_HOST_URL__}').U(CONTROLLER_NAME.'/'.$menuPage)
			)
		);
	}
	
	// 初始化模板显示的相关信息
	protected function _initTemplateInfo() {
		// 用户登录信息				
		$user = MyHelp::getLoginAccount(false);
		if (is_error($user) === false) {
			// 刷新数据库最新数据
			$user = BackAccountHelp::getAccount('account_distribute', appendLogicExp('id', '=', $user['id']));
			if (!empty($user['phone']) && strlen($user['phone']) == 11) {
				$user['phone_show'] = substr($user['phone'], 0, '3').'****'.substr($user['phone'], 7);
			}
			$this->assign('user', $user);	
		}	
		
		// 设置页面随机码
		$rd = substr(uniqid(rand()), -6);
		session_start();
		session('page_rand', $rd);
		$this->assign('pagerd', $rd);
					
		C('PAGE_TITLE', $this->page_title);
		C('MENU_ACTIVE', $this->menu_active);
		C('MENU_CURRENT', $this->menu_current);
		C('MENU_LINK', $this->menu_link);
	}
	
	// 显示页面
	protected function showPage($page, $curMenu='', $rootMenu='', $pageTitle='', $contentTile='', $contentDesc='') {
		if (!empty($curMenu)) {
			$this->menu_current = $curMenu;
		}
		if (!empty($rootMenu)) {
			$this->menu_active = $rootMenu;
		}
		if (!empty($pageTitle)) {
			$this->page_title = $pageTitle;
		}
		if (!empty($contentTile)) {
			$this->content_title = $contentTile;
		}
		if (!empty($contentDesc)) {
			$this->content_des = $contentDesc;
		}
		$this->_initTemplateInfo();		
		return $this->display($page);
	}
	
	// 显示错误页面
	protected function showError($errno, $title, $content, $reason, $suggest='您可以点击返回到上一步的操作，或是回到首页') {
		$err = errorPage($errno, $title, $content, $reason, $suggest);
		$this->assign('err', $err);
		$this->showPage('Common/error',C('MENU_CURRENT'),C('MENU_ACTIVE'),'错误'.C('PAGE_TITLE'),C('CONTENT_TITLE'),C('CONTENT_DESC'));
	}
}

?>