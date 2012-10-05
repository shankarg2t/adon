<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Inchoo_Logger_Helper_Data extends Mage_Core_Helper_Abstract
{
    const XML_PATH_ENABLED   = 'dev/inchoo_logger/is_enabled';
    const XML_PATH_CAN_LOG_SENSITIVE_DATA   = 'dev/inchoo_logger/can_log_sensitive_data';

    public function isEnabled()
    {
        $isEnabled = Mage::getStoreConfig(self::XML_PATH_ENABLED);
        return (($isEnabled == '1') ? true : false);
    }

    public function canLogSensitiveData()
    {
        $canLogSensitiveData = Mage::getStoreConfig(self::XML_PATH_CAN_LOG_SENSITIVE_DATA);
        return (($canLogSensitiveData == '1') ? true : false);
    }
}
