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

class MageDeveloper_Logging_Block_Adminhtml_Logging_Compare extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId    = 'id';
        $this->_controller  = 'adminhtml_logging';
        $this->_mode        = 'compare';
		$this->_blockGroup  = 'logging'; 

        parent::__construct();
		
		$this->removeButton('delete');
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
        return Mage::helper('logging')->__('Compare Log Entries');
    }
    
}