<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Block_Adminhtml_Logger_Renderer_User extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        if ((int)$row->getUserId()) {
            $user = Mage::getModel('admin/user')->load($row->getUserId());
            
            if ($user->getId()) {
                return '<a href="'.$this->getUrl('*/permissions_user/edit', array('user_id' => $user->getId())).'">'.$user->getId().'</a>';
            }
            
            return $row->getUserId();
        }
        
        return $row->getUserId();
    }
}