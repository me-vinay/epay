<?php

namespace Mymodule\Webhook\Observer;
use Mymodule\Webhook\Model\Webhook;

class Order implements \Magento\Framework\Event\ObserverInterface{
    /**
     * @var Webhook
     */
    protected $webhook;
    protected $url;

    public function __construct(Webhook $webhook){
    $this->url = "https://eoov3xngsemayx7.m.pipedream.net";
    $this->webhook = $webhook;
    }

    public function execute(\Magento\Framework\Event\Observer $observer){
      $order = $observer->getOrder();
      $items =  $order->getItems();

      $body = [
               'event' => 'order_placed_after',
                'data' => $order->getData(),
                'items' => []
      ];

      foreach($items as $item){
      $body['items'][] = $item->getData();
      }
     $this->webhook->sendWebhook($this->url, $body);
    }
}