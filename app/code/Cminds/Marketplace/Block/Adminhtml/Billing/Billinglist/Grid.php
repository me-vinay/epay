<?php

namespace Cminds\Marketplace\Block\Adminhtml\Billing\Billinglist;

use Cminds\Marketplace\Model\ResourceModel\Payment as PaymentResource;
use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Grid\Extended;
use Magento\Backend\Helper\Data;
use Magento\Directory\Model\Currency;
use Magento\Framework\DataObject;
use Magento\Framework\DataObjectFactory;
use Magento\Sales\Model\Order\Config as OrderConfig;

class Grid extends Extended
{
    /**
     * Order config object.
     *
     * @var OrderConfig
     */
    private $orderConfig;

    /**
     * Payment resource object.
     *
     * @var PaymentResource
     */
    private $paymentResource;

    /**
     * Data object factory object.
     *
     * @var DataObjectFactory
     */
    private $dataObjectFactory;

    /**
     * Grid constructor.
     *
     * @param Context           $context
     * @param Data              $backendHelper
     * @param OrderConfig       $config
     * @param PaymentResource   $paymentResource
     * @param DataObjectFactory $dataObjectFactory
     * @param array             $data
     */
    public function __construct(
        Context $context,
        Data $backendHelper,
        OrderConfig $config,
        PaymentResource $paymentResource,
        DataObjectFactory $dataObjectFactory,
        array $data = []
    ) {
        parent::__construct(
            $context,
            $backendHelper,
            $data
        );

        $this->orderConfig = $config;
        $this->paymentResource = $paymentResource;
        $this->dataObjectFactory = $dataObjectFactory;
    }

    /**
     * @return void
     */
    protected function _construct() // @codingStandardsIgnoreLine
    {
        parent::_construct();

        $this->setId('supplier_list');
        $this->setDefaultSort('entity_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    /**
     * @return Grid
     */
    protected function _prepareCollection() // @codingStandardsIgnoreLine
    {
        $this->setCollection($this->paymentResource->getAdminGridCollection());
        parent::_prepareCollection();

        return $this;
    }

    /**
     * @return Extended
     * @throws \Exception
     */
    protected function _prepareColumns() // @codingStandardsIgnoreLine
    {
        $isDiscountEff = $this->_scopeConfig->getValue(
            'configuration_marketplace/configure/is_discount_effective'
        );
        $this->addColumn(
            'supplier_id',
            [
                'header' => __('Vendor Name'),
                'index' => 'vendor_name',
                'type' => 'text',
                'filter_condition_callback' => [$this, 'filterVendor']
            ]
        );
        $this->addColumn(
            'increment_id',
            [
                'header' => __('Order ID'),
                'index' => 'increment_id',
                'filter_index' => 'o.increment_id',
                'type' => 'text',

            ]
        );
        $this->addColumn(
            'created_at',
            [
                'header' => __('Order Date'),
                'index' => 'created_at',
                'type' => 'datetime',
                'filter_index' => 'o.created_at',
                'gmtoffset' => true,
            ]
        );
        $this->addColumn(
            'order_status',
            [
                'header' => __('Order Status'),
                'index' => 'status',
                'type' => 'options',
                'options' => $this->orderConfig->getStatuses(),
            ]
        );
        $this->addColumn(
            'total_qty',
            [
                'header' => __('Order Qty'),
                'index' => 'total_qty',
                'filter_index' => 'main_table.qty_ordered',
                'type' => 'number',
            ]
        );

        $this->addColumn(
            'total_price',
            [
                'header' => __('Actual Price'),
                'index' => 'total_price',
                'type' => 'price',
                'filter_index' => 'main_table.row_total',
                'currency_code' => (string)$this->_scopeConfig
                    ->getValue(Currency::XML_PATH_CURRENCY_BASE),
            ]
        );

        $this->addColumn(
            'total_vendor_income',
            [
                'header' => __('Discounted Price'),
                'index' => 'total_vendor_income',
                'type' => 'price',
                'filter_index' => 'main_table.vendor_income',
                'currency_code' => (string)$this->_scopeConfig
                    ->getValue(Currency::XML_PATH_CURRENCY_BASE),
            ]
        );
      

        /*if ($isDiscountEff) {
            $this->addColumn(
                'discount_amount',
                [
                    'header' => __('Discount'),
                    'width' => '100',
                    'index' => 'discount_amount',
                    'type' => 'price',
                    'currency_code' => (string)$this->_scopeConfig
                        ->getValue(Currency::XML_PATH_CURRENCY_BASE),
                ]
            );
            $this->addColumn(
                'vendor_amount_with_discount',
                [
                    'header' => __('With discount'),
                    'width' => '100',
                    'index' => 'vendor_amount_with_discount',
                    'type' => 'price',
                    'currency_code' => (string)$this->_scopeConfig
                        ->getValue(Currency::XML_PATH_CURRENCY_BASE),
                ]
            );
        }*/

        $this->addColumn(
            'total_paid_amount',
            [
                'header' => __('Amount Paid'),
                'index' => 'total_paid_amount',
                'type' => 'price',
                'filter_index' => 'pi.value',
                'currency_code' => (string)$this->_scopeConfig
                    ->getValue(Currency::XML_PATH_CURRENCY_BASE),
            ]
        );
        $this->addColumn(
            'fees',
            [
                'header' => __('Fees'),
                'index' => 'fees',
                'totals_label' => '',
                'filter' => false,
                'align' => 'center',
                'type' => 'price',
                'renderer' => '\Cminds\Marketplace\Block\Adminhtml'
                    . '\Billing\Billinglist\Grid\Renderer\Fees',
            ]
        );
        $this->addColumn(
            'owning',
            [
                'header' => __('Amount Owed to Vendor'),
                'index' => 'owning',
                'totals_label' => '',
                'filter' => false,
                'align' => 'center',
                'type' => 'price',
                'renderer' => '\Cminds\Marketplace\Block\Adminhtml'
                    . '\Billing\Billinglist\Grid\Renderer\Owning',
            ]
        );

        /*if ($isDiscountEff) {
            $this->addColumn(
                'owning_with_discount',
                [
                    'header' => __('With Discount'),
                    'index' => 'owning_with_discount',
                    'totals_label' => '',
                    'filter' => false,
                    'align' => 'center',
                    'type' => 'price',
                    'renderer' => '\Cminds\Marketplace\Block\Adminhtml'
                        . '\Billing\Billinglist\Grid\Renderer\Owningdiscount',
                ]
            );
        }

        $this->addColumn(
            'action',
            [
                'header' => __('Action'),
                'type' => 'action',
                'renderer' => '\Cminds\Marketplace\Block\Adminhtml'
                    . '\Billing\Billinglist\Grid\Renderer\Action',
                'totals_label' => '',
                'filter' => false,
                'sortable' => false,
                'is_system' => true,
            ]
        );*/


        $this->addExportType('*/*/exportCsv', __('CSV'));
        $this->addExportType('*/*/exportXml', __('Excel XML'));

        return parent::_prepareColumns();
    }

    /**
     * @return DataObject
     */
    public function getTotals()
    {
        $totals = $this->dataObjectFactory->create();

        $fields = [
            'payment_amount' => 0,
            'vendor_amount' => 0,
            'subtotal' => 0,
            'owning' => 0,
        ];

        foreach ($this->getCollection() as $item) {
            foreach ($fields as $field => $value) {
                if ($field !== 'owning') {
                    $fields[$field] += $item->getData($field);
                }
            }
        }
        $fields['supplier_id'] = 'Totals';
        $totals->setData($fields);

        return $totals;
    }

    /**
     * @param \Magento\Framework\Data\Collection\AbstractDb $collection
     * @param \Magento\Backend\Block\Widget\Grid\Column\Extended $column
     * @return $this
     */
    public function filterVendor($collection, $column)
    {
        $cond = $collection->getSelect()
            ->getConnection()
            ->prepareSqlCondition(
                new \Zend_Db_Expr('concat_ws(" ", c.firstname, c.lastname)'),
                $column->getFilter()->getCondition()
            );
        $collection->getSelect()->where($cond);
        return $this;
    }
}
