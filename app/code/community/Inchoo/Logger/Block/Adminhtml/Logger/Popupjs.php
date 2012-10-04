<?php

class Inchoo_Logger_Block_Adminhtml_Logger_Popupjs extends Mage_Core_Block_Text
{
    public function getText()
    {
        return '
            <script type="text/javascript">
            //<![CDATA[
                function showParams(elId) {
                    Dialog.info($(elId).innerHTML, {
                        draggable:true,
                        resizable:true,
                        closable:true,
                        className:"magento",
                        windowClassName:"popup-window",
                        title:"Variables",
                        width:700,
                        height:270,
                        zIndex:1000,
                        recenterAuto:true,
                        hideEffect:Element.hide,
                        showEffect:Element.show,
                        id:"logger_"+elId
                    });
                }
            //]]>
            </script>            
        ';
    }    
}