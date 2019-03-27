<?php

namespace Magedirect\CustomCatalog\Controller\Adminhtml\Product;

class Edit extends \Magento\Catalog\Controller\Adminhtml\Product\Edit
{

    /**
     * Custom catalog product edit form
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $resultPage = parent::execute();

        if (!$this->_objectManager->get(\Magento\Store\Model\StoreManagerInterface::class)->isSingleStoreMode()
            &&
            ($switchBlock = $resultPage->getLayout()->getBlock('store_switcher'))
        ) {
            $switchBlock->setSwitchUrl(
                $this->getUrl(
                    'customcatalog/*/*',
                    ['_current' => true, 'active_tab' => null, 'tab' => null, 'store' => null]
                )
            );
        }

        return $resultPage;
    }
}
