<?php
/**
	* 
	*/
	class MasteringMagento_Example_Block_Adminhtml_Catalog_Product_Edit_Tab_Event extends Mage_Adminhtml_Block_Widget implements Mage_Adminhtml_Block_Widget_Tab_Interface
	{
		
		public function __construct()
		{
			parent::__construct();
			$this->setTemplate('example/product/edit/event.phtml');
		}

		public function getProduct() {
			return Mage::registry('current_product');
		}

		public function getTabLabel() {
			return Mage::helper('example')->__('Event Information');
		}

		/* Check if tab can be displayed */
		public function canShowTab() {
			return true;
		}

		/* Check if tab is hidden */
		public function isHidden() {
			return false;
		}

		/* Retreive add button HTML */
		public function getAddButtonHtml() {
			$addButton = $this->getLayout()->createBlock('adminhtml/widget_button')
			->setData(array(
				'label' => Mage::helper('example')->('Add New Ticket'),
				'id' 	=> 'add_ticket_item',
				'class'	=> 'add'
			));
			return $addButton->toHtml();
		}

		/* Return array of links */
		public function getTicketData() {
			$linkArr = array();
			$tickets = $this->getProduct()->getTypeInstance(true)->getTickets($this->getProduct());
			foreach ($tickets as $ticket) {
				$tmpTicketItem = array(
					'ticket_id'=>$ticket->getId(),
					'title'=>$this->escapeHtml($ticket->getTitle()),
					'price'=>$this->getPriceValue($ticket->getPrice()),
					'sort_order'=>$ticket->getSortOrder(),
				);
				$ticketArr[] = new Varien_Object($tmpTicketItem);
			}
			return $ticketArr;
		}

		/* Return formated price with two digits after decimal point */
		public function getPriceValue($value) {
			return number_format($value,2, null, '');
		}

	}	
?>