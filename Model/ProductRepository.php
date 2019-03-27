<?php

namespace Magedirect\CustomCatalog\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Store\Model\StoreManagerInterface;
use Magedirect\CustomCatalog\Api\Data\ProductInterface;
use Magedirect\CustomCatalog\Model\Product\UpdatePublisher;
use Magedirect\CustomCatalog\Api\Data\MessageInterface;
use Magedirect\CustomCatalog\Api\Data\MessageInterfaceFactory;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 * @SuppressWarnings(PHPMD.TooManyFields)
 */
class ProductRepository implements \Magedirect\CustomCatalog\Api\ProductRepositoryInterface
{

    /**
     * @var ProductRepositoryInterface
     */
    protected $productRepository;

    /**
     * @var SearchCriteriaBuilder
     */
    protected $searchCriteriaBuilder;

    /**
     * @var UpdatePublisher
     */
    protected $updatePublisher;

    /**
     * @var StoreManagerInterface
     */
    protected $storeManager;

    /**
     * @var MessageInterfaceFactory
     */
    protected $messageFactory;

    /**
     * ProductRepository constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param UpdatePublisher $updatePublisher
     * @param StoreManagerInterface $storeManager
     * @param MessageInterfaceFactory $messageFactory
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteria,
        UpdatePublisher $updatePublisher,
        StoreManagerInterface $storeManager,
        MessageInterfaceFactory $messageFactory
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteria;
        $this->updatePublisher = $updatePublisher;
        $this->storeManager = $storeManager;
        $this->messageFactory = $messageFactory;
    }

    /**
     * {@inheritdoc}
     */
    public function getByVPN($vpn)
    {
        $searchCriteria = $this->searchCriteriaBuilder->addFilter('vpn', $vpn)->create();

        $searchResult = $this->productRepository->getList($searchCriteria);

        return $searchResult;
    }

    /**
     * {@inheritdoc}
     */
    public function update(ProductInterface $product)
    {
        if (!$product->getEntityId()) {
            throw new \Magento\Framework\Exception\ValidatorException(__('Entity_ID is required'));
        }

        /** @var MessageInterface $message */
        $message = $this->messageFactory->create();
        $message->setData($product->getData());

        $storeId = $this->storeManager->getStore()->getId();
        $message->setStoreId($storeId);

        $this->updatePublisher->execute($message);
    }
}
