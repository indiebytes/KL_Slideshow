<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table for slides
 */
$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slide'))
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'identity' => true,
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true,
        ),
        'Slide Id')
    ->addColumn('title', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
            'nullable' => false
        ),
        'Title')
    ->addColumn('filename', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
        ),
        'Filename')
    ->addColumn('cta', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
        ),
        'Call To Action')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, 255,
        array(
        ),
        'URL')
    ->addColumn('content', Varien_Db_Ddl_Table::TYPE_TEXT, '2M',
        array(
        ),
        'Content'
    )
    ->addColumn('position', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
        ),
        'Position')
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
    ->setComment('Slideshow slides');

$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slide_store'))
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Slide Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null,
        array(
            'unsigned' => true,
            'nullable' => false,
            'primary'  => true
        ),
        'Store Id')
    ->addIndex($installer->getIdxName('slide_store', array('store_id')),
        array('store_id'))
    ->addForeignKey($installer->getFkName('slide_store', 'slide_id', 'slide', 'slide_id'),
        'slide_id', $installer->getTable('slide'), 'slide_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->addForeignKey($installer->getFkName('slide_store', 'store_id', 'core/store', 'store_id'),
        'store_id', $installer->getTable('core/store'), 'store_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Relations between slides and stores');

foreach ($tables as $table) {
    $installer->getConnection()->createTable($table);
}

$installer->endSetup();
