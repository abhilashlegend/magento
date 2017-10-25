<?php
class MasteringMagento_Example_Block_Adminhtml_Event_Edit extends Mage_Adminhtml_Block_Widget_Form_Container {
	public function __construct() {
		$this->_objectId = 'event_id';
		$this->_blockGroup = 'example';
		$this->_controller = 'adminhtml_event';
		
		parent::__construct();	
	}
	
	public function getHeaderText() {
		return Mage::helper('example')->__('New Event');	
	}
	
	public function getSaveUrl() {
		return $this->getUrl('*/event/save', array('_current' => true));	
	}
}
?>