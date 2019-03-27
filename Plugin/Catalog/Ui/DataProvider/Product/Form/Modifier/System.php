<?php

namespace Magedirect\CustomCatalog\Plugin\Catalog\Ui\DataProvider\Product\Form\Modifier;

use Magento\Catalog\Ui\DataProvider\Product\Form\Modifier\System as CoreSystemModifier;
use Magedirect\CustomCatalog\Helper\Data;

class System
{

    /** @var Data */
    protected $helper;

    /**
     * @param Data $helper
     */
    public function __construct(Data $helper)
    {
        $this->helper = $helper;
    }

    /**
     * Substitute custom catalog URLs
     *
     * @param CoreSystemModifier $subject
     * @param array $result
     * @param array $data
     * @return array
     */
    public function afterModifyData(
        CoreSystemModifier $subject,
        array $result,
        array $data
    ) {

        if ($this->helper->isCustomCatalogModule()) {
            $config = $result['config'];
            foreach ($config as $key => $item) {
                $customCatalogUrl = $this->helper->getCustomCatalogUrlFromCatalogUrl($item);
                $config[$key] = $customCatalogUrl;
            }

            $result = array_replace_recursive($data, ['config' => $config]);
        }

        return $result;
    }
}
