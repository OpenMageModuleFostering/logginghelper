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

class MageDeveloper_Logging_Model_Mysql4_Log_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('logging/log');
    }
}