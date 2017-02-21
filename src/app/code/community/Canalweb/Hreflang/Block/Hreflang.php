<?php
class Canalweb_Hreflang_Block_Hreflang extends Mage_Core_Block_Template
{
    protected $hreflangMetas = array();

    public function getHreflangMetas()
    {
        // Run through all store views to get each localized urls
        foreach (Mage::app()->getWebsites() as $website) {
            foreach ($website->getGroups() as $group) {
                $stores = $group->getStores();
                foreach ($stores as $store) {

                    // Basic informations for the store view
                    $storeId = $store->getId();
                    $localeCode = Mage::getStoreConfig('general/locale/code', $storeId);
                    $baseUrl = Mage::app()->getStore($storeId)->getBaseUrl(Mage_Core_Model_Store::URL_TYPE_LINK);

                    /**
                     *  Case 1: Category page
                     */
                    if (Mage::registry('current_category')) {
                        // Current category informations
                        $categoryId = Mage::registry('current_category')->getId();

                        // Construct url to return
                        $url = $baseUrl . Mage::getModel('catalog/category')->setStoreId($storeId)->load($categoryId)->getUrlPath();
                    }

                    /**
                     *  Case 2: Product page
                     */
                    elseif (Mage::registry('product')) {
                        // Current product informations
                        $productId  = Mage::registry('product')->getId();
                        $product = Mage::getModel('catalog/product')->setStoreId($storeId)->load($productId);

                        // Construct url to return
                        /*
                         * TODO : option back-office pour ne pas virer les catégories de l'url
                        if () {
                        */
                            $product->unsRequestPath();
                            $url = $product->getUrlInStore(array('_ignore_category' => true));
                        /*
                        } else {
                            $url = $product->setStoreId($storeId)->load($productId)->getProductUrl();
                        }
                        */
                    }

                    /**
                     *  Case 3: CMS page
                     */
                    elseif (Mage::getSingleton('cms/page')) {
                        /*
                         * TODO: option back-office rajout d'attribut aux pages cms pour avoir les liens entre les pages localisées
                        if () {

                        } else {
                        */
                            // should be non-translatable url keys
                            $currentPath = Mage::helper('hreflang/data')->getCurrentPath();
                            $url = $base_url . $currentPath;
                        /* }*/
                    }

                    /**
                     *  Case 4: Other (Magento base pages like login?)
                     */
                    else {
                        // should be non-translatable url keys
                        $currentPath = Mage::helper('hreflang/data')->getCurrentPath();
                        $url = $base_url . $currentPath;
                    }

                    // In each case, add fetched informations for the store to the array we return
                    $hreflangMetas[$localeCode] = $url;
                }
            }
        }
        
        return $hreflangMetas;
    }
}
