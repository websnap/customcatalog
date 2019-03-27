<?php

namespace Magedirect\CustomCatalog\Model\Product;

use Magento\Catalog\Model\ResourceModel\Product\Action;
use Monolog\Logger;
use Magedirect\CustomCatalog\Api\Data\MessageInterface;

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
     */
    public function __construct(
        Action $action,
        Logger $logger
    ) {
        $this->action = $action;
        $this->logger = $logger;
    }

    /**
     * @param MessageInterface $message
     * @throws \Exception
     */
    public function processMessage(MessageInterface $message)
    {
        $data = $message->getData();
        $data = $this->filterNullValues($data);
        $data = $this->filterNonExistingAttributes($data);
        $storeId = $message->getStoreId();

        $this->logger->info('Update Product Start');
        $this->logger->info('Product Data: ', $data);
        $this->logger->info('Store ID: ', [$storeId]);
        try {
            $this->action->updateAttributes(
                [$message->getEntityId()],
                $data,
                $storeId
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
            if ($value !== null) {
                $newArray[$key] = $value;
            }
        }

        return $newArray;
    }

    private function filterNonExistingAttributes($attributeCodes)
    {
        $newArray = [];
        foreach ($attributeCodes as $attributeCode => $value) {
            if ($this->action->getAttribute($attributeCode) !== false) {
                $newArray[$attributeCode] = $value;
            }
        }

        return $newArray;
    }
}
