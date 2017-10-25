<?php
	$installer = $this;
	$installer->startSetup();
	
	$table = $installer->getConnection()
					   ->newTable($installer->getTable('abhi_gallery/gallery'))
					   ->addColumn('id', Varien_Db_Dbl_Table::TYPE_INTEGER, null,
								array(
									'identity' => true,
									'unsigned' => true,
									'nullable' => false,
									'primary'  => true,
								), 'Value id')
					   ->addColumn('cms_page_id', Varien_Db_Dbl_Table::TYPE_INTEGER, null, array(
					   				'nullable'	=> false,
					   			), 'Cms page id')
					   ->addColumn('position', Varien_Db_Dbl_Table::TYPE_INTEGER, null
								array(
									'unsigned'	=> true,
									'nullable'	=> true,
								), 'Position')
					   ->addColumn('file', Varien_Db_Dbl_Table::TYPE_INTEGER, 255, array(
					   			'nullable'	=> false,
					   			), 'File Name')
					    ->addColumn( 'label', Varien_Db_Ddl_Table::TYPE_VARCHAR, 255,
	                   array(
		                   'nullable' => true,
	                   ), 'Label' )
                   ->addColumn( 'is_disabled', Varien_Db_Ddl_Table::TYPE_BOOLEAN, null,
	                   array(
		                   'nullable' => true,
	                   ), 'Is Disabled' );
 
 $installer->getConnection()->createTable( $table );
 
$installer->getConnection()->addForeignKey(
	$installer->getFkName(
		'abhi_gallery/gallery',
		'cms_page_id',
		'cms/page',
		'page_id'
	),
	$installer->getTable( 'abhi_gallery/gallery' ),
	'cms_page_id',
	$installer->getTable( 'cms/page' ),
	'page_id'
);
$installer->endSetup();
?>