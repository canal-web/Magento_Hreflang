<?php
class Canalweb_Hreflang_Helper_Data extends Mage_Core_Helper_Abstract
{
    /**
     *  Get path from current url (non-translated)
     */
    public function getCurrentPath()
    {
        $currentUrl = Mage::helper('core/url')->getCurrentUrl();
        $currentPath = (Mage::getSingleton('core/url')->parseUrl($currentUrl))->getPath();
        return $currentPath;
    }
}
