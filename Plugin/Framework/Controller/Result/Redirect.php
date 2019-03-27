<?php

namespace Magedirect\CustomCatalog\Plugin\Framework\Controller\Result;

use Magento\Framework\Controller\Result\Redirect as CoreRedirect;
use Magedirect\CustomCatalog\Helper\Data;

class Redirect
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
     * Before set url by path
     *
     * @param CoreRedirect $subject
     * @param string $path
     * @param array $params
     * @return array
     */
    public function beforeSetPath(
        CoreRedirect $subject,
        string $path,
        array $params = []
    ) {
        if ($this->helper->isCustomCatalogModule()) {
            $path = $this->helper->getCustomCatalogUrlFromCatalogUrl($path);
        }

        return [$path, $params];
    }
}
