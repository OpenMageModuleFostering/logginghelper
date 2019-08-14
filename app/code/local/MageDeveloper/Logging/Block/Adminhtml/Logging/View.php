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

class MageDeveloper_Logging_Block_Adminhtml_Logging_View extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId    = 'id';
        $this->_controller  = 'adminhtml_logging';
        $this->_mode        = 'view';
		$this->_blockGroup  = 'logging'; 

        parent::__construct();
		
		if ($previousUrl = $this->getPreviousUrl()) {
	        $this->_addButton('previous', array(
	            'label'     => Mage::helper('logging')->__('Previous'),
	            'onclick'   => 'setLocation(\'' . $previousUrl . '\')',
	        ), -1);
		}
		if ($nextUrl = $this->getNextUrl()) {
	        $this->_addButton('next', array(
	            'label'     => Mage::helper('logging')->__('Next'),
	            'onclick'   => 'setLocation(\'' . $nextUrl . '\')',
	        ), -1);
		}
	    $this->_addButton('mail', array(
			'label'     => Mage::helper('logging')->__('Send mail'),
			'onclick'   => 'setLocation(\'' . $this->getSendMailUrl() . '\')',
			'class'		=> 'add success'
		), -1);
		
		$this->removeButton('reset');
		$this->removeButton('save');
    }

    /**
     * Get header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('logging')->__('Show Log Entry');
    }
	
	/**
	 * Get the id of the previous log entry
	 * 
	 * @return int
	 */
	public function getPreviousId()
	{
		$param = $this->getRequest()->getParam($this->_objectId);
		$id = Mage::helper('logging/log')->getPreviousLogId($param);	
		return $id;
	}
	
	/**
	 * Get the url to view previous log entry
	 * 
	 * @return string
	 */
	public function getPreviousUrl()
	{
		$id = $this->getPreviousId();
		if ($id) {
        	return $this->getUrl('*/*/view', array($this->_objectId => $id));
		}
		return false;
	}
	
	/**
	 * Get the url to send the log by mail
	 * 
	 * @return string
	 */
	public function getSendMailUrl()
	{
		$id = $this->getRequest()->getParam($this->_objectId);
		return $this->getUrl('*/*/mail', array($this->_objectId => $id));
	}
	
	/**
	 * Get the id of the next log entry
	 * 
	 * @return int
	 */
	public function getNextId()
	{
		$param = $this->getRequest()->getParam($this->_objectId);
		$id = Mage::helper('logging/log')->getNextLogId($param);	
		return $id;
	}
	
	/**
	 * Get the url to view next log entry
	 * 
	 * @return string
	 */
	public function getNextUrl()
	{
		$id = $this->getNextId();
		if ($id) {
			return $this->getUrl('*/*/view', array($this->_objectId => $id));
		}
	}
    
}