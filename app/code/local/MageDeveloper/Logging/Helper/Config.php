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

class MageDeveloper_Logging_Helper_Config extends Mage_Core_Helper_Abstract
{
    /**
     * XML Configuration Paths
     * @var string
     */
    const XML_PATH_ENABLE_LOGGING_MAILS         = 'logging/mail_settings/enable_mails';
	const XML_PATH_TYPE_SELECT					= 'logging/mail_settings/typeselect';
	const XML_PATH_RECIPIENTS					= 'logging/mail_settings/recipients';
	const XML_PATH_SENDER						= 'logging/mail_settings/sender';
	const XML_PATH_MAIL_TEMPLATE				= 'logging/mail_settings/template';
	
	/**
	 * Get the configuration setting for enabled logging mails
	 * 
	 * @return bool
	 */
	public function isLoggingMailEnabled()
	{
		return (bool)Mage::getStoreConfig(self::XML_PATH_ENABLE_LOGGING_MAILS);
	}
	
	/**
	 * Get the selected types in the backend configuration
	 * 
	 * @return array
	 */
	public function getSelectedTypes()
	{
		$config = Mage::getStoreConfig(self::XML_PATH_TYPE_SELECT);
		$types = array();
		
		if ($config) {
			$types = explode(',', $config);
		}	
		return $types;
	}
	
	/**
	 * Get the mail template id from the configuration settings
	 * 
	 * @return int
	 */
	public function getMailTemplateId()
	{
		return (int)Mage::getStoreConfig(self::XML_PATH_MAIL_TEMPLATE);
	}
	
	/**
	 * Get the configuration setting for the mail recipients
	 * 
	 * @return array
	 */
	public function getRecipients()
	{
		$config = Mage::getStoreConfig(self::XML_PATH_RECIPIENTS);
		$recipients = array();
		
		if ($config) {
			$recipients = explode(';', $config);
		}		
		return $recipients;
	}

	/**
	 * Get sender ident
	 * 
	 * @return string
	 */
	public function getSenderIdent()
	{
		return Mage::getStoreConfig(self::XML_PATH_SENDER);
	}
	
	/**
	 * Get sender name
	 * 
	 * @return string
	 */
	public function getSenderName()
	{
		$senderIdent = $this->getSenderIdent();
		return Mage::getStoreConfig('trans_email/ident_'.$senderIdent.'/name'); 
	}

	/**
	 * Get sender email
	 * 
	 * @return string
	 */	
	public function getSenderMail()
	{
		$senderIdent = $this->getSenderIdent();
		return Mage::getStoreConfig('trans_email/ident_'.$senderIdent.'/email');
	}
	
	/**
	 * Checks if an type is allowed for sending mail
	 * 
	 * @param int $type Log Type
	 * @return bool
	 */
	public function isAllowedToSendMail($type)
	{
		if ($this->isLoggingMailEnabled() && in_array($type, $this->getSelectedTypes())) {
			return true;
		}
		return false;
	}
}