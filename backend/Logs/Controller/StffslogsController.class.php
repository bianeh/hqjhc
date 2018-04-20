<?php
namespace Logs\Controller;
use \Common\Controllers\BaseController;
class stffslogsController extends BaseController{
	public function __construct()
	{
		parent::__construct();
	}
	/**
	 * 管理员登录日志表
	 */
	public function index()
	{
		$this->display();
	}
}