<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Add new column to `slide` table
 *
 */

$columns = array(
    'category' => 'Slideshow category',
    'template' => 'Custom template',
);


foreach ($columns as $column => $name) {
    $installer->getConnection()
        ->addColumn(
            $installer->getTable('slideshow'),
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
