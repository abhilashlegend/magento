<?php
class Abhi_Gallery_Model_Gallery extends Mage_Core_Model_Abstract implements JsonSerializable {
	public function _construct() {
		$this->_init('abhi_gallery/gallery');
	}

	public function jsonSerialize() {
		return [
			'id'				=>	$this->getId(),
			'file'				=>	$this->getFile(),
			'label'				=>	$this->getLabel(),
			'position'			=>	$this->getPosition(),
			'disabled'			=>	$this->getIsDisabled(),
			'label_default'		=>	$this->getLabel(),
			'position_default'	=>	$this->getIsDisabled(),
			'url'				=>	Mage::getBaseUrl( Mage_Core_Model_Store::								URL_TYPE_WEB ) . 'media/gallery/' . $this->getFile()					,
			'removed'			=>	0

		];
	}
}
?>