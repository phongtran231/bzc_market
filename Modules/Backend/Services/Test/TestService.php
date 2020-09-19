<?php

namespace Modules\Backend\Services\Test;

use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Http\Request;

class TestService implements TestServiceInterface
{
    protected $testRepository;

    public function __construct(
        TestRepositoryInterface $testRepository
    ) {
        $this->testRepository = $testRepository;
    }

    /**
     * Checkout san pham
     * @param Request $request
     */
    public function checkout(Request $request): void
    {
    }
}