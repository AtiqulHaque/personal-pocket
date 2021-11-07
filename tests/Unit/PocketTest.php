<?php

use App\Contracts\PocketRepository;
use App\Contracts\UserRepository;
use App\Models\Pocket;
use App\Services\PocketService;
use App\Validators\PocketValidator;
use Tests\TestCase;

class PocketTest extends TestCase
{
    protected $unitPrice;

    protected $bookingRepositoryMock;
    protected $bookingValidatorMock;
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject
     */
    private $roomServiceMock;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function testPocketServiceWithValidationFailed()
    {
        $this->pocketValidatorMock = $this->app->make(PocketValidator::class);

        $this->pocketRepositoryMock = Mockery::mock(PocketRepository::class);
        $this->userRepositoryMock = Mockery::mock(UserRepository::class);

        $pocketService = new PocketService($this->pocketRepositoryMock, $this->pocketValidatorMock);

        $request = $this->createRequest([]);
        $response = $pocketService->createPocket($request->get('title'));
        $this->assertEquals('validation-error', $response['status']);
    }


    public function testPocketServiceCreateWithFailed()
    {
        $this->expectException(Exception::class);

        $this->pocketValidatorMock = $this->app->make(PocketValidator::class);

        $this->pocketRepositoryMock =  Mockery::mock((PocketRepository::class));

        $this->pocketRepositoryMock->shouldReceive('createPocket')
            ->willThrowException(new Exception("error"));


        $pocketService = new PocketService($this->pocketRepositoryMock, $this->pocketValidatorMock);

        $pocketService->createPocket("title");
    }


    public function testPocketServiceCreateWithSuccess()
    {
        $this->pocketValidatorMock = $this->app->make(PocketValidator::class);
        $this->pocketRepositoryMock =  Mockery::mock((PocketRepository::class));


        $this->pocketRepositoryMock->shouldReceive('createPocket')
            ->once()
            ->andReturn(new Pocket());

        $pocketService = new PocketService($this->pocketRepositoryMock, $this->pocketValidatorMock);

        $response = $pocketService->createPocket("title");

        $this->assertEquals('success', $response['status']);
        $this->assertInstanceOf(Pocket::class, $response['data']);
    }

    protected function createRequest($data)
    {
        $request = new \Illuminate\Http\Request();
        $request->replace($data);
        return $request;
    }
}
