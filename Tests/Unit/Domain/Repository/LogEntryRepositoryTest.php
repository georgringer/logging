<?php

namespace GeorgRinger\Logging\Tests\Unit\Domain\Repository;

use GeorgRinger\Logging\Domain\Model\Dto\ListDemand;
use GeorgRinger\Logging\Domain\Repository\LogEntryRepository;
use TYPO3\CMS\Core\Tests\AccessibleObjectInterface;
use TYPO3\CMS\Core\Tests\UnitTestCase;
use TYPO3\CMS\Extbase\Persistence\Generic\Query;

class LogEntryRepositoryTest extends UnitTestCase {

	/** @var AccessibleObjectInterface */
	protected $repository;

	/** @var ListDemand */
	protected $demand;

	public function setUp() {
		$this->repository = $this->getAccessibleMock(LogEntryRepository::class, array('dummy'), array(), '', FALSE);
		$this->demand = new ListDemand();
	}

	/**
	 * @test
	 */
	public function correctTimeIsReturned() {
		$repository = $this->getAccessibleMock(LogEntryRepository::class, array('dummy'), array(), '', FALSE);
		$this->assertEquals('2014-12-22 19:25:29', $repository->_call('getTime', 1419272729));
	}

	/**
	 * @test
	 */
	public function levelIsRespectedForQuery() {
		$value = array(1, 2);
		$this->demand->setLevels($value);
		$query = $this->getAccessibleMock(Query::class, array('in'), array(), '', FALSE);
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
		$query = $this->getAccessibleMock(Query::class, array('in'), array(), '', FALSE);
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
		$query = $this->getAccessibleMock(Query::class, array('in'), array(), '', FALSE);
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
		$query = $this->getAccessibleMock(Query::class, array('equals'), array(), '', FALSE);
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
		$query = $this->getAccessibleMock(Query::class, array('equals'), array(), '', FALSE);
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
		$query = $this->getAccessibleMock(Query::class, array('greaterThanOrEqual', 'lessThanOrEqual'), array(), '', FALSE);
		$query->expects($this->at(0))->method('greaterThanOrEqual');
		$query->expects($this->at(1))->method('lessThanOrEqual');
		$constraints = $this->repository->_call('createConstraintsFromDemand', $query, $this->demand);

		$this->assertEquals(2, count($constraints));
	}

	/**
	 * @test
	 */
	public function clearDemandCallsTruncate() {
		$repository = $this->getAccessibleMock(LogEntryRepository::class, array('truncateLogTable'), array(), '', FALSE);
		$repository->expects($this->once())->method('truncateLogTable');

		$clearDemand = new \GeorgRinger\Logging\Domain\Model\Dto\ClearDemand();
		$clearDemand->setAll(TRUE);
		$repository->_call('clearByDemand', $clearDemand);
	}

	/**
	 * @test
	 */
	public function truncateTableCallIsProcessed() {
		$mockedDatabaseConnection = $this->getAccessibleMock(\TYPO3\CMS\Core\Database\DatabaseConnection::class, array('exec_TRUNCATEquery'), array(), '', FALSE);
		$repository = $this->getAccessibleMock(LogEntryRepository::class, array('dummy'), array(), '', FALSE);

		$repository->_set('databaseConnection', $mockedDatabaseConnection);

		$mockedDatabaseConnection->expects($this->once())->method('exec_TRUNCATEquery')->with(LogEntryRepository::TABLE);
		$repository->_call('truncateLogTable');
	}
}