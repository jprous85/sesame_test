<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Application\Response\WorkEntryResponses;
use App\WorkEntry\Application\UseCases\GetWorksEntriesByUserUuidQuery;
use App\WorkEntry\Application\UseCases\GetWorksEntriesByUserUuidQueryHandler;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetWorksEntriesByUserUuidQueryHandlerTest extends TestCase
{
    private MockObject|WorkEntryRepository        $workEntryRepository;
    private GetWorksEntriesByUserUuidQueryHandler $getWorksEntriesByUserUuidQueryHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository                   = $this->createMock(WorkEntryRepository::class);
        $this->getWorksEntriesByUserUuidQueryHandler = new GetWorksEntriesByUserUuidQueryHandler($this->workEntryRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(GetWorksEntriesByUserUuidQueryHandler::class, $this->getWorksEntriesByUserUuidQueryHandler);
        $this->assertInstanceOf(QueryHandlerInterface::class, $this->getWorksEntriesByUserUuidQueryHandler);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData(): void
    {

        $user = UserMother::random();

        $workEntry1 = WorkEntryMother::random();
        $workEntry2 = WorkEntryMother::random();

        $workEntryResponse1 = WorkEntryResponse::workEntryResponseMapper($workEntry1);
        $workEntryResponse2 = WorkEntryResponse::workEntryResponseMapper($workEntry2);

        $worksEntriesResponses = new WorkEntryResponses($workEntryResponse1, $workEntryResponse2);

        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorksEntriesByUserUuid')
            ->willReturn([$workEntry1, $workEntry2]);

        $result = ($this->getWorksEntriesByUserUuidQueryHandler)
        (new GetWorksEntriesByUserUuidQuery(
            new WorkEntryUuidRequest($user->getUuid()->uuid())
         ));

        $this->assertEquals($result, $worksEntriesResponses->toArray());

    }
}