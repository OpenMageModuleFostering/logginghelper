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
	const LOG_TYPE_TIME		= 5;
	
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
	
	/**
	 * Get the log type html code
	 * 
	 * @return string HTML Code
	 */
	public function getLogTypeHtml()
	{
		$type = $this->getLogType();
		$helper = Mage::helper('logging/logtype');
		return $helper->getLogTypeStyle($type);
	}
	
	/**
	 * Send an information mail about the log contents
	 * 
	 * @return bool
	 */
	public function sendLogMail($storeId = '0')
	{
		// Helper
		$configHelper = Mage::helper('logging/config');
		
		// Template Id for the logging event information mail
        $templateId = $configHelper->getMailTemplateId();
		
		if (!$templateId) {
			return false;
        }   
		
		if (!$storeId) {
            $storeId = $this->_getWebsiteStoreId($this->getSendemailStoreId());
        }
		
		/** @var $mailer Mage_Core_Model_Email_Template_Mailer */
        $mailer = Mage::getModel('core/email_template_mailer');
		
		$emailInfo 	= Mage::getModel('core/email_info');
		$recipients = $configHelper->getRecipients();
		foreach ($recipients as $key=>$_recipient) {
			$emailInfo->addTo($_recipient);
		}
		
		$mailer->setSender(	array('name'	=> $configHelper->getSenderName(),
								  'email'	=> $configHelper->getSenderMail()
								 )
		);
		
		$mailer->setStoreId($storeId);
        $mailer->setTemplateId($templateId);
		
		// Template Params
		$params = array(
			'log'		=> $this,
			'type'		=> Mage::helper('logging/logtype')->getLogTypeString($this->getLogType()),
			'type_html'	=> Mage::helper('logging/logtype')->getLogTypeStyle($this->getLogType()),
			'timestamp'	=> $this->getFormatedTimestamp(),
		);
		
        $mailer->setTemplateParams($params);
		
	 	$mailer->addEmailInfo($emailInfo);
		
		if ($mailer->send()) {
			return true;
		}
		return false;
	}
	
	/**
	 * Get a formated timestamp
	 * 
	 * @return string
	 */
	public function getFormatedTimestamp($format = 'long', $includeDate = true)
	{
		return Mage::helper('core')->formatTime($this->getTimestamp(), $format, $includeDate);
	}

    /**
     * Get either first store ID from a set website or the provided as default
     *
     * @param int|string|null $storeId
     *
     * @return int
     */
    protected function _getWebsiteStoreId($defaultStoreId = null)
    {
        if ($this->getWebsiteId() != 0 && empty($defaultStoreId)) {
            $storeIds = Mage::app()->getWebsite($this->getWebsiteId())->getStoreIds();
            reset($storeIds);
            $defaultStoreId = current($storeIds);
        }
        return $defaultStoreId;
    }
	
}
