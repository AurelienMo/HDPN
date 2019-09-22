<?php

declare(strict_types=1);

/*
 * This file is part of HDPN-be
 *
 * (c) Aurelien Morvan <morvan.aurelien@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Command;

use App\Domain\Common\Helpers\LoaderNelmioAliceHelper;
use Doctrine\ORM\EntityManagerInterface;
use Nelmio\Alice\Loader\NativeLoader;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class LoadInitDatasCommand
 */
final class LoadInitDatasCommand extends Command
{
    const ENTRY_POINT_FILE = '00_load.yml';

    /** @var LoaderNelmioAliceHelper */
    protected $loaderNelmio;

    /** @var string */
    protected $configFolder;

    /**
     * LoadInitDatasCommand constructor.
     *
     * @param LoaderNelmioAliceHelper $loaderNelmio
     * @param string                  $configFolder
     */
    public function __construct(
        LoaderNelmioAliceHelper $loaderNelmio,
        string $configFolder
    ) {
        $this->loaderNelmio = $loaderNelmio;
        $this->configFolder = $configFolder;
        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->setName('app:load-init-datas')
            ->setDescription('Load initial datas');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ) {
        $this->loaderNelmio->load(
            sprintf(
                '%s/fixtures/%s',
                $this->configFolder,
                self::ENTRY_POINT_FILE
            )
        );
    }
}
