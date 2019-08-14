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

class MageDeveloper_Logging_Block_Adminhtml_Logging_View_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form(array(
                                      'id' => 'view_form',
                                      'action' => $this->getUrl('*/*/view', array()),
                                      'method' => 'post',
                                      'enctype' => 'multipart/form-data'
                                     ));
         
        $form->setHtmlIdPrefix('logging_');
		$form->setUseContainer(true);
		
        $this->setForm($form);
        $fieldset = $form->addFieldset('logging_form_view', array('legend'=>Mage::helper('logging')->__('Log entry')));
   		$fieldset->addType('log_type', 'MageDeveloper_Logging_Lib_Varien_Data_Form_Element_LogType');
		$fieldset->addType('output', 'MageDeveloper_Logging_Lib_Varien_Data_Form_Element_Output');
		
		$log = $this->_getLog();
		
		$fieldset->addField('log_type', 'log_type', array(
			'label'         => Mage::helper('logging')->__('Log Type'),
		    'name'          => 'log_type',
		    'value'			=> $log->getLogType()
		));	
		
		$fieldset->addField('logtime', 'label', array(
			'label'         => Mage::helper('logging')->__('Timestamp'),
		    'value'			=> $log->getFormatedTimestamp()
		));	

		if ($log->getClass() != '') {
			$fieldset->addField('class', 'label', array(
				'label'         => Mage::helper('logging')->__('Class'),
			    'value'			=> $log->getClass()
			));	
		}

		if ($log->getMethod() != '') {
			$fieldset->addField('method', 'label', array(
				'label'         => Mage::helper('logging')->__('Method'),
			    'value'			=> $log->getMethod()
			));	
		}
		
		$fieldset->addField('output', 'output', array(
			'label'         => Mage::helper('logging')->__('Data'),
		    'value'			=> $log->getOutput()
		));	

		$fieldset->addField('trace', 'output', array(
			'label'         => Mage::helper('logging')->__('Backtrace'),
		    'value'			=> $log->getTrace()
		));	


		
        return parent::_prepareForm();
    }
 
 	protected function _getLog()
	{
        if (!($this->getData('log') instanceof MageDeveloper_Statistics_Model_Rule)) {
            $this->setData('log', Mage::registry('log'));
        }
        return $this->getData('log');
	}
 
    protected function _prepareLayout() 
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }
 

}
	