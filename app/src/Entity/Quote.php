<?php
namespace BlueSky\Entity;

use SidraBlue\Lote\Object\Entity\Base;

/**
 * Base class for Quote
 * @package BlueSky\Entity
 * @dbEntity true
 */
class Quote extends Base
{

    /**
     * @var string $tableName
     * The name of the table to override the class name if required
     * */
    protected $tableName = 'sb_bluesky_quote';

    /**
     * @dbColumn firstname
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $firstname - firstname
     */
    public $firstname;

    /**
     * @dbColumn lastname
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $lastname - lastname
     */
    public $lastname;

    /**
     * @dbColumn middlename
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $middlename - middlename
     */
    public $middlename;

    /**
     * @dbColumn email
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $email - email
     */
    public $email;

    /**
     * @dbColumn phone
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $phone - phone
     */
    public $phone;

    /**
     * @dbColumn project_summary
     * @dbType text
     * @dbOptions notnull = false
     * @var string $project_summary - project summary
     */
    public $project_summary;

    /**
     * @dbColumn file_id
     * @dbType integer
     * @dbOptions notnull = false
     * @dbIndex true
     * @var integer $file_id - file id
     */
    public $file_id;

}