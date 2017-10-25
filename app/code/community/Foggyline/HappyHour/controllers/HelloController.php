<?php
	class Foggyline_HappyHour_HelloController extends Mage_Core_Controller_Front_Action {
			public function helloWorldAction() {
				$this->loadLayout();
				$block = $this->getLayout()->createBlock('foggyline_happyhour/hello');
				$block->setText('Hello World #2');
				$this->getLayout()->getBlock('content')->insert($block);
				$this->renderLayout();
			}

			public function testUserSaveAction() {
				$user = Mage::getModel('foggyline_happyhour/user');
				$user->setFirstname('John');
				$user->setLastname('Doe');
				try {
					$user->save();
					echo 'Successfully saved user';
				} catch(Exception $e) {
					echo $e->getMessage();
					Mage::logException($e);
				}
			}

			public function testUserCollectionAction() {
				$users = Mage::getModel('foggyline_happyhour/user')->getCollection();

				foreach($users as $user) {
					$firstname = $user->getFirstname();
					$lastname = $user->getLastname();
					echo $firstname . ' ' . $lastname .  "<br />";
				}
			}

			public function helperTestAction() {
				echo Mage::helper('foggyline_happyhour')->getCustomMessage();
			}

	}
	
?>