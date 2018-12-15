<?php

/**
 * This file is part of the Lote project by Sidra Blue.
 * http://sidrablue.com/lote/
 */

namespace BlueSky\Command\Email;

use BlueSky\Queue\Worker\Dispatch\Email\Contact as ContactDispatch;
use SidraBlue\Lote\Console\Command;
use SidraBlue\Lote\Console\Command\LockableTrait;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Command for running the system cron
 */
class Contact extends Command
{

    use LockableTrait;

    /**
     * Configure the cron:run command
     * @access protected
     * @return void
     */
    protected function configure()
    {
        $this->setName('bluesky:email:contact')
            ->setDescription('Send Contact emails');
    }

    /**
     * Command execution handler
     * @access protected
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int|null|void
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        try {
            if ($this->lock()) {
                $cw = new ContactDispatch();
                $cw->process(['reference' => $this->getState()->accountReference]);
                $io->success("Done");
            }
        } catch (\Exception $e) {
            $this->getState()->getLoggers()->getMasterLogger("bluesky")->error("bluesky-email-contact", $e->getMessage());
        } finally {
            $this->release();
        }
    }

}
