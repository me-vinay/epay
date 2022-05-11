<?php

namespace Cminds\Marketplacebilling\Controller\Adminhtml\Billing;

use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;

class ExportXml extends Action
{
    const ADMIN_RESOURCE = 'Cminds_Marketplacebilling::billing';

    /**
     * Response Http File factory.
     *
     * @var FileFactory
     */
    private $fileFactory;

    /**
     * ExportXml constructor.
     *
     * @param Context $context
     * @param FileFactory $fileFactory
     */
    public function __construct(
        Context $context,
        FileFactory $fileFactory
    ) {
        $this->fileFactory = $fileFactory;

        parent::__construct($context);
    }

    /**
     * Execute controller main logic. Export data in xml format.
     *
     * @return ResponseInterface
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $fileName = 'billing.xml';
        $content = $this->_view->getLayout()
            ->createBlock(
                'Cminds\Marketplacebilling\Block\Adminhtml'
                . '\Billing\Billinglist\Grid'
            );

        return $this->fileFactory->create(
            $fileName,
            $content->getExcelFile($fileName),
            DirectoryList::VAR_DIR
        );
    }
}
