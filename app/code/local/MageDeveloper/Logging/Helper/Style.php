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

class MageDeveloper_Logging_Helper_Style extends Mage_Core_Helper_Abstract
{
	/**
	 * CSS Styles
	 * @var array
	 */
	protected $_styles;
	
	public function _construct()
	{
		parent::_construct();
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
		return $this;
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
	 * Reset all styles
	 * 
	 * @return self
	 */
	public function resetStyles()
	{
		$this->_styles = array();
		return $this;
	}
	
	/**
	 * Get styled content
	 * 
	 * @param string $content Content to set Styles
	 * @return string Styled Content
	 */
	public function getStyledContent($content)
	{
		$styles = $this->getStyles();
		
		if (strlen($styles) <= 0) {
			return $content;
		}
		return '<div style="'.$styles.'">'.$content.'</div>';
	}
}
	