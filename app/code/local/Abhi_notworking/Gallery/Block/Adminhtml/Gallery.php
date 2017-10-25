<?php
class Abhi_Gallery_Block_Adminhtml_Gallery
	extends Mage_Adminhtml_Block_Widget
	implements Mage_Adminhtml_Block_Widget_Tab_Interface {
	protected $_uploaderType = 'uploader/multiple';
 
	public function __construct() {
		parent::__construct();
		$this->setShowGlobalIcon( true );
		Mage_Adminhtml_Block_Template::__construct();
		$this->setTemplate( 'abhi/gallery.phtml' );
	}
 
	protected function _prepareLayout() {
		$this->setChild( 'uploader',
			$this->getLayout()->createBlock( $this->_uploaderType )
		);s
 
		$this->getUploader()->getUploaderConfig()
		     ->setFileParameterName( 'image' )
		     ->setTarget( Mage::getModel( 'adminhtml/url' )->addSessionParam()->getUrl( '*/cms_page/upload' ) );
 
		$browseConfig = $this->getUploader()->getButtonConfig();
		$browseConfig
			->setAttributes( array(
				'accept' => $browseConfig->getMimeTypesByExtensions( 'gif, png, jpeg, jpg' )
			) );
 
		return Mage_Adminhtml_Block_Template::_prepareLayout();
	}
 
	public function getUploader() {
		return $this->getChild( 'uploader' );
	}
 
	public function getUploaderHtml() {
		return $this->getChildHtml( 'uploader' );
	}
 
	public function getHtmlId() {
		return 'media_gallery_content';
	}
 
	public function getGallery() {

		return Mage::getModel( 'abhi_gallery/gallery' )->getCollection()
		           ->addFieldToFilter( 'cms_page_id', array( 'eq' => $this->getRequest()->getParam( 'page_id' ) ) );
 
	}
 
	public function getImageTypes() {
		return array( 'image' => [ 'label' => 'Base Image', 'field' => 'post[image]' ] );
	}
 
	public function getImageTypesJson() {
		return Mage::helper( 'core' )->jsonEncode( $this->getImageTypes() );
	}
 
	public function getJsObjectName() {
		return 'media_gallery_contentJsObject';
	}
 
	public function getImagesJson() {
 
		$jsonFiles = '';
		$gallery   = $this->getGallery();
		foreach ( $gallery as $images ) {
			$jsonFiles = $jsonFiles . ',' . json_encode( $images );
		}
 
		return '[' . trim( $jsonFiles, ',' ) . ']';
	}
 
	/**
	 * Prepare label for tab
	 *
	 * @return string
	 */
	public function getTabLabel() {
		return Mage::helper( 'cms' )->__( 'Gallery' );
	}
 
	/**
	 * Prepare title for tab
	 *
	 * @return string
	 */
	public function getTabTitle() {
		return Mage::helper( 'cms' )->__( 'Gallery' );
	}
 
	/**
	 * Returns status flag about this tab can be showen or not
	 *
	 * @return true
	 */
	public function canShowTab() {
		return true;
	}
 
	/**
	 * Returns status flag about this tab hidden or not
	 *
	 * @return true
	 */
	public function isHidden() {
		return false;
	}
 
	/**
	 * Check permission for passed action
	 *
	 * @param string $action
	 *
	 * @return bool
	 */
	protected function _isAllowedAction( $action ) {
		return true;
	}
 
}