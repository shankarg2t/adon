<?php
/**
 * @category    Inchoo
 * @package     Inchoo_Logger
 * @author      Branko Ajzele, ajzele@gmail.com
 * @copyright   Copyright (c) Inchoo
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$this->startSetup();

$this->run("
    CREATE TABLE  {$this->getTable('inchoo_logger_log')} (
    `log_id` INT(11) NOT NULL AUTO_INCREMENT,
    `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `action_name` VARCHAR(255),
    `controller_name` VARCHAR(255),
    `http_response_code` INT(3) NULL,
    `http_response_headers` TEXT NULL,
    `params_post` TEXT NULL,
    `params_get` TEXT NULL,
    `params_request` TEXT NULL,
    `params_files` TEXT NULL,
    `params_env` TEXT NULL,
    `params_cookie` TEXT NULL,
    `params_server` TEXT NULL,
    `params_session` TEXT NULL,
    `client_ip` VARCHAR(255),
    `controller_module` VARCHAR(255),
    `customer_id` INT(11) NULL,
    `user_id` INT(11) NULL,
    `area` VARCHAR(255) NULL,
    PRIMARY KEY (`log_id`)
    ) ENGINE = MYISAM ;
");

$this->endSetup();
