<?php
	class MasteringMagento_Example_Block_Welcome extends Mage_Core_Block_Template {
		public function __contruct() {
			parent::__contruct();
			$this->setTemplate('example/welcome.phtml');	
		}
	}

?>