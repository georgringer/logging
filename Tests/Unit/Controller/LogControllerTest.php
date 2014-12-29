<?php

namespace GeorgRinger\Logging\Tests\Unit\Controller;

use TYPO3\CMS\Core\Tests\UnitTestCase;
use GeorgRinger\Logging\Domain\Repository\LogEntryRepository;
use GeorgRinger\Logging\Controller\LogController;

class LogControllerTest extends UnitTestCase {

	/**
	 * @test
	 */
	public function clearActionCallsRepository() {
		$controller = $this->getAccessibleMock(LogController::class, array('dummy'), array(), '', FALSE);
		$mockedLogRepository = $this->getAccessibleMock(LogEntryRepository::class, array('clearByDemand'), array(), '', FALSE);
		$mockedView = $this->getAccessibleMock(\TYPO3\CMS\Fluid\View\TemplateView::class, array('assign'), array(), '', FALSE);

		$controller->_set('logEntryRepository', $mockedLogRepository);
		$controller->_set('view', $mockedView);

		$demand = new \GeorgRinger\Logging\Domain\Model\Dto\ClearDemand();

		$mockedLogRepository->expects($this->once())->method('clearByDemand')->with($demand);
		$controller->_call('clearAction', $demand);
	}
}