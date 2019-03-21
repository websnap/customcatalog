<?php

namespace Magedirect\CustomCatalog\Controller\Adminhtml\Product;

class Save extends \Magento\Catalog\Controller\Adminhtml\Product\Save
{

    /**
     * Save product action
     *
     * @return \Magento\Backend\Model\View\Result\Redirect
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $result */
        $resultRedirect = parent::execute();

        $redirectBack = $this->getRequest()->getParam('back', false);
        if ($redirectBack == 'edit') {
            $productId = $this->getRequest()->getParam('id');
            $resultRedirect->setPath(
                'customcatalog/*/' . $redirectBack,
                ['id' => $productId, 'back' => null, '_current' => true]
            );
        } else {
            $storeId = $this->getRequest()->getParam('store', 0);
            $resultRedirect->setPath('customcatalog/*/', ['store' => $storeId]);
        }

        return $resultRedirect;
    }

}
