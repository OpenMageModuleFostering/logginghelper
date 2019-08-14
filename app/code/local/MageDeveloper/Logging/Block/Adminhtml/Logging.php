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

class MageDeveloper_Logging_Block_Adminhtml_Logging extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	protected $_addButtonLabel = '';
	protected $_addButton = '';
	
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_logging';
        $this->_blockGroup = 'logging';
        $this->_headerText = Mage::helper('logging')->__('Display Logs');
	 	$this->_removeButton('add');
    }
    
    protected function _prepareLayout()
    {
       return parent::_prepareLayout();
    }
}