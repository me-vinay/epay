<?php
 /**
  * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace CustomModule\Myjs\Controller\Index;
use \Magento\Framework\App\Action\Context;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Framework\App\Action\Action;
use Magento\Catalog\Model\ProductFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\Image\AdapterFactory;
use Magento\Framework\Filesystem;

class Save extends Action{
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
    * @var PageFactory
    */
    protected $_pageFactory;

     /**
     * @var type
     */
    protected $productFactory;
    /** 
     * @param  Context $context,
     * @param PageFactory $pageFactory
     * @param ProductFactory $productFactory
     * @param ItemsFactory $itemFactory
     * @param UploaderFactory $uploaderFactory
     * @param AdapterFactory $adapterFactory
     * @param Filesystem $filesystem
     */
      public function __construct(
           Context $context,
           PageFactory $pageFactory,
           ProductFactory $productFactory,
           UploaderFactory $uploaderFactory,
           AdapterFactory $adapterFactory,
           Filesystem $filesystem
      ){
        $this->productFactory = $productFactory;
        $this->uploaderFactory = $uploaderFactory;
        $this->adapterFactory = $adapterFactory;
        $this->filesystem = $filesystem;
        $this->_pageFactory = $pageFactory;
           return parent::__construct($context);
      }

    /**
     * 
     * @return Page
     */
     public function execute()
     {
        $product = $this->productFactory->create();
        $product->setSku('demo-sku'); // Set your sku here
        $product->setName('demo product name'); // Name of Product
        $product->setAttributeSetId(15); // Attribute set id
        $product->setStatus(1); // Status on product enabled/ disabled 1/0
       // $product->setWeight(10); // weight of product
        $product->setVisibility(4); // visibilty of product (catalog / search / catalog, search / Not visible individually)
      //  $product->setTaxClassId(0); // Tax class id
        $product->setTypeId('simple'); // type of product (simple/virtual/downloadable/configurable)
        $product->setPrice(0); // price of product
        $product->setStockData(
                            array(
                                
                              
                                'is_in_stock' => 1,
                                'qty' => 9999
                            )
                        );
    $product->setCategoryIds([9,11]);           
      $product->setWebsiteIds([4]); 
           // $imagePath = $_FILES['demo_upload']['name']; // path of the image
           $images = $this->getRequest()->getFiles('demo_upload');

           $uploaderFactory = $this->uploaderFactory->create(['fileId' => 'demo_upload']);
                $uploaderFactory->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
                $imageAdapter = $this->adapterFactory->create();
                $uploaderFactory->addValidateCallback('custom_image_upload', $imageAdapter, 'validateUploadFile');
                $uploaderFactory->setAllowRenameFiles(true);
                $uploaderFactory->setFilesDispersion(false);
                $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
                $destinationPath = $mediaDirectory->getAbsolutePath('humanitarian/images');
                $result = $uploaderFactory->save($destinationPath);   

                $imagePath = $destinationPath.'/'. $result['file'];

          //  var_dump($destinationPath.'/'. $result['file']);
           $product->addImageToMediaGallery($imagePath, array('image', 'small_image', 'thumbnail'), false, false);
            if($product->save()){
            $this->messageManager->addSuccessMessage(__('Data has been saved.'));}
            else{
            $this->messageManager->addErrorMessage(__('Data has not been saved.'));

            }
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('customjs/index/form');
            return $resultRedirect;
     }
}