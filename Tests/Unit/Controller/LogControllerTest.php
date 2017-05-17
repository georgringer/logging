<?php

namespace GeorgRinger\Logging\Tests\Unit\Controller;

use GeorgRinger\Logging\Controller\LogController;
use GeorgRinger\Logging\Domain\Repository\LogEntryRepository;
use TYPO3\CMS\Core\Tests\UnitTestCase;

class LogControllerTest extends UnitTestCase
{

    /**
     * @test
     */
    public function clearActionCallsRepository()
    {
        $controller = $this->getAccessibleMock(LogController::class, ['dummy'], [], '', false);
        $mockedLogRepository = $this->getAccessibleMock(LogEntryRepository::class, ['clearByDemand'], [], '', false);
        $mockedView = $this->getAccessibleMock(\TYPO3\CMS\Fluid\View\TemplateView::class, ['assign'], [], '', false);

        $controller->_set('logEntryRepository', $mockedLogRepository);
        $controller->_set('view', $mockedView);

        $demand = new \GeorgRinger\Logging\Domain\Model\Dto\ClearDemand();

        $mockedLogRepository->expects($this->once())->method('clearByDemand')->with($demand);
        $controller->_call('clearAction', $demand);
    }
}
