<?php
 
 
namespace Mymodule\Webhook\Model;
 
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\HTTP\Adapter\CurlFactory;
use Psr\Log\LoggerInterface;
 
/**
 * Class Webhook
 * @package Mymodule\Webhook\Model
 */
class Webhook
{
    /**
     * @var CurlFactory
     */
    protected $curlFactory;
     
 
   
    /**
     * @var LoggerInterface
     */
    private $logger;
 
    /**
     * Webhook constructor.
     * @param CurlFactory $curlFactory
     * @param LoggerInterface $logger
     */
    public function __construct(
        CurlFactory $curlFactory,
        LoggerInterface $logger
    ) {
        $this->curlFactory = $curlFactory;
        $this->logger = $logger;
    }
 
    /**
     * @param string $url
     * @param array $body
     * @return void
     * @throws NoSuchEntityException
     */
    public function sendWebhook($url, $body): void
    {
        $headers = ['Content-type: application/json'];
        $bodyJson = json_encode($body);
 
        $client = $this->curlFactory->create();
        $client->addOption(CURLOPT_CONNECTTIMEOUT, 2);
        $client->addOption(CURLOPT_TIMEOUT, 3);
        $client->write(\Zend_Http_Client::POST, $url, '1.1', $headers, $bodyJson);
 
        $response = $client->read();
        $responseCode = \Zend_Http_Response::extractCode($response);
 
        if ($responseCode !== 200) {
            $this->logger->log(100, 'Failed to send a message to the following Webhook: ' . $url);
        }
 
        $client->close();
    }
 
    
     
}