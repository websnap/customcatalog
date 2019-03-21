<?php

namespace Magedirect\CustomCatalog\Model;

use Magento\Catalog\Api\ProductRepositoryInterface;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magedirect\CustomCatalog\Api\Data\ProductInterface;
use Magedirect\CustomCatalog\Model\Product\UpdatePublisher;

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
     * ProductRepository constructor.
     * @param ProductRepositoryInterface $productRepository
     * @param SearchCriteriaBuilder $searchCriteria
     * @param UpdatePublisher $updatePublisher
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function __construct(
        ProductRepositoryInterface $productRepository,
        SearchCriteriaBuilder $searchCriteria,
        UpdatePublisher $updatePublisher
    ) {
        $this->productRepository = $productRepository;
        $this->searchCriteriaBuilder = $searchCriteria;
        $this->updatePublisher = $updatePublisher;
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


        $this->updatePublisher->execute($product);
    }

}
