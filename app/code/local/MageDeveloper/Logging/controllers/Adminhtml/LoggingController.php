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
 
class MageDeveloper_Logging_Adminhtml_LoggingController extends Mage_Adminhtml_Controller_Action
{
	/**
	 * indexAction
	 */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }  
	
	
	
	/**
	 * massDeleteAction
	 */
    public function massDeleteAction() 
    {
        $ids = $this->getRequest()->getParam('logging');
		
        if(!is_array($ids)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
            try {
            	
                foreach ($ids as $id) {
                    $log = Mage::getModel('logging/log')->load($id);
                    $log->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($ids)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }
	

	
	
	
	
	
}
	