<?php
require_once Mage::getModuleDir( 'controllers', 'Mage_Adminhtml' ) . DS . 'Cms' . DS . 'PageController.php';
 
class Abhi_Gallery_Adminhtml_Rewrite_Cms_PageController extends Mage_Adminhtml_Cms_PageController {
 
	public function saveAction(){
	//Add this code after $model->save
 
				$request    = $this->getRequest()->getPost();
				$formImages = json_decode( $request['post']['media_gallery']['images'] );
 
				foreach ( $formImages as $galleryImage ) {
 
					//if new image is uploaded
					if ( ! isset( $galleryImage->id ) ) {
 
						if ( $galleryImage->removed == 1 ) {
							$filePath = Mage::getBaseDir( 'media' ) . DS . 'gallery' . DS . $galleryImage->file;
							if ( file_exists( $filePath ) ) {
								unlink( $filePath );
							}
 
						} else {
							$galleryModel = Mage::getModel( 'abhi_gallery/gallery' );
 
							$galleryModel->setCmsPageId( $model->getId() );
							$galleryModel->setFile( $galleryImage->file );
							$galleryModel->setPosition( $galleryImage->position );
							$galleryModel->setLabel( $galleryImage->label );
							$galleryModel->setIsDisabled( $galleryImage->disabled );
 
							$galleryModel->save();
						}
 
					}
 
					if ( isset( $galleryImage->id ) ) {
						if ( $galleryImage->removed == 1 ) {
							$filePath = Mage::getBaseDir( 'media' ) . DS . 'gallery' . DS . $galleryImage->file;
 
							$galleryModel = Mage::getModel( 'abhi_gallery/gallery' );
							$galleryModel->setId( $galleryImage->id );
							$galleryModel->delete();
 
							if ( file_exists( $filePath ) ) {
								unlink( $filePath );
							}
 
						} else {
 
							$isModified = false;
 
							if ( $galleryImage->label_default != $galleryImage->label ) {
								$isModified = true;
							}
 
							if ( $galleryImage->position_default != $galleryImage->position ) {
								$isModified = true;
							}
 
							if ( $galleryImage->disabled_default != $galleryImage->disabled ) {
								$isModified = true;
							}
 
							if ( $isModified ) {
								$galleryModel = Mage::getModel( 'abhi_gallery/gallery' );
								$galleryModel->setId( $galleryImage->id );
								$galleryModel->setPosition( $galleryImage->position );
								$galleryModel->setIsDisabled( $galleryImage->disabled );
								$galleryModel->setLabel( $galleryImage->label );
 
								$galleryModel->save();
 
							}
						}
 
					}
 
				}
 
	//other code
       }
	public function uploadAction() {
		try {
			$uploader = new Varien_File_Uploader( 'image' );
			$uploader->setAllowedExtensions( array( 'jpg', 'jpeg', 'gif', 'png' ) );
			$uploader->setAllowRenameFiles( true );
			$uploader->setFilesDispersion( false );
			$path   = Mage::getBaseDir( 'media' ) . DS . 'gallery';
			$result = $uploader->save( $path );
			/**
			 * Workaround for prototype 1.7 methods "isJSON", "evalJSON" on Windows OS
			 */
			$result['tmp_name'] = str_replace( DS, "/", $result['tmp_name'] );
			$result['path']     = str_replace( DS, "/", $result['path'] );
 
			$result['url']    = Mage::getBaseUrl( Mage_Core_Model_Store::URL_TYPE_WEB ) . 'media/gallery/' . $result['name'];
			$result['cookie'] = array(
				'name'     => session_name(),
				'value'    => $this->_getSession()->getSessionId(),
				'lifetime' => $this->_getSession()->getCookieLifetime(),
				'path'     => $this->_getSession()->getCookiePath(),
				'domain'   => $this->_getSession()->getCookieDomain()
			);
 
		} catch ( Exception $e ) {
			$result = array(
				'error'     => $e->getMessage(),
				'errorcode' => $e->getCode()
			);
		}
		$this->getResponse()->setBody( Mage::helper( 'core' )->jsonEncode( $result ) );
	}
 
}