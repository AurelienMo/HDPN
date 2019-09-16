<?php

namespace spec\App\Entity;

use App\Entity\User;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class UserSpec extends ObjectBehavior
{
    public function it_is_instanciable(...$arguments)
    {
        parent::beConstructedWith(
            'johndoe',
            'johndoe@yopmail.com',
            '12345678',
            'John',
            'Doe',
            1
        );
        $this->shouldHaveType(User::class);
    }
}
