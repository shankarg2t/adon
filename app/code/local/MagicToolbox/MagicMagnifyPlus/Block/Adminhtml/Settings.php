<?php

class MagicToolbox_MagicMagnifyPlus_Block_Adminhtml_Settings extends Mage_Adminhtml_Block_Widget_Grid_Container {

    public function __construct() {

        $this->_blockGroup = 'magicmagnifyplus';//module name
        $this->_controller = 'adminhtml_settings';//the path to your block class
        $this->_headerText = Mage::helper('magicmagnifyplus')->__('Magic Magnify Plus settings');
        parent::__construct();
        $this->setTemplate('magicmagnifyplus/settings.phtml');

    }

    protected function _prepareLayout() {

        $this->setChild('settings_grid', $this->getLayout()->createBlock('magicmagnifyplus/adminhtml_settings_grid', 'magicmagnifyplus.grid'));
        $this->setChild('custom_design_settings_form', $this->getLayout()->createBlock('magicmagnifyplus/adminhtml_settings_form', 'magicmagnifyplus.form'));
        return parent::_prepareLayout();

    }

    public function getAddCustomSettingsFormHtml() {

        $html = $this->getChildHtml('custom_design_settings_form');
        if(Mage::registry('magicmagnifyplus_custom_design_settings_form')) {
            return $html;
        } else {
            return '';
        }

    }

    public function getSettingsGridHtml() {

        return $this->getChildHtml('settings_grid');

    }

}
