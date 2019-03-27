<?php

namespace Magedirect\CustomCatalog\Helper;

use Magento\Framework\App\Request\Http;

class Data
{
    /** @var Http */
    protected $request;

    /**
     * Custom catalog helper
     *
     * @param Http $request
     */
    public function __construct(Http $request)
    {
        $this->request = $request;
    }

    /**
     * Check if current module is CustomCatalog
     *
     * @return bool
     */
    public function isCustomCatalogModule()
    {
        if ($this->request->getModuleName() == 'customcatalog') {
            return true;
        }

        return false;
    }

    /**
     * Substitute catalog route in URL by custom catalog route
     *
     * @param string $url
     * @return string
     */
    public function getCustomCatalogUrlFromCatalogUrl($url)
    {
        return str_replace('catalog/', 'customcatalog/', $url);
    }
}
