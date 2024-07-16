<?php

namespace Tests\Feature;

use App\Models\TambahDataSoftware;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SoftwareControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_displays_software()
    {
        $software = TambahDataSoftware::factory()->create();

        $response = $this->get(route('TambahDataSoftware.index'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.software');
        $response->assertViewHas('software');
        $this->assertTrue($response['software']->contains($software));
    }

    /** @test */
    public function create_displays_form()
    {
        $response = $this->get(route('TambahDataSoftware.create'));

        $response->assertStatus(200);
        $response->assertViewIs('pages.form-data-software');
    }

    /** @test */
    public function store_creates_new_software()
    {
        $data = [
            'jenis_aplikasi' => '123',
            'tahun' => '2024',
            'no_inventaris' => '123',
            'nama_aplikasi' => '123',
            'pengguna' => '123',
            'divisi' => '123'
        ];

        $response = $this->post(route('TambahDataSoftware.store'), $data);

        $this->assertDatabaseHas('tambah_data_softwares', $data);
        $response->assertRedirect(route('TambahDataSoftware.index'));
        $response->assertSessionHas('message', 'Data Berhasil Ditambahkan');
    }

    /** @test */
    public function edit_displays_edit_form()
    {
        $software = TambahDataSoftware::factory()->create();

        $response = $this->get(route('TambahDataSoftware.edit', $software->id));

        $response->assertStatus(200);
        $response->assertViewIs('pages.edit-data-software');
        $response->assertViewHas('software', $software);
    }

    /** @test */
    public function update_updates_software()
    {
        $software = TambahDataSoftware::factory()->create();
        $updatedData = [
            'jenis_aplikasi' => '321',
            'tahun' => '321',
            'no_inventaris' => '321',
            'nama_aplikasi' => '321',
            'pengguna' => '321',
            'divisi' => '321'
        ];

        $response = $this->put(route('TambahDataSoftware.update', $software->id), $updatedData);

        $this->assertDatabaseHas('tambah_data_softwares', $updatedData);
        $response->assertRedirect(route('TambahDataSoftware.index'));
        $response->assertSessionHas('message', 'Data Berhasil dirubah');
    }

    /** @test */
    public function destroy_deletes_software()
    {
        $software = TambahDataSoftware::factory()->create();

        $response = $this->delete(route('TambahDataSoftware.destroy', $software->id));

        $this->assertDatabaseMissing('tambah_data_softwares', ['id' => $software->id]);
        $response->assertRedirect();
        $response->assertSessionHas('info', 'Data telah dihapus');
    }
}
