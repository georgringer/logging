<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Model\Dto;

use GeorgRinger\Logging\Domain\Model\Dto\ClearDemand;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class ClearDemandTest extends UnitTestCase
{

    /** @var ClearDemand */
    protected $instance;

    public function setup()
    {
        $this->instance = new ClearDemand();
    }

    /**
     * @test
     */
    public function allCanBeSet()
    {
        $value = true;
        $this->instance->setAll($value);
        $this->assertEquals($value, $this->instance->getAll());
    }
}
