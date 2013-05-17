<?php
/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;
$installer->startSetup();

/**
 * Create table for slides
 */
$tables[] = $installer->getConnection()
    ->newTable($installer->getTable('slide'))
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
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
    ->addColumn('slide_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'Slide Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null,
        array(
            'unsigned' => true,
            'nullable' => false,
        ),
        'Store Id')
    ->setComment('Relations between slides and stores');

foreach ($tables as $table) {
    $installer->getConnection()->createTable($table);
}

/**
 * Add constraints
 */
$installer->getConnection()->addConstraint(
    'FK_SLIDE_STORE_SLIDE',
    $this->getTable('slide_store'),
    'slide_id',
    $this->getTable('slide'),
    'slide_id',
    'cascade', 
    'cascade'
);

$installer->getConnection()->addConstraint(
    'FK_SLIDE_STORE_STORE',
    $this->getTable('slide_store'),
    'store_id',
    $this->getTable('core_store'),
    'store_id',
    'cascade', 
    'cascade'
);

$installer->endSetup();
