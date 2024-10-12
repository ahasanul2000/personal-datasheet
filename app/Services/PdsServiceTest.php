<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Pds;
use App\Services\PdsService;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;

class PdsServiceTest extends TestCase
{
    use RefreshDatabase;

    protected $pdsService;

    public function setUp(): void
    {
        parent::setUp();
        $this->pdsService = app(PdsService::class);  // Inject the PdsService
    }

    /** @test */
    public function it_can_list_all_pds()
    {
        // Create 3 sample PDS records
        Pds::factory()->count(3)->create();

        $pdsList = $this->pdsService->getAllPds();

        $this->assertCount(3, $pdsList);
    }

    /** @test */
    public function it_can_create_new_pds()
    {
        // Fake storage for image testing
        Storage::fake('public');
        $image = UploadedFile::fake()->image('pds-image.jpg');

        $data = [
            'email' => 'test@example.com',
            'fullName' => 'Test User',
            'phone' => '1234567890',
            'address' => '123 Test Address',
            'age' => 30,
            'image' => $image,
        ];

        $pds = $this->pdsService->createPds(new \Illuminate\Http\Request($data));

        $this->assertDatabaseHas('pds', ['email' => 'test@example.com']);
        Storage::disk('public')->assertExists('images/' . $pds->image);
    }

    /** @test */
    public function it_can_update_existing_pds()
    {
        // Create a sample PDS
        $pds = Pds::factory()->create();

        // Fake storage and new image
        Storage::fake('public');
        $newImage = UploadedFile::fake()->image('new-pds-image.jpg');

        $data = [
            'email' => 'updated@example.com',
            'fullName' => 'Updated Name',
            'phone' => '9876543210',
            'address' => 'Updated Address',
            'age' => 35,
            'image' => $newImage,
        ];

        $updatedPds = $this->pdsService->updatePds(new \Illuminate\Http\Request($data), $pds->id);

        // Assert database has updated record
        $this->assertDatabaseHas('pds', ['email' => 'updated@example.com']);
        Storage::disk('public')->assertExists('images/' . $updatedPds->image);
    }

    /** @test */
    public function it_can_soft_delete_a_pds()
    {
        // Create a sample PDS
        $pds = Pds::factory()->create();

        // Soft delete the PDS
        $this->pdsService->deletePds($pds->id);

        // Assert the PDS is soft deleted
        $this->assertSoftDeleted('pds', ['id' => $pds->id]);
    }

    /** @test */
    public function it_can_restore_soft_deleted_pds()
    {
        // Create and soft delete a sample PDS
        $pds = Pds::factory()->create();
        $pds->delete();

        // Restore the PDS
        $this->pdsService->restorePds($pds->id);

        // Assert the PDS is restored
        $this->assertFalse($pds->trashed());
    }

    /** @test */
    public function it_can_force_delete_a_pds()
    {
        // Fake storage for image deletion test
        Storage::fake('public');

        // Create and soft delete a PDS
        $pds = Pds::factory()->create(['image' => 'sample-image.jpg']);
        $pds->delete();

        // Simulate file upload
        Storage::disk('public')->put('images/sample-image.jpg', 'sample content');

        // Force delete the PDS
        $this->pdsService->forceDeletePds($pds->id);

        // Assert the PDS is permanently deleted
        $this->assertDatabaseMissing('pds', ['id' => $pds->id]);

        // Assert the image is deleted from storage
        Storage::disk('public')->assertMissing('images/sample-image.jpg');
    }
}
