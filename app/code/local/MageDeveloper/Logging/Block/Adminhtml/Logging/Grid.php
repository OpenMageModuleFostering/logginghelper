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

class MageDeveloper_Logging_Block_Adminhtml_Logging_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
	/**
	 * Collection
	 * @var MageDeveloper_Logging_Model_Mysql4_Log_Collection
	 */
	protected $_collection;
	
    public function __construct()
    {
        parent::__construct();
        $this->setId('loggingGrid');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }
	
	/**
	 * Get the logging collection
	 * 
	 * @return MageDeveloper_Logging_Model_Mysql4_Log_Collection
	 */
	public function getCollection()
	{
		if (!$this->_collection) {
			$this->_collection = Mage::getModel('logging/log')
                       				 ->getCollection();
		}
		return $this->_collection;
	}

    protected function _prepareCollection()
    {
		$collection = $this->getCollection();
                        
        $this->setCollection($collection);
        
        return parent::_prepareCollection();
    }
	
	/**
	 * Get the row class
	 * 
	 * @param $row
	 * @return string
	 */
	public function getRowClass($row)
	{
		$class = parent::getRowClass();
		
		if ($this->isTodayRow($row)) {
			$class .= ' ' . 'on-mouse';
		}
		
		return $class;
	}
	
	/**
	 * Checks if the row is from today
	 * 
	 * @return bool true if today
	 */
	public function isTodayRow($row)
	{
		$collection = $this->getCollection()
						   ->addTodayFilter();
		
		$id = $row->getId();
		
		$ids = $collection->getAllIds();
		if (in_array($id, $ids)) {
			return true;
		}
		return false;
	}

    protected function _prepareColumns()
    {
        $this->addColumn('entity_id', array(
              'header'    => Mage::helper('logging')->__('ID'),
              'align'     => 'left',
              'width'     => '10px',
              'index'     => 'entity_id',
              'name'	  => 'id'
        ));
		
        $this->addColumn('log_type', array(
            'header'        => Mage::helper('logging')->__('Log Type'),
            'index'			=> 'log_type',
            'align'    		=> 'center',
            'name'			=> 'log_type',
            'width'     	=> '10px',
            'type'			=> 'options',
			'renderer'		=> 'MageDeveloper_Logging_Block_Adminhtml_Logging_Renderer_LogType',
			'options'   => array(
				MageDeveloper_Logging_Model_Log::LOG_TYPE_NOT_SET 	=> Mage::helper('logging')->__('NOT SET'),
				MageDeveloper_Logging_Model_Log::LOG_TYPE_OK 		=> Mage::helper('logging')->__('OK'),
				MageDeveloper_Logging_Model_Log::LOG_TYPE_INFO 		=> Mage::helper('logging')->__('INFO'),
				MageDeveloper_Logging_Model_Log::LOG_TYPE_WARNING 	=> Mage::helper('logging')->__('WARNING'),
				MageDeveloper_Logging_Model_Log::LOG_TYPE_ERROR 	=> Mage::helper('logging')->__('ERROR'),
				MageDeveloper_Logging_Model_Log::LOG_TYPE_TIME	 	=> Mage::helper('logging')->__('TIME'),
            ),      
        ));  		
		
	    $this->addColumn('timestamp', array(
	          'header'    => Mage::helper('logging')->__('Timestamp'),
	          'align'     =>'left',
	          'width'     => '100px',
	          'type'	  => 'datetime',
	          'index'     => 'timestamp',
	    ));
		
        $this->addColumn('class', array(
              'header'    => Mage::helper('logging')->__('Class'),
              'align'     => 'left',
              'width'     => '120px',
              'index'     => 'class',
        ));
		
        $this->addColumn('method', array(
              'header'    => Mage::helper('logging')->__('Method'),
              'align'     => 'left',
              'width'     => '120px',
              'index'     => 'method',
        ));
			
        $this->addColumn('output', array(
              'header'    => Mage::helper('logging')->__('Data'),
              'align'     => 'left',
              'width'     => '400px',
              'index'     => 'output',
              'renderer'  => 'MageDeveloper_Logging_Block_Adminhtml_Logging_Renderer_Pre',
        ));
		
		
        $this->addColumn('action',
            array(
                'header'    =>  Mage::helper('logging')->__('Action'),
                'width'     => '50',
                'type'      => 'action',
                'getter'    => 'getId',
                'actions'   => array(
                    array(
                        'caption'   => Mage::helper('logging')->__('View'),
                        'url'       => array('base'=> '*/*/view'),
                        'field'     => 'id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'index'     => 'stores',
                'is_system' => true,
        ));
		
        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('logging');


        $this->getMassactionBlock()->addItem('delete', array(
             'label'    => Mage::helper('logging')->__('Delete'),
             'url'      => $this->getUrl('*/*/massDelete'),
             'confirm'  => Mage::helper('logging')->__('Are you sure?')
        ));
		
        $this->getMassactionBlock()->addItem('compare', array(
             'label'    => Mage::helper('logging')->__('Compare'),
             'url'      => $this->getUrl('*/*/compare')
        ));

        return $this;
    }


    /**
     * Return row url for js event handlers
     *
     * @return string
     */
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/view', array('id'=>$row->getId()));
    }

}
