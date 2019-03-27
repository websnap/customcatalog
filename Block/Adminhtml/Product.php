<?php

namespace Magedirect\CustomCatalog\Block\Adminhtml;

class Product extends \Magento\Catalog\Block\Adminhtml\Product
{

    /**
     * Retrieve product create url by specified product type
     *
     * @param string $type
     * @return string
     */
    protected function _getProductCreateUrl($type)
    {
        return $this->getUrl(
            'customcatalog/*/new',
            ['set' => $this->_productFactory->create()->getDefaultAttributeSetId(), 'type' => $type]
        );
    }
}
