<?php
	class Abhi_Test_Model_Mysql4_Test extends Mage_Core_Model_Mysql4_Abstract {
		public function _contruct() {
			$this->_init('test/test', 'test_id');	/*here test_id is the primary of the table test. And test/test, is the magento table name as mentioned in the config.xml */
		}

		public function loadByField($field, $value) {
			$table = $this->getMainTable();
			$where = $this->_getReadAdapter()->quoteInto("$field = ?", $value);
			$select = $this->_getReadAdapter()->select()->from($table, array('test_id'))->where($where);
			$id = $this->_getReadAdapter()->fetchOne($sql);
			return $id;
		}

	}
?>