<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Block_Adminhtml_Logger_Renderer_Params_Variables extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Abstract
{
    public function render(Varien_Object $row)
    {
        $loggedParamsShow = '';
        
        $paramsPost = unserialize(Mage::helper('core')->decrypt($row->getParamsPost()));
        if(!empty ($paramsPost)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'post'.$row->getLogId().'\'); return false;">POST</a><div style="display:none;" id="post'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsPost, true)).'</pre>'.'</div>';
        }
        
        $paramsGet = unserialize(Mage::helper('core')->decrypt($row->getParamsGet()));
        if(!empty ($paramsGet)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'get'.$row->getLogId().'\'); return false;">GET</a><div style="display:none;" id="get'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsGet, true)).'</pre>'.'</div>';
        }  
        
        $paramsRequest = unserialize(Mage::helper('core')->decrypt($row->getParamsRequest()));
        if(!empty ($paramsRequest)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'request'.$row->getLogId().'\'); return false;">REQUEST</a><div style="display:none;" id="request'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsRequest, true)).'</pre>'.'</div>';
        } 
        
        $paramsFiles = unserialize(Mage::helper('core')->decrypt($row->getParamsFiles()));
        if(!empty ($paramsFiles)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'files'.$row->getLogId().'\'); return false;">FILES</a><div style="display:none;" id="request'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsFiles, true)).'</pre>'.'</div>';
        }         

        $paramsEnv = unserialize(Mage::helper('core')->decrypt($row->getParamsEnv()));
        if(!empty ($paramsEnv)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'env'.$row->getLogId().'\'); return false;">ENV</a><div style="display:none;" id="env'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsEnv, true)).'</pre>'.'</div>';
        }    
        
        $paramsCookie = unserialize(Mage::helper('core')->decrypt($row->getParamsCookie()));
        if(!empty ($paramsCookie)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'cookie'.$row->getLogId().'\'); return false;">COOKIE</a><div style="display:none;" id="cookie'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsCookie, true)).'</pre>'.'</div>';
        }   
        
        $paramsServer = unserialize(Mage::helper('core')->decrypt($row->getParamsServer()));
        if(!empty ($paramsServer)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'server'.$row->getLogId().'\'); return false;">SERVER</a><div style="display:none;" id="server'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsServer, true)).'</pre>'.'</div>';
        }              
        
        $paramsSession = unserialize(Mage::helper('core')->decrypt($row->getParamsSession()));
        //Zend_Debug::dump($paramsSession, '$paramsSession');
        
        if(!empty ($paramsSession)) {
            $loggedParamsShow .= ' <a href="#" onclick="showParams(\'session'.$row->getLogId().'\'); return false;">SESSION</a><div style="display:none;" id="session'.$row->getLogId().'">'.'<pre>'.  str_replace('"', '', print_r($paramsSession, true)).'</pre>'.'</div>';
        }  
        
        if (!empty ($loggedParamsShow)) {
            return $loggedParamsShow;
        }
        
        return Mage::helper('inchoo_logger')->__('empty');
    }
}