<?php
declare( strict_types = 1 );

namespace App\Command;

use App\Utility\CoinSync;
use Cake\Command\Command;
use Cake\Console\Arguments;
use Cake\Console\ConsoleIo;

/**
 * CoinSync command.
 */
class CoinSyncCommand extends Command {

    /**
     * Implement this method with your command's logic.
     *
     * @param \Cake\Console\Arguments $args The command arguments.
     * @param \Cake\Console\ConsoleIo $io The console io
     * @return null|void|int The exit code or null for success
     */
    public function execute( Arguments $args, ConsoleIo $io ) {

        $coinsSync = new CoinSync();

        if($coinsSync->doSync()) {
            $io->success('Success');
        } else {
            $io->error('Success');
        }

    }
}
