<?php

/**
 * Copyright © Epayerz, Inc. All rights reserved.
 */

namespace Epay\Humanitarian\Controller\Index;

use \Magento\Framework\App\Action\Context;
use Epay\Humanitarian\Model\ItemsFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;
use \Magento\Framework\App\Action\Action;
use \Psr\Log\LoggerInterface;
use Magento\Framework\App\Filesystem\DirectoryList;

class Saveproduct extends Action {

    /**
     * @var Items
     */
    protected $_itemFactory;

    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @var Uploader
     */
    protected $uploaderFactory;

    /**
     * @var Adapter
     */
    protected $adapterFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * 
     * @param Context $context
     * @param ItemsFactory $itemFactory
     * @param UploaderFactory $uploaderFactory
     * @param AdapterFactory $adapterFactory
     * @param Filesystem $filesystem
     * @param LoggerInterface $logger
     */
    public function __construct(
            Context $context,
            ItemsFactory $itemFactory,
            UploaderFactory $uploaderFactory,
            AdapterFactory $adapterFactory,
            Filesystem $filesystem,
            LoggerInterface $logger
    ) {
        $this->_itemFactory = $itemFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->logger = $logger;
        parent::__construct($context);
    }

    /**
     * Index Saveproduct action
     * 
     * 
     */
    public function execute() {
        $data = (array) $this->getRequest()->getPost();
        if ($data) {
            $sku = $data['sku'];
            $name = $data['name'];
            $description = $data['description'];
            $pcktype = $data['package_type'];
            $maker = $data['maker'];
            $qty = $data['qnt_needed'];
        }

        $itemFactory = $this->_itemFactory->create();
        if (isset($_FILES['file_upload']['name']) && $_FILES['file_upload']['name'] != '') {

            try {
                $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'file_upload']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload', $imageAdapter, 'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(false);
                $uploaderFactory->setFilesDispersion(false);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('humanitarian/images');
                $result = $uploaderFactory->save($destinationPath);
                if (!$result) {
                    throw new LocalizedException(
                                    __('File cannot be saved to path: $1', $destinationPath)
                    );
                }
                $imagePath = 'humanitarian/images/' . $result['file'];
                $itemFactory->setData('image_path', $imagePath);
                $itemFactory->setData('product_sku', $sku);
                $itemFactory->setData('product_name', $name);
                $itemFactory->setData('description', $description);
                $itemFactory->setData('package_type', $pcktype);
                $itemFactory->setData('maker', $maker);
                $itemFactory->setData('qty', $qty);
                $itemFactory->setData('status', 0);
                if ($itemFactory->save()) {
                    $this->messageManager->addSuccessMessage(__('Data has been saved.'));
                } else {
                    $this->messageManager->addErrorMessage(__('Data has not been saved.'));
                }
                $resultRedirect = $this->resultRedirectFactory->create();
                $resultRedirect->setPath('human/index/addproducts');
                return $resultRedirect;
                //    $data['image_path'] = $imagePath;
            } catch (\Exception $e) {
                $this->messageManager->addError(__('please try again. Form Not Submit'));
            }
        }
    }

}
