<?php
/**
 * @category   MagePsycho
 * @package    MagePsycho_Massimporterpro
 * @author     magepsycho@gmail.com
 * @website    http://www.magepsycho.com
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class MagePsycho_Massimporterpro_Model_Observer {

	public function preDispatchCheck(Varien_Event_Observer $observer) {
		$helper				= Mage::helper('massimporterpro');
		$isValid			= $helper->isValid();
		$isActive			= $helper->isActive();
		$adminhtmlSession	= Mage::getSingleton('adminhtml/session');
		$fullActionName		= $observer->getEvent()->getControllerAction()->getFullActionName();
		if(!$isActive && 'massimporterpro_adminhtml_priceupdater_index' == $fullActionName){
			$adminhtmlSession->getMessages(true);
			$adminhtmlSession->addNotice(base64_decode('RXh0ZW5zaW9uIGhhcyBiZWVuIGRpc2FibGVkLiBQbGVhc2UgZW5hYmxlIGl0IGZyb20gTWFzcyBJbXBvcnRlciBQcm8gJnJhcXVvOyBNYW5hZ2UgU2V0dGluZ3M='));
			return;
		}else if ($isActive && !$isValid && 'massimporterpro_adminhtml_priceupdater_index' == $fullActionName) {
			$adminhtmlSession->getMessages(true);
			$adminhtmlSession->addError($helper->getMessage());
			return;
		}
        return $this;
	}

}