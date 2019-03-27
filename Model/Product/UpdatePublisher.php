<?php

namespace Magedirect\CustomCatalog\Model\Product;

use Magento\Framework\MessageQueue\PublisherInterface;
use Magedirect\CustomCatalog\Api\Data\MessageInterface;

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
     * @param MessageInterface $message
     */
    public function execute(MessageInterface $message)
    {
        $this->publisher->publish(self::TOPIC_NAME, $message);
    }
}
