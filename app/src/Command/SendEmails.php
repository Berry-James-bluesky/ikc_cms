<?php
/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky\Command;

use BlueSky\Queue\Worker\Dispatch\Email\Contact;
use BlueSky\Queue\Worker\Dispatch\Email\Quote;
use SidraBlue\Lote\Console\Command;
use SidraBlue\Lote\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Command for running the system cron
 */
class SendEmails extends Command
{

    use LockableTrait;

    /**
     * Configure the cron:run command
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this->setName('bluesky:email:all')
            ->setDescription('Send BlueSky emails');
    }

    /**
     * Command execution handler
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        try {
            if ($this->lock()) {
                $cw = new Contact();
                $cw->process(['reference' => $this->getState()->accountReference]);

                $cw = new Quote();
                $cw->process(['reference' => $this->getState()->accountReference]);

            }
        } finally {
            $this->release();
        }
    }

}
