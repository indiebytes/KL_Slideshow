<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table for slideshow categories
 */
$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slideshow_category'))
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Category Id')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable' => false
        ),
        'Name');

/**
 * Create table for slideshow categories connections
 */
$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slideshow_to_category'))
    ->addColumn('category_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false
        ),
        'Category Id')
    ->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false
        ),
        'Slideshow Id')
    ->addIndex('connection', array('category_id', 'slideshow_id'));

foreach ($tables as $table) {
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();