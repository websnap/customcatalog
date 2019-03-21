<?php

namespace Magedirect\CustomCatalog\Api;

use Magedirect\CustomCatalog\Api\Data\ProductInterface;

/**
 * Interface ProductRepositoryInterface
 * @package Magedirect\CustomCatalog\Api
 */
interface ProductRepositoryInterface
{

    /**
     * Get product list by VPN
     *
     * @param string $vpn
     * @return \Magento\Catalog\Api\Data\ProductSearchResultsInterface
     */
    public function getByVPN($vpn);

    /**
     * Update product
     *
     * @param ProductInterface $product
     * @return void
     * @throws \Magento\Framework\Exception\ValidatorException
     */
    public function update(ProductInterface $product);

}
