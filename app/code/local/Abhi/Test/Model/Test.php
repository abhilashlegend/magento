<?php
class Abhi_Test_Model_Test extends Mage_Core_Model_Abstract {
	public function _construct() {
		parent::_construct();
		$this->_init('test/test');	//This is location of the resource file
	}

	public function loadByField($field, $value) {
		$id = $this->getResource()->loadByField($field, $value);
		$this->load($id);
	}

	
}
?>