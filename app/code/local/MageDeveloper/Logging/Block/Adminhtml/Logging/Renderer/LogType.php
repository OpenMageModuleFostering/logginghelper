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

class MageDeveloper_Logging_Block_Adminhtml_Logging_Renderer_LogType extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	protected $helper;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->helper = Mage::helper('logging/logtype');
	}
	
	/**
	 * render
	 * Renders an grid row
	 * 
	 * @param Varien_Object $row
	 * @return string
	 */
	public function render(Varien_Object $row)
	{
		$rowContent = $row->getData( $this->getColumn()->getIndex() );
		$logType = (int)$rowContent;
		
		$logText = $this->helper->getLogTypeString($logType);
		// Set log styles
		$this->helper->setLogTypeStyles($logType);
		
		return $this->helper->getStyledContent($logText);
	}
}
