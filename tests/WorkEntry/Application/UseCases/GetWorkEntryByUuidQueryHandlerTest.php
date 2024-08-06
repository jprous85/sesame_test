<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQuery;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQueryHandler;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetWorkEntryByUuidQueryHandlerTest extends TestCase
{
    private MockObject|WorkEntryRepository $workEntryRepository;
    private GetWorkEntryByUuidQueryHandler $getWorkEntryByUuidQueryHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository            = $this->createMock(WorkEntryRepository::class);
        $this->getWorkEntryByUuidQueryHandler = new GetWorkEntryByUuidQueryHandler($this->workEntryRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(GetWorkEntryByUuidQueryHandler::class, $this->getWorkEntryByUuidQueryHandler);
        $this->assertInstanceOf(QueryHandlerInterface::class, $this->getWorkEntryByUuidQueryHandler);
    }

    /**
     * @test
     * throw_error_if_not_found_a_user
     * @throws Exception
     */
    public function isShouldThrowErrorIfNotFoundAUser()
    {
        $this->expectException(WorkEntryNotFoundException::class);
        $this->workEntryRepository
            ->method('getWorkEntryByUuid')
            ->willThrowException(throw new WorkEntryNotFoundException());

        ($this->getWorkEntryByUuidQueryHandler)(new GetWorkEntryByUuidQuery(new WorkEntryUuidRequest('')));
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData()
    {
        $workEntry    = WorkEntryMother::random();
        $workEntryResponse = WorkEntryResponse::workEntryResponseMapper($workEntry);

        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorkEntryByUuid')
            ->willReturn($workEntry);

        $query  = new GetWorkEntryByUuidQuery(new WorkEntryUuidRequest($workEntry->getUuid()->uuid()));
        $result = ($this->getWorkEntryByUuidQueryHandler)($query);

        $this->assertEquals($result, $workEntryResponse->toArray());
    }

}