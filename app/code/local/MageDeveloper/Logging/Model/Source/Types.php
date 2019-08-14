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

class MageDeveloper_Logging_Model_Source_Types extends Mage_Eav_Model_Entity_Attribute_Source_Abstract
{
    /**
     * Options
     * @var array
     */
    protected $_options;
     
    /**
     * Get all logtypes
     *
     * @return array
     */
    private function _getTypes()
    {
        return Mage::helper('logging/logtype')->getLogTypes();
    }
 
    /**
     * Get all available options
     *
     * @return array
     */
    public function getAllOptions()
    {
        if (is_null($this->_options)) {
             
            $types = $this->_getTypes();
             
            $options = array();
            foreach ($types as $_val=>$_text) {
                     
                $option = array();
                 
                $option['label'] = $_text;
                $option['value'] = $_val;
                 
                $options[] = $option;
            }
             
            $this->_options = $options;
        }
        return $this->_options;
    }
	
	/**
	 * Get all options to an option array
	 * 
	 * @return array
	 */
	public function toOptionArray()
	{
		return $this->getAllOptions();
	}
     
     
}