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

class MageDeveloper_Logging_Lib_Varien_Data_Form_Element_Output extends Varien_Data_Form_Element_Abstract
{
    public function __construct($attributes=array())
    {
        parent::__construct($attributes);
        $this->setType('label');
    }
	
    public function getElementHtml()
    {
    	$value = $this->getValue();
		
		$helper = Mage::helper('logging/style');
		
		$html = '';
       
		// Set box styles
		$helper->setStyle('border', '1px solid #c0c0c0')
			   ->setStyle('padding', '5px')
			   ->setStyle('width','100%')
			   ->setStyle('font-family','Courier, Courier New')
			   ->setStyle('background-color','#ffffff');
	    
		$value = $helper->getStyledContent($value);
	    $html .= '<pre>'.$value.'</pre>';
		
		
        $html.= $this->getAfterElementHtml();
        return $html;
    }
}
	