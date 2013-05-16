<?php
$installer = $this;
/* @var $installer Mage_Core_Model_Resource_Setup */

$installer->startSetup();

$installer->run("

-- DROP TABLE IF EXISTS {$this->getTable('slide')};
CREATE TABLE {$this->getTable('slide')} (
  `slide_id` smallint(6) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  `file_name` varchar(100) default NULL,
  `url` varchar(400) default NULL,
  `creation_time` datetime default NULL,
  `update_time` datetime default NULL,
  `position` smallint(6) default NULL,
  `is_active` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`slide_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- DROP TABLE IF EXISTS {$this->getTable('slide_store')};
CREATE TABLE {$this->getTable('slide_store')} (
  `slide_id` smallint(6) NOT NULL,
  `store_id` smallint(5) unsigned NOT NULL,
  PRIMARY KEY  (`slide_id`,`store_id`),
  KEY `FK_SLIDE_STORE_STORE` (`store_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE {$this->getTable('slide_store')}
  ADD CONSTRAINT `FK_SLIDE_STORE_SLIDE` FOREIGN KEY (`slide_id`) REFERENCES {$this->getTable('slide')} (`slide_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_SLIDE_STORE_STORE` FOREIGN KEY (`store_id`) REFERENCES `core_store` (`store_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
    ");

$installer->endSetup();
