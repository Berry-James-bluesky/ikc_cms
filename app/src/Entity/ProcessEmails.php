<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */
namespace BlueSky\Entity;

use BlueSky\Framework\Object\Entity\Base;

/**
 * Base class for ProcessEmails
 * @package BlueSky\Entity
 * @dbEntity true
 */
class ProcessEmails extends Base
{

    /**
     * @var string $tableName
     * The name of the table to override the class name if required
     * */
    protected $tableName = 'sb_bluesky_process_emails';
    public const TABLE_NAME = 'sb_bluesky_process_emails';

    /**
     * @dbColumn email_type
     * @fieldType string
     * @dbOptions length=255, notnull = false
     * @var string $email_type
     */
    public $email_type;

    /**
     * @dbColumn object_ref
     * @fieldType string
     * @dbOptions length=255, notnull = false
     * @var string $object_ref
     */
    public $object_ref;


    /**
     * @dbColumn object_id
     * @dbType integer
     * @dbOptions notnull = false
     * @var int $object_id - object id
     */
    public $object_id;

    /**
     * @dbColumn data
     * @dbType text
     * @dbOptions notnull = false
     * @var string $data - data
     */
    public $data;

    /**
     * @dbColumn processed
     * @dbType datetime
     * @dbOptions notnull = false
     * @var string $processed - processed
     */
    public $processed;

    /**
     * @dbColumn scheduled
     * @dbType datetime
     * @dbOptions notnull = false
     * @var string $scheduled - scheduled
     */
    public $scheduled;

}
