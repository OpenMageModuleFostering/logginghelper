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

class MageDeveloper_Logging_Lib_Varien_Data_Form_Element_LogType extends Varien_Data_Form_Element_Abstract
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('label');
    }
	
    public function getElementHtml()
    {
    	$value = $this->getEscapedValue();
		$html = '';
       
	   	$helper = Mage::helper('logging/logtype');
		
		$logText = $helper->getLogTypeString($value);
		
		// Set log styles
		$helper->setLogTypeStyles($value);
		$helper->setStyle('width','200px');
		$helper->setStyle('text-align', 'center');
		$helper->setStyle('font-size', '17px');
		
		$html .= $helper->getStyledContent($logText);
			
        $html.= $this->getAfterElementHtml();
        return $html;
    }
}
	