<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Block_Adminhtml_Logger_Renderer_Customer extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ((int)$row->getCustomerId()) {
            $customer = Mage::getModel('customer/customer')->load($row->getCustomerId());
            
            if ($customer->getId()) {
                return '<a href="'.$this->getUrl('*/customer/edit', array('id' => $customer->getId())).'">'.$customer->getId().'</a>';
            }
            
            return $row->getCustomerId();
        }
        
        return $row->getCustomerId();
    }
}