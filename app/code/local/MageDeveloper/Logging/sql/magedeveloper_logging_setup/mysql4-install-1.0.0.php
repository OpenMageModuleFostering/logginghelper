<?php
/**
 * MageDeveloper Logging Module
 * ----------------------------
 *
 * @category    Mage
 * @package     MageDeveloper_Logging
 * @copyright   Magento Developers / magedeveloper.de
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;

$installer->startSetup();

$installer->run("
DROP TABLE IF EXISTS {$installer->getTable('log_entity')};

CREATE TABLE IF NOT EXISTS {$installer->getTable('log_entity')} (
  `entity_id` int(10) NOT NULL AUTO_INCREMENT,
  `timestamp` timestamp NULL DEFAULT NULL,
  `log_type` int(1) NOT NULL,
  `class` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `output` longtext NOT NULL,
  PRIMARY KEY (`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

");

$installer->endSetup();