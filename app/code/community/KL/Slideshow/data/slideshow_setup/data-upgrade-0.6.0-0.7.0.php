<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Add new column to `slide` table
 *
 */
$installer->getConnection()
    ->addColumn(
        $installer->getTable('slide'),
        'hover_effect',
        array(
            'nullable' => true,
            'length' => 255,
            'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
            'comment' => 'Hover effect',
            'default' => 'on'
        )
);
$installer->endSetup();
