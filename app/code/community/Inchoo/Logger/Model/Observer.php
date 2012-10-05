<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Model_Observer 
{
    
    public function layoutUpdate($observer = null)
    {
        if (!Mage::helper('inchoo_logger')->isEnabled()) {
            return;
        }
        
        /* Little bit dirty approach, but I would like to avoid creating layout update XML */
        
        if (Mage::app()->getRequest()->getControllerModule() == 'Inchoo_Logger_Adminhtml') {

            $layout = $observer->getEvent()->getLayout();

            /* default.css & magento.css are here in order for popup to work on the logger grid  */
            $layout->getUpdate()->addUpdate('
                <reference name="head">
                    <action method="addItem"><type>js_css</type><name>prototype/windows/themes/default.css</name></action>
                    <action method="addItem"><type>js_css</type><name>prototype/windows/themes/magento.css</name></action>
                </reference>
                <reference name="before_body_end">
                    <block type="inchoo_logger/adminhtml_logger_popupjs" name="logger_popupjs" />
                </reference>
            ');

            $layout->generateXml();
        }
    }
    
    public function log($observer = null) 
    {
        if (!Mage::helper('inchoo_logger')->isEnabled()) {
            return;
        }

        //Zend_Debug::dump(Mage::getSingleton('customer/session')->toArray(), '$_SESSION');
        if (Mage::app()->getRequest()->getControllerModule() == 'Inchoo_Logger_Adminhtml') {
            return;
        }
        
        $log = Mage::getModel('inchoo_logger/log');
        
        $log->setCreated(new Zend_Db_Expr('NOW()'));
        $log->setActionName(Mage::app()->getRequest()->getActionName());
        $log->setControllerName(Mage::app()->getRequest()->getControllerName());
        $log->setHttpResponseCode($observer->getEvent()->getControllerAction()->getResponse()->getHttpResponseCode());

        if (Mage::helper('inchoo_logger')->canLogSensitiveData()) {
            $log->setHttpResponseHeaders(Mage::helper('core')->encrypt(serialize($observer->getEvent()->getControllerAction()->getResponse()->getHeaders())));
            $log->setParamsPost(Mage::helper('core')->encrypt(serialize($_POST)));
            $log->setParamsGet(Mage::helper('core')->encrypt(serialize($_GET)));
            $log->setParamsRequest(Mage::helper('core')->encrypt(serialize($_REQUEST)));
            $log->setParamsFiles(Mage::helper('core')->encrypt(serialize($_FILES)));
            $log->setParamsEnv(Mage::helper('core')->encrypt(serialize($_ENV)));
            $log->setParamsCookie(Mage::helper('core')->encrypt(serialize($_COOKIE)));
            $log->setParamsServer(Mage::helper('core')->encrypt(serialize($_SERVER)));
            $log->setParamsSession(Mage::helper('core')->encrypt(serialize($_SESSION)));
        }

        $log->setClientIp(Mage::app()->getRequest()->getClientIp());
        $log->setControllerModule(Mage::app()->getRequest()->getControllerModule());
        $log->setArea(Mage::app()->getLayout()->getArea());

        if ($customer = Mage::getSingleton('customer/session')->getCustomer()) {
            if ($customer->getId()) {
                $log->setCustomerId($customer->getId());
            } else {
                $log->setCustomerId(0);
            }
            
        } else {
            $log->setCustomerId(0);
        }
        
        if ($user = Mage::getSingleton('admin/session')->getUser()) {
            if ($user->getId()) {
                $log->setUserId($user->getId());
            } else {
                $log->setUserId(0);
            }
        } else {
            $log->setUserId(0);
        }        
        
        try {
            $log->save();
        } catch (Exception $e) {
            Mage::log('file: '.__FILE__.', line: '.__LINE__, 'msg: '.$e->getMessage());
        }        
        
        
//        
//        $params = Mage::app()->getRequest()->getParams();
//        Mage::app()->getRequest()->getActionName();
//        Mage::app()->getRequest()->getControllerName();
//        Mage::app()->getRequest()->getClientIp();
//        Mage::app()->getRequest()->getControllerModule();
//        echo Mage::app()->getLayout()->getArea();
               

//        if ('actionlogger_admin_grid' != Mage::app()->getRequest()->getControllerName()
//                && 'actionlogger_frontend_grid' != Mage::app()->getRequest()->getControllerName()) {
//            $log->setActionName(Mage::app()->getRequest()->getActionName());
//            $log->setControllerName(Mage::app()->getRequest()->getControllerName());
//
//            if (Mage::helper('activecodeline_actionlogger')->_canLogRequestParams()) {
//                if ($params = Mage::app()->getRequest()->getParams()) {
//                    $log->setParams(Mage::helper('core')->encrypt(serialize($params)));
//                }
//            }
//
//            $log->setClientIp(Mage::app()->getRequest()->getClientIp());
//            $log->setControllerModule(Mage::app()->getRequest()->getControllerModule());
//
//            if ($user = Mage::getSingleton('admin/session')->getUser()) {
//                $log->setUserId($user->getId());
//            } else {
//                $log->setUserId(0);
//            }
//
//            try {
//                $log->save();
//            } catch (Exception $e) {
//                Mage::log('file: ' . __FILE__ . ', line: ' . __LINE__, 'msg: ' . $e->getMessage());
//            }
//        }
    }
}
