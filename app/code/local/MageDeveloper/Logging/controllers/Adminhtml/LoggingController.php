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
	protected function _initLog()
	{
		$id  = (int) $this->getRequest()->getParam('id');
		
		try {
			
			$logEntry = Mage::getModel('logging/log')->load($id);
					
			if ($logEntry instanceof MageDeveloper_Logging_Model_Log) {
				Mage::register('log', $logEntry);
        		Mage::register('current_log', $logEntry);
        		return $logEntry;
			}		
					
			
		} catch (Exception $e) {
			Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
		}
	}
	
	/**
	 * indexAction
	 */
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }  
	
	/**
	 * viewAction
	 * Display details of an logging entry
	 */
	public function viewAction()
	{
		$log = $this->_initLog();
		
        if (!$log->getId()) {
            $this->_getSession()->addError(Mage::helper('logging')->__('This log no longer exists.'));
            $this->_redirect('*/*/');
            return;
        }

        $this->_title( Mage::helper('logging')->__('Showing log entry') );

		$this->loadLayout();
		
		$this->getLayout()->getBlock('head')->setCanLoadExtJs(false);
		$this->renderLayout();
	}
	
	/**
	 * deleteAction
	 */
    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('id')) {
            try {
                $model = Mage::getModel('logging/log');
                $model->setId($id);
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('log')->__('The log entry has been deleted.'));
                $this->_redirect('*/*/');
                return;
            }
            catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('logging')->__('Unable to find a log entry to delete.'));
        $this->_redirect('*/*/');
    }
	
	/**
	 * compareAction
	 */
	public function compareAction()
	{
		$ids = $this->getRequest()->getParam('logging');
		
        if(!is_array($ids)) {
			Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select item(s)'));
        } else {
	        $this->_title( Mage::helper('logging')->__('Compare log entries') );
	
			$this->loadLayout();
			
			$this->getLayout()->getBlock('head')->setCanLoadExtJs(false);
			
			Mage::register('log_ids', $ids);
			
			$this->renderLayout();
        }
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
	