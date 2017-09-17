<?php
namespace Admin\Controller;
use Think\Controller;
use Common\Controller\AuthController;
use Think\Auth;

class StaffController extends AuthController {

	protected $staff;

	public function __construct() {
		parent::__construct();
		$this->staff = M('staff');
	}
}