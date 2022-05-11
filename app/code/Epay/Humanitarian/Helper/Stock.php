<?php
namespace Epay\Humanitarian\Helper;
use  \Magento\Framework\App\Helper\Context;
use \Epay\Humanitarian\Model\ResourceModel\Items\CollectionFactory;
use \Magento\Directory\Model\ResourceModel\Country\CollectionFactory as CountryCollectionFactory;
use \Magento\Directory\Model\CountryFactory;
use Magento\CatalogInventory\Api\StockStateInterface;

class Stock extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @var StockStateInterface
     */
    protected $stockState;

    /**
     * 
     * @var type
     */
    private $itemCollection;

    /**
     * 
     * @var CountryCollectionFactory
     */
    private $_countryCollectionFactory;

    /**
     * 
     * @var CountryFactory
     */
    private $countryFactory;


    /**
     * Output constructor.
     * @param CollectionFactory $itemCollection
     * @param  CountryCollectionFactory $countryCollectionFactory
     * @param Context $context
     * @param StockStateInterface $stockState
     */
    public function __construct(
        Context $context,
        StockStateInterface $stockState,
        CollectionFactory $itemCollection,
        CountryCollectionFactory $countryCollectionFactory,
        CountryFactory $countryFactory,
        array $data = []
    ) {
        $this->stockState = $stockState;
        $this->itemCollection = $itemCollection;
        $this->_countryCollectionFactory = $countryCollectionFactory;
        $this->countryFactory = $countryFactory;
        parent::__construct($context);
    }

    /**
     * Retrieve stock qty whether product
     *
     * @param int $productId
     * @param int $websiteId
     * @return float
     */
    public function getStockQty($productId, $websiteId = null)
    {
        return $this->stockState->getStockQty($productId, $websiteId);
    }

    /**
     * @return string
     */

    public function getCountryName($countryCode){
        $country = $this->countryFactory->create()->loadByCode($countryCode);
        return $country->getName();
    }

    /**
     * @return array
     */
    public function getCountryCollection()
    {
        $collection = $this->_countryCollectionFactory->create()->loadByStore();
        return $collection;
    }

    /**
     * get array of countries name
     * 
     * @return array
     */
 
    public function getCountries()
   {
    $countryCollection = $this->getCountryCollection();

    $countries = [];
    foreach ($countryCollection->getData() as $country) {
        $countries[$country['country_id']] = $this->getCountryName($country['country_id']);
    }
    return $countries;
   }
}