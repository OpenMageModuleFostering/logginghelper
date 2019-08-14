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
	protected $_styles;
	
	
	public function __construct()
	{
		parent::__construct();
		$this->_styles = array();
	}
	
	/**
	 * Set a css style
	 * 
	 * @param string $style CSS Style Name
	 * @param string $vlaue CSS Style Value
	 * @return void
	 */
	public function setStyle($style, $value)
	{
		$this->_styles[] = $style.':'.$value;
		return;
	}
	
	/**
	 * Get css styles
	 * 
	 * @return string
	 */
	public function getStyles()
	{
		$string = implode(';',$this->_styles);
		$this->_styles = array();
		return $string;
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
		
		switch ($rowContent) {
			
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_OK:
				$rowContent 		= Mage::helper('logging')->__('OK');
				$this->setStyle('background-color', '#c1ffcf');
				$this->setStyle('color', '#197a52');
				$this->setStyle('border', '1px solid #197a52');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO:
				$rowContent			= Mage::helper('logging')->__('INFO');
				$this->setStyle('background-color', '#bdf7ff');
				$this->setStyle('color', '#1598cf');
				$this->setStyle('border', '1px solid #1598cf');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_WARNING:
				$rowContent			= Mage::helper('logging')->__('WARNING');
				$this->setStyle('background-color', '#feffc1');
				$this->setStyle('color', '#cea915');
				$this->setStyle('border', '1px solid #cea915');
				break;
				
			case MageDeveloper_Logging_Model_Log::LOG_TYPE_ERROR:
				$rowContent			= Mage::helper('logging')->__('ERROR');
				$this->setStyle('background-color', '#ffc5bd');
				$this->setStyle('color', '#cf1515');
				$this->setStyle('border', '1px solid #cf1515');
				break;

			case MageDeveloper_Logging_Model_Log::LOG_TYPE_NOT_SET:
			default:
				$rowContent = '';
				$this->setStyle('background-color', 'transparent');
				$this->setStyle('color', '#000000');
		}
		
		// General Styles
		$this->setStyle('font-weight', 'bold');
		$this->setStyle('margin', '2px');
		$this->setStyle('padding', '2px');
		
		return '<div style="'.$this->getStyles().'">'.$rowContent.'</div>';
	}
}
