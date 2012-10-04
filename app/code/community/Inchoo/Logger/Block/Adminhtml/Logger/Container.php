<?php

class Inchoo_Logger_Block_Adminhtml_Logger_Container extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $action = Mage::app()->getRequest()->getActionName();
        $this->_blockGroup = 'inchoo_logger';
        $this->_controller = 'adminhtml_logger';

        parent::__construct();
        $this->_removeButton('add');
        
        $this->_addButton('clear', array(
            'label'     => Mage::helper('inchoo_logger')->__('Clear All'),
            'onclick'   => 'setLocation(\'' . $this->getUrl('*/logger_grid/clear') .'\')',
            'class'     => 'clear',
        ));        
        
        
    }

    public function getHeaderText()
    {
        return Mage::helper('inchoo_logger')->__('Logger by Inchoo');
    }
}
