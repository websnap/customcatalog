<?php

namespace Magedirect\CustomCatalog\Model\Product;

use \Magento\Framework\MessageQueue\PublisherInterface;
use Magedirect\CustomCatalog\Api\Data\ProductInterface;

class UpdatePublisher
{
    const TOPIC_NAME = 'customcatalog.product.update';

    /**
     * @var PublisherInterface
     */
    private $publisher;

    /**
     * @param PublisherInterface $publisher
     */
    public function __construct(PublisherInterface $publisher)
    {
        $this->publisher = $publisher;
    }

    /**
     * @param ProductInterface $product
     */
    public function execute(ProductInterface $product)
    {
        $this->publisher->publish(self::TOPIC_NAME, $product);
    }
}