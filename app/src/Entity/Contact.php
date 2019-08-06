<?php
namespace BlueSky\Entity;

use BlueSky\Framework\Object\Entity\Base;

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
    public const TABLE_NAME = 'sb_bluesky_contact';

    /**
     * @dbColumn lastname
     * @fieldType string
     * @dbOptions length=255, notnull = false
     * @var string $lastname - lastname
     */
    public $lastname;

    /**
     * @dbColumn phone
     * @fieldType string
     * @dbOptions length=255, notnull = false
     * @var string $phone - phone
     */
    public $phone;

    /**
     * @dbColumn email
     * @fieldType string
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

    /**
     * @dbColumn contact_preference
     * @fieldType string
     * @dbOptions length=255, notnull = false
     * @var string $contact_preference - contact preference
     */
    public $contact_preference;

}