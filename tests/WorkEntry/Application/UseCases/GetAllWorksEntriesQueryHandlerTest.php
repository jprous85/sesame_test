<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Application\Response\WorkEntryResponses;
use App\WorkEntry\Application\UseCases\GetAllWorksEntriesQuery;
use App\WorkEntry\Application\UseCases\GetAllWorksEntriesQueryHandler;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetAllWorksEntriesQueryHandlerTest  extends TestCase
{
    private MockObject|WorkEntryRepository $workEntryRepository;
    private GetAllWorksEntriesQueryHandler $getAllWorksEntriesQueryHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository            = $this->createMock(WorkEntryRepository::class);
        $this->getAllWorksEntriesQueryHandler = new GetAllWorksEntriesQueryHandler($this->workEntryRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(GetAllWorksEntriesQueryHandler::class, $this->getAllWorksEntriesQueryHandler);
        $this->assertInstanceOf(QueryHandlerInterface::class, $this->getAllWorksEntriesQueryHandler);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData (): void
    {
        $workEntry1 = WorkEntryMother::random();
        $workEntry2 = WorkEntryMother::random();

        $workEntryResponse1 = WorkEntryResponse::workEntryResponseMapper($workEntry1);
        $workEntryResponse2 = WorkEntryResponse::workEntryResponseMapper($workEntry2);

        $worksEntriesResponses = new WorkEntryResponses($workEntryResponse1, $workEntryResponse2);

        $this->workEntryRepository
            ->expects(self::once())
            ->method('getAllWorksEntries')
            ->willReturn([$workEntry1, $workEntry2]);

        $result = ($this->getAllWorksEntriesQueryHandler)(new GetAllWorksEntriesQuery());

        $this->assertEquals($result, $worksEntriesResponses->toArray());

    }

}