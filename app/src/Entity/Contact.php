<?php
namespace BlueSky\Entity;

use SidraBlue\Lote\Object\Entity\Base;

/**
 * Base class for Contact
 * @package BlueSky\Entity
 * @dbEntity true
 */
class Contact extends Base
{

    /**
     * @var string $tableName
     * The name of the table to override the class name if required
     * */
    protected $tableName = 'sb_bluesky_contact';

    /**
     * @dbColumn lastname
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $lastname - lastname
     */
    public $lastname;

    /**
     * @dbColumn phone
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $phone - phone
     */
    public $phone;

    /**
     * @dbColumn email
     * @dbType string
     * @dbOptions length=255, notnull = false
     * @var string $email - email
     */
    public $email;

    /**
     * @dbColumn about
     * @dbType text
     * @dbOptions notnull = false
     * @var string $about - about
     */
    public $about;

    /**
     * @dbColumn comments
     * @dbType text
     * @dbOptions notnull = false
     * @var string $comments - comments
     */
    public $comments;

    /**
     * @dbColumn is_mailing
     * @dbType boolean
     * @dbOptions notnull = false
     * @var boolean $is_mailing - is mailing
     */
    public $is_mailing;

}