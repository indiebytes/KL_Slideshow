<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();

/**
 * Add new columns to `slide` table
 *
 */

    $installer->getConnection()
        ->addColumn(
            $installer->getTable('slide'),
            'image_title',
            array(
                'nullable' => true,
                'length' => 255,
                'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                'comment' => 'image_title'
            )
        );

    $installer->getConnection()
        ->addColumn(
            $installer->getTable('slide'),
            'image_alt',
            array(
                'nullable' => true,
                'length' => 255,
                'type' => Varien_Db_Ddl_Table::TYPE_TEXT,
                'comment' => 'image_alt'
            )
        );

$installer->endSetup();