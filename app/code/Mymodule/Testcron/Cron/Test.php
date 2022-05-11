<?php

namespace Mymodule\Testcron\Cron;

use \Psr\Log\LoggerInterface;
use \Magento\Framework\Mail\Template\TransportBuilder;
use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\App\Response\Http\FileFactory;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\ResponseInterface;
use \Magento\Framework\App\Config\ScopeConfigInterface;
use \Magento\Framework\Stdlib\DateTime\TimezoneInterface;
use \Magento\Framework\Filesystem\Driver\File;


class Test extends Action
{
  const ADMIN_RESOURCE = 'Cminds_Marketplace::billing';


  /**
   * @var \Magento\Framework\App\Config\ScopeConfigInterface
   */
  protected $scopeConfig;

  /**
   * @var TimezoneInterface
   */
  protected $date;

  /**
   * @var File
   */
  protected $reader;

  /**
   * Response Http File factory.
   *
   * @var FileFactory
   */
  private $fileFactory;

  /**
   * @var \Psr\Log\LoggerInterface
   */
  protected $logger;

  /**
   * @var TransportBuilder
   */
  private $transportBuilder;

  /**
   * @var DirectoryList
   */
  protected $_dir;
  /**
   * @var    \Magento\Store\Model\StoreManagerInterface
   */
  protected $storeManager;

  /**
   * Test constructor.
   * @param LoggerInterface $logger
   * @param TransportBuilder $transportBuilder
   * @param DirectoryList $dir
   * @param Context $context
   * @param FileFactory $fileFactory
   * @param ScopeConfigInterface $scopeConfig
   *  @param TimezoneInterface $date
   * @param File $reader
   * @param  \Magento\Store\Model\StoreManagerInterface $storeManager
   */

  public function __construct(
    LoggerInterface $logger,
    TransportBuilder $transportBuilder,
    DirectoryList $dir,
    Context $context,
    FileFactory $fileFactory,
    ScopeConfigInterface $scopeConfig,
    TimezoneInterface $date,
    File $reader,
    \Magento\Store\Model\StoreManagerInterface $storeManager

  ) {
    $this->logger = $logger;
    $this->storeManager = $storeManager;
    $this->date = $date;
    $this->reader = $reader;
    $this->transportBuilder = $transportBuilder;
    $this->fileFactory = $fileFactory;
    $this->scopeConfig = $scopeConfig;
    $this->_dir = $dir;
    parent::__construct($context);
  }


  public function execute()
  {

    try {
      $newfileName = 'BillingReport_' . $this->date->date()->format('Y-m-d_H:i:s') . '.csv';
      $fileType = 'csv';
      //$this->_view->loadLayout();
      $fileName = 'billing.csv';
      $content = $this->_view->getLayout()
        ->createBlock(
          'Cminds\Marketplace\Block\Adminhtml'
            . '\Billing\Billinglist\Grid'
        )->getCsvFile($fileName);
      $filePath = $this->_dir->getPath('var') . "/" . $content['value'];

      $fileContent = $this->reader->fileGetContents($filePath, $flag = null, $context = null);
      $senderName = $this->scopeConfig->getValue('trans_email/ident_general/name', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); // sender name
      $mail_to = $this->scopeConfig->getValue('trans_email/ident_general/email', \Magento\Store\Model\ScopeInterface::SCOPE_STORE); // sender email id
      $senderEmail = $mail_to;
      $sendToEmail = 'jethavadarshana8347@gmail.com';
      $templateVars = [];
      $transport = $this->transportBuilder->setTemplateIdentifier('mymodule_testcron_attachment')
        ->setTemplateOptions(['area' => \Magento\Framework\App\Area::AREA_FRONTEND, 'store' => $this->storeManager->getStore()->getId()])
        ->setTemplateVars($templateVars)
        ->addAttachment($fileContent, $newfileName, $fileType)
        ->setFrom(["name" => $senderName, "email" => $senderEmail])
        ->addTo($sendToEmail)
        ->setReplyTo($sendToEmail)
        ->getTransport();
      $transport->sendMessage();
    } catch (Exception $e) {
      $this->logger->error($e);
    }
  }
}
