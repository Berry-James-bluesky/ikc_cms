<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */


namespace BlueSky\Queue\Worker\Dispatch\Email;

use BlueSky\Framework\Controller\Queue\Master as MasterController;
use BlueSky\Framework\Service\Email;
use BlueSky\Framework\State\Cli;
use BlueSky\Framework\View\Transform\Html\Service;
use SidraBlue\Util\Time;
use BlueSky\Framework\View\Transform\Html\Service as ContentService;

/**
 * Class Base
 * @package BlueSky\Queue\Worker\Dispatch\Email;
 */
class Base extends MasterController
{

    /**
     * @var string $actionReference - a reference for the email template determination and the log file of this class
     * */
    protected $actionReference = 'daily-email';

    /**
     * @var string $actionName - a name for this email dispatch action
     * */
    protected $actionName = 'Base';

    /**
     *
     * @access public
     * @param array $args - Arguments
     * @return void
     */
    public function process($args)
    {
        ini_set("memory_limit", '1024M');
        $this->getState()->getLoggers()->getMasterLogger("bluesky-dispatch" . $this->actionReference)->debug('New dispatch email request for ' . $this->actionName);
        $cli = new Cli($args['reference']);
        if ($this->hasEmailsToSend($cli, $args)) {
            $this->getState()->getLoggers()->getMasterLogger("bluesky-dispatch" . $this->actionReference)->debug('Emails to send for ' . $this->actionName);
            $this->sendEmails($cli, $args);
        } else {
            $this->getState()->getLoggers()->getMasterLogger("bluesky-dispatch" . $this->actionReference)->debug('Nothing to do for ' . $this->actionName);
        }
    }

    /**
     * Process daily emails
     *
     * @access protected
     * @param Cli $cli
     * @param array $args - Import arguments
     * @return boolean
     * @throws \Exception
     */
    protected function hasEmailsToSend($cli, $args)
    {
        throw new \Exception("Implement the 'hasEmailsToSend' function in the child");
    }

    /**
     * Process daily emails
     *
     * @access private
     * @param Cli $cli
     * @param array $args - Import arguments
     * @return void
     * @throws \Exception
     */
    protected function sendEmails($cli, $args)
    {
        throw new \Exception("Implement the 'sendEmails' function in the child");
    }

    /**
     * Get the email content
     *
     * @access private
     * @param Cli $cli
     * @param array $vars - Import arguments
     * @return string
     */
    protected function getEmailContent($cli, $vars)
    {
        $vars = array_merge($vars, ['email_reference' => $this->actionReference]);
        return Service::renderView(
            $cli,
            'email_templates/base',
            $vars,
            [LOTE_APP_PATH . 'view/admin/default/']
        );
    }

    /**
     * Get the email content
     *
     * @access private
     * @param Cli $cli
     * @param int $emailId
     * @return string
     */
    protected function markAsSent($cli, $emailId, $table = 'sb_bluesky_process_emails')
    {
        $cli->getWriteDb()->update($table, ['processed' => Time::getUtcNow()], ['id' => $emailId]);
    }

    /**
     * Get the email content
     *
     * @access private
     * @param Cli $cli
     * @param string $emailSubject
     * @param string $content
     * @return void
     */
    protected function sendCcEmails($cli, $emailSubject, $content, $attachments = [])
    {
        $ccAddresses = $this->getCarbonCopyAddresses();
        if (is_array($ccAddresses) && count($ccAddresses) > 0) {
            $es = new Email($cli);
            $es->sendEmail($emailSubject, $content, $ccAddresses,
                $cli->getSettings()->getSettingOrConfig("bluesky.process.from_email", 'mail@bluesky.com.au'),
                $cli->getSettings()->getSettingOrConfig("bluesky.process.from_name", 'BlueSky Team'), [], [], $attachments);
        }
    }

    /**
     * Get the list of CC emails to send a dispatch email to
     * @access protected
     * @return array
     * */
    protected function getCarbonCopyAddresses()
    {
        $data = ['tim@sidrablue.com.au'];
        return $data;
    }

}
