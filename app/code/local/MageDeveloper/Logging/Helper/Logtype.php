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

class MageDeveloper_Logging_Helper_Logtype extends MageDeveloper_Logging_Helper_Style
{
	public function _construct()
	{
		parent::_construct();
	}
	
	/**
	 * Get the log type string by
	 * a given log type
	 * 
	 * @param int $logType Type of the log
	 * @return string Log Type String
	 */
	public function getLogTypeString($logType)
	{
		switch ($logType) {
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_OK:
				return Mage::helper('logging')->__('OK');
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO:
				return Mage::helper('logging')->__('INFO');
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_WARNING:
				return Mage::helper('logging')->__('WARNING');
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_ERROR:
				return Mage::helper('logging')->__('ERROR');
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_NOT_SET:
			default:
				return '';
		}
	}
	
	/**
	 * Get the complete log type style from
	 * a given log type
	 * 
	 * @param int $logType Type of the log
	 * @return string html
	 */
	public function getLogTypeStyle($logType) 
	{
		$string = $this->getLogTypeString($logType);
		$this->setLogTypeStyles($logType);
		
		return $this->getStyledContent($string);
	}
	
	/**
	 * Prepare the log type styles
	 * by a given log type
	 * 
	 * @param int $logType Log Type
	 * @return void
	 */
	public function setLogTypeStyles($logType)
	{
		// General Styles
		$this->setStyle('font-weight', 'bold');
		$this->setStyle('margin', '2px');
		$this->setStyle('padding', '2px');		
		$this->setStyle('text-align', 'center');
		
		switch ($logType) {
			
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_OK:
				$this->setStyle('background-color', '#c1ffcf');
				$this->setStyle('color', '#197a52');
				$this->setStyle('border', '1px solid #197a52');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO:
				$this->setStyle('background-color', '#bdf7ff');
				$this->setStyle('color', '#1598cf');
				$this->setStyle('border', '1px solid #1598cf');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_WARNING:
				$this->setStyle('background-color', '#feffc1');
				$this->setStyle('color', '#cea915');
				$this->setStyle('border', '1px solid #cea915');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_ERROR:
				$this->setStyle('background-color', '#ffc5bd');
				$this->setStyle('color', '#cf1515');
				$this->setStyle('border', '1px solid #cf1515');
				break;

			case MageDeveloper_Logging_Model_Log::LOG_TYPE_NOT_SET:
			default:
				$this->setStyle('background-color', 'transparent');
				$this->setStyle('color', '#000000');
		}
		return;
	}

}
	