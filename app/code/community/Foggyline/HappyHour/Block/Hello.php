<?php
	/**
	* 
	*/
	class Foggyline_HappyHour_Block_Hello extends Mage_Core_Block_Template
	{
		public function __construct() {
			parent::__construct();
			$this->setTemplate('foggyline_happyhour/hello.phtml');
		}
	}
?>