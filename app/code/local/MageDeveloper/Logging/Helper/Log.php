<?php
/**
 * MageDeveloper Logging Module
 * ----------------------------
 *
 * @category    Mage
 * @package     MageDeveloper_Logging
 * @copyright   Magento Developers / magedeveloper.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

class MageDeveloper_Logging_Helper_Log extends Mage_Core_Helper_Abstract
{

	/**
	 * Get the next found log entry id
	 * 
	 * @param int $logId
	 * @return int next log id
	 */
	public function getNextLogId($logId)
	{
		$select = $this->_getConnection()->select()
										 ->from( $this->getLogEntityTableName() )
										 ->where('entity_id > ?', $logId)
										 ->limit(1);
		
		$result = $this->_getConnection()->fetchRow($select);
		
		if (array_key_exists('entity_id', $result)) {
			return (int)$result['entity_id'];
		}
		return false;
	}	
	
	/**
	 * Get the previous found log entry id
	 * 
	 * @param int $logId
	 * @return int previous log id
	 */
	public function getPreviousLogId($logId)
	{
		$select = $this->_getConnection()->select()
										 ->from( $this->getLogEntityTableName() )
										 ->where('entity_id < ?', $logId)
										 ->order('entity_id DESC')
										 ->limit(1);
		
		$result = $this->_getConnection()->fetchRow($select);
		
		if (array_key_exists('entity_id', $result)) {
			return (int)$result['entity_id'];
		}
		return false;
	}
	
	/**
	 * Get Log Entity Table Name
	 */
	public function getLogEntityTableName()
	{
		return $this->_getTableName('log_entity');
	}
	
	
	/**
	 * Get Table Name
	 */
	private function _getTableName($table)
	{
		return $this->_getResource()->getTableName($table);
	}
	
	/**
	 * Get database resource
	 */
	private function _getResource()
	{
		return Mage::getSingleton('core/resource');
	}
	
	/**
	 * Get database read connection
	 */
	private function _getConnection()
	{
		return $this->_getResource()->getConnection('core_read');
	}	
}
