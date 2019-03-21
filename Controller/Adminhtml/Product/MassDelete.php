<?php

namespace Magedirect\CustomCatalog\Controller\Adminhtml\Product;

class MassDelete extends \Magento\Catalog\Controller\Adminhtml\Product\MassDelete
{

    /**
     * @return \Magento\Backend\Model\View\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $result */
        $resultRedirect = parent::execute();

        $resultRedirect->setPath('customcatalog/*/index');

        return $resultRedirect;
    }

}
