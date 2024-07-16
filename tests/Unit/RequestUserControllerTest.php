<?php

// tests/Feature/RequestUserControllerTest.php

namespace Tests\Feature;

use App\Models\RequestUser;
use App\Models\User;
use App\Models\Dikerjakan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class RequestUserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_index_displays_requests()
    {
    $response = $this->get(route('request-users.index'));

    $response->assertStatus(200);
    $response->assertViewIs('pages.permintaan-masuk');
    $response->assertViewHas('requests');
    $response->assertViewHas('technicians');
    }

    public function test_store_creates_new_request_user()
    {
        Storage::fake('uploads');

        // $file = UploadedFile::fake()->image('image.jpg');
        // $pdf = UploadedFile::fake()->create('file.pdf', 1000);

        $data = [
            'nup' => '12345',
            'nama' => 'John Doe',
            'divisi' => 'oracle',
            'no_hp' => '1234567890',
            'kategori_req' => 'Hardware',
            'deskripsi_req' => 'Needs a new laptop',
            'alasan_req' => 'Old laptop is broken',
            // 'upload_gambar' => $file,
            // 'upload_file' => $pdf,
            'teknisi' => null
        ];

        $response = $this->post(route('request-user.store'), $data);

        $this->assertDatabaseHas('request_users', [
            'nup' => '12345',
            'nama' => 'John Doe',
            'divisi' => 'oracle',
            'no_hp' => '1234567890',
            'kategori_req' => 'Hardware',
            'deskripsi_req' => 'Needs a new laptop',
            'alasan_req' => 'Old laptop is broken',
        ]);

        // Storage::disk('uploads')->assertExists('images/' . $file->hashName());
        // Storage::disk('uploads')->assertExists('files/' . $pdf->hashName());

        $response->assertRedirect(route('welcome'));
        $response->assertSessionHas('success', 'Request user baru berhasil ditambahkan.');
    }

    public function test_show_displays_request()
    {
        $request = RequestUser::factory()->create();

        $response = $this->get(route('request-user.show', $request->id));

        $response->assertStatus(200);
        $response->assertViewIs('pages.dikerjakan');
        $response->assertViewHas('request', $request);
    }

    
    public function test_move_to_dikerjakan()
    {
        $request = RequestUser::factory()->create();

        $response = $this->post(route('request-user.moveToDikerjakan', $request->id));

        $this->assertDatabaseMissing('request_users', ['id' => $request->id]);
        $this->assertDatabaseHas('dikerjakan', [
            'nup' => $request->nup,
            'nama' => $request->nama,
            'divisi' => $request->divisi,
            'no_hp' => $request->no_hp,
            'kategori_req' => $request->kategori_req,
            'deskripsi_req' => $request->deskripsi_req,
            'alasan_req' => $request->alasan_req,
            // 'upload_gambar' => $request->upload_gambar,
            // 'upload_file' => $request->upload_file,
            'teknisi' => $request->teknisi,
        ]);

        $response->assertRedirect();
        $response->assertSessionHas('success', 'Data berhasil dipindahkan ke tabel dikerjakan.');
    }

    
}
