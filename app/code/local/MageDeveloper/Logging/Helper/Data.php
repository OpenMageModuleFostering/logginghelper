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

class MageDeveloper_Logging_Helper_Data extends Mage_Core_Helper_Abstract
{
	/**
	 * Log Model
	 * @var MageDeveloper_Logging_Model_Log
	 */
	protected $_logModel;
	
	/**
	 * Dump Type
	 * @var int
	 */
	protected $_dumpType;
	
	/**
	 * Log Data
	 * @var mixed
	 */
	protected $_logData;
	
	/**
	 * Dump Types
	 * @var int
	 */
	const DUMP_TYPE_VAR_DUMP 	= 1;
	const DUMP_TYPE_PRINT_R		= 2;
	
	/**
	 * Constructor
	 */
	public function _construct()
	{
		$this->setPrintr();
		$this->_logData = null;
		$this->_logModel = Mage::getModel('logging/log');
	}
	
	/**
	 * Destructor
	 */
	public function _destruct()
	{
		$this->_logData = null;
	}
	
	/**
	 * Get OK Type
	 */
	public function getTypeOk()
	{
		return MageDeveloper_Logging_Model_Log::LOG_TYPE_OK;
	}
	
	/**
	 * Get INFO Type
	 */
	public function getTypeInfo()
	{
		return MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO;
	}
	
	/**
	 * Get WARNING Type
	 */
	public function getTypeWarning()
	{
		return MageDeveloper_Logging_Model_Log::LOG_TYPE_WARNING;
	}
	
	/**
	 * Get ERROR Type
	 */
	public function getTypeError()
	{
		return MageDeveloper_Logging_Model_Log::LOG_TYPE_ERROR;
	}
	
	/**
	 * Get TIME Type
	 */
	public function getTypeTime()
	{
		return MageDeveloper_Logging_Model_Log::LOG_TYPE_TIME;
	}
	
	/**
	 * Set OK Type
	 * 
	 * @return self
	 */
	public function setTypeOk()
	{
		$this->setType( $this->getTypeOk() );
		return $this;
	}
	
	/**
	 * Set INFO Type
	 * 
	 * @return self
	 */
	public function setTypeInfo()
	{
		$this->setType( $this->getTypeInfo() );
		return $this;
	}	
	
	/**
	 * Set WARNING Type
	 * 
	 * @return self
	 */
	public function setTypeWarning()
	{
		$this->setType( $this->getTypeWarning() );
		return $this;
	}
	
	/**
	 * Set ERROR Type
	 * 
	 * @return self
	 */
	public function setTypeError()
	{
		$this->setType( $this->getTypeError() );
		return $this;
	}
	
	/**
	 * Set TIME Type
	 * 
	 * @return self
	 */
	public function setTypeTime()
	{
		$this->setType( $this->getTypeTime() );
		return $this;
	}
	
	/**
	 * Get the model for a log entry
	 * 
	 * @return MageDeveloper_Logging_Model_Log
	 */
	public function getLog()
	{
		if (!$this->_logModel) {
			$this->_logModel = Mage::getModel('logging/log');
		}
		return $this->_logModel;
	}
	
	/**
	 * Set the log type
	 * 
	 * @param int $type Log Type
	 * @return self
	 */
	public function setType($type = MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO)
	{
		$this->getLog()
			 ->setLogType($type);
		
		return $this;
	}
	
	/**
	 * Set the dump type to var_dump
	 * 
	 * @return self
	 */
	public function setVardump()
	{
		$this->_dumpType = self::DUMP_TYPE_VAR_DUMP;
		return $this;
	}
	
	/**
	 * Set the dump type to print_r
	 * 
	 * @return self
	 */
	public function setPrintr()
	{
		$this->_dumpType = self::DUMP_TYPE_PRINT_R;
		return $this;
	}
	
	/**
	 * Set the log data content
	 * 
	 * @param mixed $logdata Data to log
	 * @return self
	 */
	public function setData($logdata)
	{
		$this->_logData = $logdata;
		return $this;
	}
	
	/**
	 * Get the current set log data
	 * 
	 * @return string
	 */
	public function getData()
	{
		return $this->_logData;
	}
	
	/**
	 * Dump data
	 * 
	 * @param mixed $data Data to Dump
	 * @return void
	 */
	private function _dump($data)
	{
		$type = $this->getDumpType();
		
		switch ($type) {
			case self::DUMP_TYPE_VAR_DUMP:
				return $this->_vardump($data);
			case self::DUMP_TYPE_PRINT_R:
			default;
				return $this->_printr($data);
		}
	}
	
	/**
	 * Set a dump type
	 * 
	 * @param int $type Dump Type
	 * @return self
	 */
	public function setDumpType($type)
	{
		switch ($type) {
			case self::DUMP_TYPE_VAR_DUMP:
				$this->setVardump();
				break;
			case self::DUMP_TYPE_PRINT_R:
			default;
				$this->setPrintr();
				
		}
		return $this;
	}
	
	/**
	 * Get the actual dump type
	 * 
	 * @return int
	 */
	public function getDumpType()
	{
		return $this->_dumpType;
	}
	
	/**
	 * Set a message instead of data
	 * 
	 * @param string $message Message to log
	 * @return self
	 */
	public function setMessage($message)
	{
		$this->setData($message);
		return $this;
	}
	
	/**
	 * Creates an print_r of the given data
	 * and puts it into variable for return
	 * 
	 * @param multi $data
	 * @return print_r string
	 */
	private function _printr($data)
	{
		ob_start();
		print_r($data);
		$vars = ob_get_contents();
		ob_end_clean();
		
		return $vars;
	}		
	
	/**
	 * Creates an var_dump of the given data
	 * and puts it into variable for return
	 * 
	 * @param multi $data
	 * @return var_dump string
	 */
	private function _vardump($data)
	{
		ob_start();
		var_dump($data);
		$vars = ob_get_contents();
		ob_end_clean();
		
		return $vars;
	}	
	
	/**
	 * Creates an formated backtrace string
	 * 
	 * @return string
	 */
	private function _trace()
	{
		$backtrace 		= debug_backtrace();
		$traceStr 		= '';
		
		if ($backtrace) {
			$i = count($backtrace); 
			foreach ($backtrace as $_key=>$_trace) {
				if (array_key_exists('class', $_trace)) {
					$traceStr .= '#'.$i.'  '.$_trace['class'].'::'.$_trace['function']."\r\n";
					$i--;
				}
			}
		}
		return $traceStr;
	}
	
	/**
	 * Log a timestamp
	 * 
	 * @return self
	 */
	public function time()
	{
		$this->setPrintr();
		$this->setTypeTime();
		
		$timeStr = Mage::helper('logging/log')->udate('H:i:s.u');
		
		$message = '';
		if (!$this->getData()) {
			$message = $timeStr;
		} else {
			$message = $this->getData().' @ '.$timeStr;
		}
		
		$this->setMessage($message);
		
		return $this;
	}
	
	/**
	 * Create log entry
	 */
	public function log()
	{
		$dumped = $this->_dump($this->_logData);
		
		$this->getLog()
			 ->setOutput(htmlentities($dumped));		
		
		// backtrace
		$backtrace 	= debug_backtrace();
		
		// last usable backtrace
		$trace 		= reset($backtrace);
		$trace 		= next($backtrace);

		// Class
		if (array_key_exists('class', $trace)) {
			$this->getLog()
				 ->setClass($trace['class']);
		}
		
		// Method
		if (array_key_exists('function', $trace)) {
			
			$function = $trace['function'];
			
			if ($function == 'include' || $function == 'require') {
				$method = reset($trace['args']);
			} else {
				$method = $function;
			}
			
			$this->getLog()
				 ->setMethod($method);
		}
		
		// Data for Backtrace
		$this->getLog()
			 ->setTrace( $this->_trace()  );
		
		
		$errors = $this->getLog()->validate();

		if (!is_array($errors)) {

			try {
				
				// Set log timestamp to now 
				$timestamp = Mage::getModel('core/date')->timestamp( time() );
				$this->getLog()->setTimestamp( $timestamp );
				
				// Try to save log entry
				$this->getLog()->save();
				
				$id = $this->getLog()->getId();
				
				if ($id) {
					
					// Check if info mail has to be sent
					if (Mage::helper('logging/config')->isAllowedToSendMail($this->getLog()->getLogType())) {
						$this->getLog()->sendLogMail();						
					}
					
					$this->_logModel->unsetData();
					return $id;
				}
				
			} catch (Exception $e) {
				Mage::throwException( Mage::helper('logging')->__('Could not save log: %s', $e->getMessage()) );
			}
		}
		return false;
	}
}
