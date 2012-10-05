<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Adminhtml_Logger_GridController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        if (!Mage::helper('inchoo_logger')->isEnabled()) {
            Mage::getSingleton('adminhtml/session')->addNotice('Inchoo_Logger seems to be disabled under System > Configuration > Advanced > Developer > Inchoo Logger > Enabled [Yes | No]. Please enable it in order to see the logger grid.');
            $this->_redirect(Mage::getSingleton('admin/session')->getUser()->getStartupPageUrl());
            return;
        }

        $this->_title($this->__('System'))
                ->_title($this->__('Logger'));

        $this->loadLayout();
        $this->_setActiveMenu('system/logger');
        $this->_addContent($this->getLayout()->createBlock('inchoo_logger/adminhtml_logger_container'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->getResponse()->setBody($this->getLayout()->createBlock('inchoo_logger/adminhtml_logger_grid')->toHtml());
    }
    
    public function clearAction()
    {
        $_conn = Mage::getSingleton('core/resource')->getConnection('core_read');
        
        try {
            $_conn->query('TRUNCATE TABLE '.$_conn->getTableName(Inchoo_Logger_Model_Log::TABLE).';');
            Mage::getSingleton('adminhtml/session')->addSuccess('Logger table has been successfully truncated');
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        
        $this->_redirectReferer();
    }
}
