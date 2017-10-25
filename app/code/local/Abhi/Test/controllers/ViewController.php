<?php
	class Abhi_Test_ViewController extends Mage_Core_Controller_Front_Action {
		public function deleteAction() {
			$this->loadLayout();	/*This function read all layout files and loads 							  them in memory */
			$this->renderLayout();	/* This function processes and displays all layout 							   phtml and php files */

		}

	}

?>