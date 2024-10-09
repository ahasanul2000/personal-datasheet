<?php

namespace Tests\Unit;

use App\Models\Pds;
use App\Services\PdsService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PdsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $pdsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->pdsService = new PdsService();
    }

    public function testGetAllPds()
    {
        Pds::factory()->count(5)->create();
        $allPds = $this->pdsService->getAllPds();
        $this->assertCount(5, $allPds);
    }

    // Add more tests for other methods (create, update, delete)
}
