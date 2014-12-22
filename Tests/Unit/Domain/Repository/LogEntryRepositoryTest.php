<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Repository;

class LogEntryRepositoryTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	protected $repository;

	/** @var \GeorgRinger\Logging\Domain\Model\Dto\Demand */
	protected $demand;

	public function setUp() {
		$this->repository = $this->getAccessibleMock(\GeorgRinger\Logging\Domain\Repository\LogEntryRepository::class, array('dummy'), array(), '', FALSE);
		$this->demand = new \GeorgRinger\Logging\Domain\Model\Dto\Demand();
	}

	/**
	 * @test
	 */
	public function correctTimeIsReturned() {
		$repository = $this->getAccessibleMock(\GeorgRinger\Logging\Domain\Repository\LogEntryRepository::class, array('dummy'), array(), '', FALSE);
		$this->assertEquals('2014-12-22 19:25:29', $repository->_call('getTime', 1419272729));
	}

	/**
	 * @test
	 */
	public function levelIsRespectedForQuery() {
		$value = array(1, 2);
		$this->demand->setLevels($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('in'), array(), '', FALSE);
		$query->expects($this->once())->method('in')->with('level', $value);
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(1, count($constraints));
	}

	/**
	 * @test
	 */
	public function modeIsRespectedForQuery() {
		$value = array('fe', 'be');
		$this->demand->setModes($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('in'), array(), '', FALSE);
		$query->expects($this->once())->method('in')->with('mode', $value);
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(1, count($constraints));
	}

	/**
	 * @test
	 */
	public function channelIsRespectedForQuery() {
		$value = array(1, 2);
		$this->demand->setChannels($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('in'), array(), '', FALSE);
		$query->expects($this->once())->method('in')->with('channel', $value);
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(1, count($constraints));
	}

	/**
	 * @test
	 */
	public function requestIdIsRespectedForQuery() {
		$value = 'lorem ipsum';
		$this->demand->setRequestId($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('equals'), array(), '', FALSE);
		$query->expects($this->once())->method('equals')->with('requestId', $value);
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(1, count($constraints));
	}

	/**
	 * @test
	 */
	public function userIsRespectedForQuery() {
		$value = 'be_123';
		$this->demand->setUser($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('equals'), array(), '', FALSE);
		$query->expects($this->at(0))->method('equals')->with('mode', 'be');
		$query->expects($this->at(1))->method('equals')->with('userId', '123');
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(2, count($constraints));
	}

	/**
	 * @test
	 */
	public function dateRangeIsRespectedForQuery() {
		$value = 1;
		$this->demand->setDateRange($value);
		$query = $this->getAccessibleMock(\TYPO3\CMS\Extbase\Persistence\Generic\Query::class, array('greaterThanOrEqual', 'lessThanOrEqual'), array(), '', FALSE);
		$query->expects($this->at(0))->method('greaterThanOrEqual');
		$query->expects($this->at(1))->method('lessThanOrEqual');
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(2, count($constraints));
	}
}