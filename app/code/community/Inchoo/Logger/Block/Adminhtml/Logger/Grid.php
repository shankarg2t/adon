<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Block_Adminhtml_Logger_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    protected function _construct()
    {
        parent::_construct();

        $this->setId('logger_grid');
        $this->_defaultSort = 'log_id';
        $this->setUseAjax(true);
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('inchoo_logger/log_collection');

        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
      $this->addColumn('log_id', array(
            'header'=> Mage::helper('inchoo_logger')->__('Log#'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'log_id'
        ));

        $this->addColumn('created', array(
            'header'=> Mage::helper('inchoo_logger')->__('Created'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'created'
        ));

        
        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $actions = $_conn->fetchCol('SELECT DISTINCT action_name FROM '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE));
        
        sort($actions);
        $actions = array_combine($actions, $actions);          
        
        $this->addColumn('action_name', array(
            'header'=> Mage::helper('inchoo_logger')->__('Action name'),
            'width' => '80px',
            'type'  => 'options',
            'index' => 'action_name',
            'options' => $actions
        ));

        
        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $controllers = $_conn->fetchCol('SELECT DISTINCT controller_name FROM '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE));
        
        sort($controllers);
        $controllers = array_combine($controllers, $controllers);           
        
        $this->addColumn('controller_name', array(
            'header'=> Mage::helper('inchoo_logger')->__('Controller name'),
            'width' => '80px',
            'type'  => 'text',
            'type'  => 'options',
            'index' => 'controller_name',
            'options' => $controllers
        ));
        
        
        
        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $modules = $_conn->fetchCol('SELECT DISTINCT controller_module FROM '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE));
        
        sort($modules);
        $modules = array_combine($modules, $modules);
        
        $this->addColumn('controller_module', array(
            'header'=> Mage::helper('inchoo_logger')->__('Controller module'),
            'width' => '80px',
            'type'  => 'options',
            'index' => 'controller_module',
            'options' => $modules
        ));        
        
        
        
        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $responseCodes = $_conn->fetchCol('SELECT DISTINCT http_response_code FROM '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE));
        
        sort($responseCodes);
        $responseCodes = array_combine($responseCodes, $responseCodes);          
        
        $this->addColumn('http_response_code', array(
            'header'=> Mage::helper('inchoo_logger')->__('Response code'),
            'width' => '80px',
            'type'  => 'text',
            'type'  => 'options',
            'index' => 'http_response_code',
            'options' => $responseCodes
        )); 
        
        /*
            $this->addColumn('http_response_headers', array(
                'header'=> Mage::helper('inchoo_logger')->__('Response Headers'),
                'width' => '80px',
                'type'  => 'text',
                'index' => 'http_response_headers',
                'renderer'  => 'inchoo_logger/adminhtml_logger_renderer_headers',
                'sortable'  => false,
                'filter'    => false,
            ));
        */

        $this->addColumn('client_ip', array(
            'header'=> Mage::helper('inchoo_logger')->__('Client IP'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'client_ip'
        ));

        $this->addColumn('customer_id', array(
            'header'=> Mage::helper('inchoo_logger')->__('Customer#'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'customer_id',
            'renderer'  => 'inchoo_logger/adminhtml_logger_renderer_customer'
        ));
        
        $this->addColumn('user_id', array(
            'header'=> Mage::helper('inchoo_logger')->__('User#'),
            'width' => '80px',
            'type'  => 'text',
            'index' => 'user_id',
            'renderer'  => 'inchoo_logger/adminhtml_logger_renderer_user'
        ));


        if (Mage::helper('inchoo_logger')->canLogSensitiveData()) {
            $this->addColumn('params', array(
                'header'=> Mage::helper('inchoo_logger')->__('Variables'),
                'width' => '80px',
                'type'  => 'text',
                'renderer'  => 'inchoo_logger/adminhtml_logger_renderer_params_variables',
                'sortable'  => false,
                'filter'    => false
            ));
        }

        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        $areas = $_conn->fetchCol('SELECT DISTINCT area FROM '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE));
        
        sort($areas);
        $areas = array_combine($areas, $areas);        
        
        $this->addColumn('area', array(
            'header'=> Mage::helper('inchoo_logger')->__('Area'),
            'width' => '80px',
            'type'  => 'options',
            'index' => 'area',
            'options' => $areas
        ));        
        
        return parent::_prepareColumns();
    }

    /**
     * Return Grid URL for AJAX query
     *
     * @return string
     */
    public function getGridUrl()
    {
        return $this->getUrl('*/logger_grid/grid', array('_current'=>true));
    }
    
    public function getRowUrl($item)
    {
        return false;
    }    
}
