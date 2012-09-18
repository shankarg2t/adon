<?php

class MagicToolbox_MagicMagnifyPlus_Model_Observer {

    public function __construct() {

    }

    public function checkForMagic360Product($observer) {
        $helper = Mage::helper('magicmagnifyplus/settings');
        if($helper->isModuleOutputEnabled()) {
            $event = $observer->getEvent();
            $product = $event->getProduct();
            $id = $product->getId();
            $gallery = $product->getMediaGalleryImages();
            $imagesCount = $gallery->getSize();

            //NOTE: for old Magento ver. 1.3.x
            if(is_null($imagesCount)) {
                $imagesCount = count($gallery->getItems());
            }

            $tool = $helper->loadTool('product');
            if($tool->isEnabled($imagesCount, $id)) {
                Mage::register('magic360ClassName', 'magicmagnifyplus');
            } else {
                Mage::register('magic360ClassName', false);
            }
        }
    }

    /*public function controller_action_predispatch($observer) {

    }*/

    /*public function beforeLoadLayout($observer) {

    }*/

    public function fixLayoutUpdates($observer) {
        //NOTE: to prevent an override of our templates with other modules

        //replace node to prevent dublicate
        $child = new Varien_Simplexml_Element('<magicmagnifyplus module="MagicToolbox_MagicMagnifyPlus"><file></file></magicmagnifyplus>');
        Mage::app()->getConfig()->getNode('frontend/layout/updates')->extendChild($child, true);
        //add new node to the end
        $child = new Varien_Simplexml_Element('<magicmagnifyplus_layout_update module="MagicToolbox_MagicMagnifyPlus"><file>magicmagnifyplus.xml</file></magicmagnifyplus_layout_update>');
        Mage::app()->getConfig()->getNode('frontend/layout/updates')->appendChild($child);
    }

    /*public function controller_action_postdispatch($observer) {

    }*/

}

?>