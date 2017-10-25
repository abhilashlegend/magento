<?php
class Bmg_CustomLogin_Block_Login extends Mage_Core_Block_Template {
	public function __construct() {	
			parent::__construct();
			$this->setTemplate('customlogin/login.phtml');	
		}
}
?>