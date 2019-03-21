<?php

namespace Magedirect\CustomCatalog\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\Eav;

class Customcatalog extends Eav
{
    public function modifyMeta(array $meta)
    {
        $meta = parent::modifyMeta($meta);

        if (isset($meta['product-details'])) {
            $meta = ['product-details' => $meta['product-details']];
        }

        $children = [];

        // TODO move to system configuration list of available fields
        $attributesLimit = ['container_sku', 'container_vpn', 'container_product_id', 'container_copy_write_info'];

        if (isset($meta['product-details']['children'])) foreach ($meta['product-details']['children'] as $childName => $childData) {
            if (in_array($childName, $attributesLimit)) {
                $children[$childName] = $childData;
            }
        }

        $meta['product-details']['children'] = $children;

        $meta['product-details']['arguments']['data']['config']['collapsible'] = false;

        return $meta;
    }

    /**
     * {@inheritdoc}
     */
    public function modifyData(array $data)
    {
        return $data;
    }
}