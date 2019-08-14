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

class MageDeveloper_Logging_Model_Mysql4_Log_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('logging/log');
    }
	
	/**
	 * Add start and enddate to the filter
	 * 
	 * @param string $startdate Startdate to filter
	 * @param string $enddate Enddate to filter
	 * @return self
	 */	
	public function addDateToFilter($startdate, $enddate = null)
	{
		// Handling start date
		$dateStart = date('Y-m-d' . ' 00:00:00', $startdate);
		$this->addFieldToFilter('timestamp', array(array(
				array('date' => true, 'from' => $dateStart),
				array('null' => true)
			), 'left')
		);
		
		// Handling possible end date
		if ($enddate !== null) {
			
			$dateEnd = date('Y-m-d' . ' 23:59:59', $enddate);
			$this->addFieldToFilter('timestamp', array(array(
					array('date' => true, 'to' => $enddate),
					array('null' => true)
				), 'left')
			);
		}
		return $this;
	}
	
	/**
	 * Add time filter for today
	 * 
	 * @return self
	 */
	public function addTodayFilter()
	{
		$currentTimestamp = Mage::helper('logging/log')->now();
		
		$this->addDateToFilter($currentTimestamp, $currentTimestamp);
		return $this;
	}
	
}