<?php
	class Abhi_Gallery_Model_Resource_Gallery_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract {
		public function _construct() {
			$this->_init('abhi_gallery/gallery');
		}
	}
?>