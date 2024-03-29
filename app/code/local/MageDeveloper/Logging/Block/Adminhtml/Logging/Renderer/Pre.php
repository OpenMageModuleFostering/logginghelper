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

class MageDeveloper_Logging_Block_Adminhtml_Logging_Renderer_Pre extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
	/**
	 * render
	 * Renders an grid row
	 * 
	 * @param Varien_Object $row
	 * @return string
	 */
	public function render(Varien_Object $row)
	{
		$content = '';
		
		$rowContent = $row->getData( $this->getColumn()->getIndex() );
		$content = '<code>'.$rowContent.'</code>';
		
		return $content;
	}
}
