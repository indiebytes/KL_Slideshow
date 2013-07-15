<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table for slideshows
 */
$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slideshow'))
    ->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Slideshow Id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable' => false
        ),
        'Title')
    ->addColumn('creation_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
        array(
        ),
        'Creation time')
    ->addColumn('update_time', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null,
        array(
        ),
        'Update time')
    ->addColumn('is_active', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'nullable' => false,
        ),
        'Is active')
    ->setComment('Slideshows');

$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slideshow_store'))
    ->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Slideshow Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Store Id')
    ->addIndex($installer->getIdxName('slideshow_store', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('slideshow_store', 'slideshow_id', 'slideshow', 'slideshow_id'),
        'slideshow_id', $installer->getTable('slideshow'), 'slideshow_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('slideshow_store', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Relations between slideshows and stores');

$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slideshow_slide'))
    ->addColumn('slideshow_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Slideshow Id')
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Store Id')
    ->addIndex($installer->getIdxName('slideshow_slide', array('slideshow_id')),
        array('slideshow_id'))
    ->addForeignKey($installer->getFkName('slideshow_slide', 'slide_id', 'slide', 'slide_id'),
        'slide_id', $installer->getTable('slide'), 'slide_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('slideshow_slide', 'slideshow_id', 'slideshow', 'slideshow_id'),
        'slideshow_id', $installer->getTable('slideshow'), 'slideshow_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Relations between slideshows and slides');

foreach ($tables as $table) {
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
