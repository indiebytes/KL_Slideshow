<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Add new column to `slide` table
 *
 */

$columns = array(
    'custom_size' => 'Custom size',
    'custom_style' => 'Custom style',
    'custom_template' => 'Custom template',
);


foreach ($columns as $column => $name) {
    $installer->getConnection()
        ->addColumn(
            $installer->getTable('slide'),
            $column,
            array(
                'nullable' => true,
                'length' => 255,
                'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                'comment' => $name
            )
        );
}

$installer->endSetup();
