<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */
namespace BlueSky\Model;

use BlueSky\Framework\Object\Model\Base;

class ProcessEmails extends Base
{

    /**
     * @param string $tableName
     * */
    protected $tableName = 'sb_bluesky_process_emails';

    /**
     * Check if there are emails to process
     *
     * @access public
     * @param string $emailType - Email Type
     * @return boolean
     */
    public function hasEmailsToProcess($emailType)
    {
        $q = $this->getReadDb()->createQueryBuilder();
        $q->select('count(*) as count')
            ->from($this->tableName, 'e')
            ->where('e.email_type = :email_type')
            ->setParameter('email_type', $emailType)
            ->andWhere('(e.scheduled < now() or e.scheduled is null)')
            ->andWhere('e.processed is null');
        $q->andWhere("e.lote_deleted is null");

        $s = $q->execute();
        $result = $s->fetch(\PDO::FETCH_ASSOC);
        return $result['count'] > 0;

    }

    /**
     * Get Emails to process
     *
     * @access public
     * @param string $emailType - Email Type
     * @return array|false
     */
    public function getEmailsToProcess($emailType)
    {
        $q = $this->getReadDb()->createQueryBuilder();
        $q->select('e.*')
            ->from($this->tableName, 'e')
            ->where('e.email_type = :email_type')
            ->setParameter('email_type', $emailType)
            ->andWhere('(e.scheduled < now() or e.scheduled is null)')
            ->andWhere('e.processed is null');
        $q->andWhere("e.lote_deleted is null");

        $s = $q->execute();
        $result = $s->fetchAll(\PDO::FETCH_ASSOC);
        return $result;

    }

}
