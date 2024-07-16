<?

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class ConfirmablePasswordControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testShowReturnsConfirmPasswordView()
    {
        $response = $this->get('/password/confirm');
        $response->assertStatus(200);
        $response->assertViewIs('auth.confirm-password');
    }

    public function testStoreConfirmsPasswordSuccessfully()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->post('/password/confirm', [
            'password' => 'password',
        ]);

        $response->assertRedirect(route('dashboard'));
        $this->assertTrue(session()->has('auth.password_confirmed_at'));
    }

    public function testStoreFailsWithIncorrectPassword()
    {
        $user = User::factory()->create([
            'password' => Hash::make('password'),
        ]);

        $response = $this->actingAs($user)->post('/password/confirm', [
            'password' => 'wrongpassword',
        ]);

        $response->assertSessionHasErrors(['password']);
        $this->assertFalse(session()->has('auth.password_confirmed_at'));
    }
}