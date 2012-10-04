<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Model_Mysql4_Log extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init('inchoo_logger/log', 'log_id');
    }
}
