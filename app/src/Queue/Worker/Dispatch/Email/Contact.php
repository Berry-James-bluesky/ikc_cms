<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky\Queue\Worker\Dispatch\Email;

use BlueSky\Framework\Service\Email;
use BlueSky\Framework\State\Cli;
use BlueSky\Model\ProcessEmails as ProcessEmailsModel;

/**
 * Class Base for Contact
 * @package BlueSky\Queue\Worker\Dispatch\Email;
 */
class Contact extends Base
{

    /**
     * @var string $actionReference - a reference for the email template determination and the log file of this class
     * */
    protected $actionReference = 'contact';

    /**
     * @var string $actionName - a name for this email dispatch action
     * */
    protected $actionName = 'Contact';

    /**
     * Process daily emails
     *
     * @access protected
     * @param Cli $cli
     * @param array $args - Import arguments
     * @return boolean
     */
    protected function hasEmailsToSend($cli, $args)
    {
        $pem = new ProcessEmailsModel($cli);
        return $pem->hasEmailsToProcess($this->actionReference);
    }

    /**
     * Process daily emails
     *
     * @access private
     * @param Cli $cli
     * @param array $args - Import arguments
     * @return void
     */
    protected function sendEmails($cli, $args)
    {
        $pem = new ProcessEmailsModel($cli);
        $emailsToProcess = $pem->getEmailsToProcess($this->actionReference);
        if (!empty($emailsToProcess)) {
            foreach ($emailsToProcess as $emailData) {
                $data = (array)json_decode($emailData['data']);
                $content = $this->getEmailContent($cli, $data);
                $es = new Email($cli);
                if ($cli->getSettings()->get("bluesky.real_emails_enabled") == "1") {
                    $data['email_to_address'] = $cli->getSettings()->getSettingOrConfig("bluesky.admin.email", 'amel@blueskylabs.com.au');
                    $es->sendEmail(
                        $data['email_subject'],
                        $content,
                        $data['email_to_address'],
                        $cli->getSettings()->getSettingOrConfig(
                            "bluesky.process.from_email",
                            'tim@sidrablue.com.au'
                        ),
                        $cli->getSettings()->getSettingOrConfig(
                            "bluesky.process.from_name",
                            'BlueSky Development Team'
                        )
                    );
                }
                $this->sendCcEmails($cli, $data['email_subject'], $content);
                $this->markAsSent($cli, $emailData['id']);
            }
        }

    }

}
