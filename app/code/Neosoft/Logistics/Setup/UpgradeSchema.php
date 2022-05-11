<?php

namespace Neosoft\Logistics\Setup;

use Magento\Framework\App\ResourceConnection;
use Magento\Framework\App\State;
use Magento\Framework\DB\Ddl\Table;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\UpgradeSchemaInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
/**
     * {@inheritdoc}
     *
     * @param SchemaSetupInterface   $setup   Setup object.
     * @param ModuleContextInterface $context Context object.
     *
     * @return void
     */
    public function upgrade(
        SchemaSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $setup->startSetup();

        if (version_compare($context->getVersion(), '1.0.0', '<')) {
            $setup->getConnection()->addColumn(
                $setup->getTable('sales_order_item'),
                'supplier_shipping_amount',
                [
                    'type' => Table::TYPE_DECIMAL,
                    'unsigned' => true,
                    'nullable' => false,
                    'default' => '0',
                    'comment' => 'supplier_shipping_amount',
                ]
                );
                }
                $setup->endSetup();
        }
}