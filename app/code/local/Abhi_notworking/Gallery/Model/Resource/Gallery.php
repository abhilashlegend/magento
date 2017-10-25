<?php
class Abhi_Gallery_Model_Resource_Gallery extends Mage_Core_Model_Resource_Db_Abstract {
	public function _construct() {
		$this->_init('abhi_gallery/gallery','id');
	}
}
?>''