<?php
/**
 * Copyright © Epayerz, Inc. All rights reserved.
 */
namespace Epay\Humanitarian\Controller\Index;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Catalog\Model\ProductFactory;
use Epay\Humanitarian\Model\ItemsFactory;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;
use \Magento\Eav\Model\ResourceModel\Entity\Attribute\Set\CollectionFactory;


class Process extends Action
{
    /**
     *  @var PageFactory
     * 
     */
    protected $pageFactory;

    /**
     * @var type
     */
    protected $productFactory;

    /**
     * @var type
     */
    private $itemFactory;

    /**
     * @var Filesystem
     */
    protected $filesystem;

    /**
     * @var CollectionFactory
     */
    protected $_attributeSetCollection;
    /**
     * Prolist Constructor.
     * 
     * @param Context $context
     * @param PageFactory $pageFactory
     * @param ProductFactory $productFactory
     * @param ItemsFactory $itemFactory
     * @param Filesystem $filesystem
     * @param CollectionFactory $attributeSetCollection
     */
     
  
    public function __construct(
        Context $context,
        PageFactory $pageFactory,
        ProductFactory $productFactory,
        ItemsFactory $itemFactory,
        Filesystem $filesystem,
        CollectionFactory $attributeSetCollection
    )
    {
        $this->pageFactory = $pageFactory;
        $this->productFactory = $productFactory;
        $this->itemFactory = $itemFactory;
        $this->filesystem = $filesystem;
        $this->_attributeSetCollection = $attributeSetCollection;
        parent::__construct($context);
    }

    /**
     * Index Process Action Page
     * 
     * @return type
     */
    public function execute()
    { 
        $id = $this->getRequest()->getParam('id');
        $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA)->getAbsolutePath();
        if($id){
            $attributeSet = $this->_attributeSetCollection->create()->addFieldToSelect(
                    '*'
                    )->addFieldToFilter(
                            'attribute_set_name',
                            'humanitarian'
                    );
                    $attributeSetId = 0;
                    foreach($attributeSet as $attr):
                        $attributeSetId = $attr->getAttributeSetId();
                    endforeach;
            $item = $this->itemFactory->create()->load($id);
            $item->setStatus(1);
            $product =  $this->productFactory->create();
            $product->setAttributeSetId($attributeSetId); 
            $product->setSku($item['product_sku']);
            $product->setName($item['product_name']);
            $product->addImageToMediaGallery($mediaDirectory.$item['image_path'], array('image', 'small_image', 'thumbnail'), false, false); 
            $product->setStatus(1); 
            $product->setVisibility(4);
            $product->setTypeId('simple');
            $product->setStockData(array('is_in_stock' => 1,'qty' => $item['qty'] ));
            $product->setPrice(0);
            $product->setData('maker',$item['maker']);
            $product->setData('package_type',$item['package_type']);
            $product->setData('short_description',$item['description']);
            $product->setCategoryIds([10]);
            $product->setWebsiteIds([4]);   
            if ($product->save() && $item->save()) {
                $this->messageManager->addSuccessMessage(__('Request Approved'));
            } else {
                $this->messageManager->addErrorMessage(__('Something went wrong, Please try again.'));
            }    
            $resultRedirect = $this->resultRedirectFactory->create();
            $resultRedirect->setPath('human/index/prolist');
            return $resultRedirect; 
        }
      
    }

}