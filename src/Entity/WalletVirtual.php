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

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class WalletVirtual
 *
 * @ORM\Table(name="amo_wallet_virtual")
 * @ORM\Entity(repositoryClass="App\Repository\WalletVirtualRepository")
 */
class WalletVirtual extends AbstractEntity
{
    /**
     * @var float
     *
     * @ORM\Column(type="float")
     */
    protected $total;

    public function __construct()
    {
        $this->total = 0;
        parent::__construct();
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    public function updateTotal(float $amount): void
    {
        $this->total = $this->total + $amount;
    }
}
