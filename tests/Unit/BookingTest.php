<?php

use App\Contracts\BookingRepository;
use App\Contracts\Service\UserServiceContract;
use App\Contracts\UserRepository;
use App\Services\BookingService;
use App\Services\UserService;
use App\Validators\BookingValidator;
use App\Validators\UserValidator;
use Illuminate\Support\Collection;
use Mockery\Exception\InvalidCountException;
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

    public function testUserServiceWithValidationFailed()
    {
        $this->assertEquals('validation-error', "validation-error");
    }



    protected function createRequest($data)
    {
        $request = new \Illuminate\Http\Request();
        $request->replace($data);
        return $request;
    }


}
