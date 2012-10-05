<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Block_Adminhtml_Logger_Renderer_Headers extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $loggedParamsShow = '';
        
        $responseHeaders = unserialize(Mage::helper('core')->decrypt($row->getHttpResponseHeaders()));
        if(!empty ($responseHeaders)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'responseHeaders'.$row->getLogId().'\'); return false;">HEADER</a><div style="display:none;" id="responseHeaders'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($responseHeaders, true)).'</pre>'.'</div>';
        }  
        
        if (!empty ($loggedParamsShow)) {
            return $loggedParamsShow;
        }
        
        return Mage::helper('inchoo_logger')->__('empty');
    }
}