<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Add new column to `slide` table
 *
 */

$columns = array(
    'alternative_filename'
);

foreach ($columns as $column) {
    $installer->getConnection()
        ->addColumn(
            $installer->getTable('slide'),
            $column,
            array(
                'nullable' => true,
                'length' => 255,
                'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                'comment' => 'alternative_filename'
            )
        );
}

$installer->endSetup();