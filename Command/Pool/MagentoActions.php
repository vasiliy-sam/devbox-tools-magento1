<?php
/**
 * @author    Ewave <https://ewave.com/>
 * @copyright 2018-2019 NASKO TRADING PTY LTD
 * @license   https://ewave.com/wp-content/uploads/2018/07/eWave-End-User-License-Agreement.pdf BSD Licence
 */

namespace MagentoOneDevBox\Command\Pool;

use CoreDevBoxScripts\Command\CoreActionsAbstract;

/**
 * Command for Magento installation
 */
class MagentoActions extends CoreActionsAbstract
{
    /**
     * @var string
     */
    protected $configFile = '';

    /**
     * @var string
     */
    protected $commandCode = 'magento1';

    /**
     * @var string
     */
    protected $toolsName = 'Magento 1 commands';

    /**
     * @var string
     */
    protected $commandDesc = 'Magento 1 commands list';

    /**
     * @var string
     */
    protected $commandHelp = 'This command allows you to execute any of predefined actions to setup website';

    /**
     * @return \Symfony\Component\Console\Command\Command[]
     */
    protected function getApplicationCommands()
    {
        return $this->getApplication()->all('magento1');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @param \Symfony\Component\Console\Style\SymfonyStyle $io
     * @return void
     */
    protected function beforeExecute($input, $output, $io)
    {
        parent::beforeExecute($input, $output, $io);

        if ($this->getJoke()) {
            $io->block($this->getJoke());
        }
    }

    /**
     * @return bool
     */
    public function getJoke()
    {
        try {
            $ans = file_get_contents('http://api.icndb.com/jokes/random');
            $ansO = json_decode($ans);
            if ($ansO->type == 'success') {
                return $ansO->value->joke;
            }
        } catch (\Exception $e) {
            return false;
        }

        return false;
    }
}