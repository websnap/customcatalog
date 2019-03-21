<?php

namespace Magedirect\CustomCatalog\Model\Product;

use Magento\Catalog\Model\ResourceModel\Product\Action;
use Magedirect\CustomCatalog\Model\Logger;
use Magedirect\CustomCatalog\Api\Data\ProductInterface;

class UpdateConsumer
{

    /**
     * @var Action
     */
    protected $action;

    /**
     * Logging instance
     * @var Logger
     */
    protected $logger;

    /**
     * UpdateConsumer constructor.
     *
     * @param Action $action
     * @param Logger $logger
     * @throws \Magento\Framework\Exception\$loggerFactory
     */
    public function __construct(
        Action $action,
        Logger $logger
    ) {
        $this->action = $action;
        $this->logger = $logger;
    }

    /**
     * @param ProductInterface $product
     * @throws \Exception
     */
    public function processMessage(ProductInterface $product)
    {
        $data = $this->filterNullValues($product->getData());

        $this->logger->info('Update Product Start');
        $this->logger->info('Product Data: ', $data);
        try {
            $this->action->updateAttributes(
                [$product->getEntityId()],
                $data,
                0
            );
            $this->logger->info('Update Product Finish');
        } catch (\Exception $exception) {
            $this->logger->info('Update Product Error');
            $this->logger->critical($exception);
        }
    }

    private function filterNullValues($array)
    {
        $newArray = [];
        foreach ($array as $key => $value) {
            if (!is_null($value)) {
                $newArray[$key] = $value;
            }
        }

        return $newArray;
    }
}