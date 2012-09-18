<?php

class MagicToolbox_MagicMagnifyPlus_Block_Adminhtml_Settings_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $availableDesigns = Mage::getSingleton('core/design_source_design')->getAllOptions();
        $model = Mage::getModel('magicmagnifyplus/settings');
        $collection = $model->getCollection();
        $designs = array();
        foreach($collection as $item) {
            $designs[] = $item->getPackage()."/".$item->getTheme();
        }

        foreach($availableDesigns as $pKey => $package) {
            if(is_array($package['value'])) {
                foreach($package['value'] as $tKey => $theme) {
                    if(in_array($theme['value'], $designs)) {
                        unset($availableDesigns[$pKey]['value'][$tKey]);
                    }
                }
                if(!count($availableDesigns[$pKey]['value'])) unset($availableDesigns[$pKey]);
            }
        }

        if(count($availableDesigns) == 1) {
            Mage::register('magicmagnifyplus_custom_design_settings_form', false);
            return parent::_prepareForm();
        }

        $form = new Varien_Data_Form(array(
                                        'id' => 'add_form',
                                        'action' => $this->getUrl('*/*/add'),
                                        'method' => 'post',
                                    ));
        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('add_custom_set', array('legend'=>Mage::helper('magicmagnifyplus')->__('Add custom settings')));

        $fieldset->addField('design', 'select', array(
            'label'     => Mage::helper('magicmagnifyplus')->__('Custom Design'),
            'title'     => Mage::helper('magicmagnifyplus')->__('Custom Design'),
            'values'    => $availableDesigns,
            'name'      => 'design',
            'required'  => true,
        ));

        $fieldset->addField('add_button', 'note', array(
            'text'      => $this->getLayout()->createBlock('adminhtml/widget_button')->setData(array(
                'label'     => Mage::helper('magicmagnifyplus')->__('Add Setting'),
                'onclick'   => "addForm.submit()",
                'class'     => 'add',
                'type'    => 'button'
             ))->toHtml(),
            'class' => 'a-right'
        ));

        Mage::register('magicmagnifyplus_custom_design_settings_form', true);
        return parent::_prepareForm();
    }

    protected function _afterToHtml($html) {

        $html .= '<script type="text/javascript">addForm = new varienForm(\'add_form\', \'\');</script>';
        return parent::_afterToHtml($html);

    }

}
