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

class MageDeveloper_Logging_Model_Log extends Mage_Core_Model_Abstract
{
	const LOG_TYPE_NOT_SET	= 0;
	const LOG_TYPE_OK		= 1;
	const LOG_TYPE_INFO		= 2;
	const LOG_TYPE_WARNING	= 3;
	const LOG_TYPE_ERROR	= 4;
	
	/**
	 * _construct
	 * Constructor
	 */
    public function _construct()
    {
        parent::_construct();
        $this->_init('logging/log');
    }
	
	/**
	 * Validate the log entry data and
	 * return errors if occured
	 * 
	 * @return array|bool
	 */
	public function validate()
	{
        $errors = array();
        if (!Zend_Validate::is( trim($this->getOutput()) , 'NotEmpty')) {
            $errors[] = Mage::helper('logging')->__('The log data cannot be empty.');
        }

        if (empty($errors)) {
            return true;
        }
        return $errors;
	}
	
	
}
