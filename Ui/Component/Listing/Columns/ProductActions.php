<?php

namespace Magedirect\CustomCatalog\Ui\Component\Listing\Columns;

/**
 * Class ProductActions
 *
 * @api
 * @since 100.0.2
 */
class ProductActions extends \Magento\Catalog\Ui\Component\Listing\Columns\ProductActions
{

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        if (isset($dataSource['data']['items'])) {
            $storeId = $this->context->getFilterParam('store_id');

            foreach ($dataSource['data']['items'] as &$item) {
                $item[$this->getData('name')]['edit'] = [
                    'href' => $this->urlBuilder->getUrl(
                        'customcatalog/product/edit',
                        ['id' => $item['entity_id'], 'store' => $storeId]
                    ),
                    'label' => __('Edit'),
                    'hidden' => false,
                ];
            }
        }

        return $dataSource;
    }
}
