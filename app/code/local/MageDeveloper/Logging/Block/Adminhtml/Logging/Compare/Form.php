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

class MageDeveloper_Logging_Block_Adminhtml_Logging_Compare_Form extends Mage_Adminhtml_Block_Widget_Form
{
	
	protected $collection;
	
   /**
     * Additional buttons on category page
     *
     * @var array
     */
    protected $_additionalButtons = array();
	
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('logging/compare.phtml');
    }
	
	
    protected function _prepareLayout()
    {
        return parent::_prepareLayout();
    }
	
	public function getIds()
	{
        if (!$this->getData('log_ids')) {
            $this->setData('log_ids', Mage::registry('log_ids'));
        }
        return $this->getData('log_ids');
	}
	
	/**
	 * Get all chosen log entry models as data collection
	 * 
	 * @return Varien_Data_Collection
	 */
	public function getLogEntries()
	{
		$collection = new Varien_Data_Collection();
		
		foreach ($this->getIds() as $_id) {
			try {
				$model = Mage::getModel('logging/log')->load($_id);
				$collection->addItem($model);
				
			} catch (Exception $e) {
				$this->_getSession()->addError(Mage::helper('logging')->__('Could not load log entry with id %s', $_id));
			}
		}
		return $collection;		
	}
 

}
	