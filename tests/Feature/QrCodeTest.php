<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QrCodeTest extends TestCase
{
    use RefreshDatabase;

    public function test_homepage_renders_the_qr_generator_form(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('Generate QR Code');
        $response->assertSee('URL');
    }

    public function test_user_can_generate_a_qr_code_from_url(): void
    {
        $response = $this->post('/generate', [
            'url' => 'https://example.com',
        ]);

        $response->assertOk();
        $response->assertSee('https://example.com');
        $response->assertSee('data:image/svg+xml;base64,');
    }

    public function test_user_can_generate_a_qr_code_with_custom_colors(): void
    {
        $response = $this->post('/generate', [
            'url' => 'https://example.com',
            'foreground_color' => '#ff0000',
            'background_color' => '#ffffff',
            'size' => 280,
            'margin' => 2,
        ]);

        $response->assertOk();
        $response->assertSee('data:image/svg+xml;base64,');
    }

    public function test_user_can_generate_a_qr_code_with_custom_shape(): void
    {
        $response = $this->post('/generate', [
            'url' => 'https://example.com',
            'shape' => 'circle',
        ]);

        $response->assertOk();
        $response->assertSee('data:image/svg+xml;base64,');
    }

    public function test_user_can_generate_a_business_card_qr_code(): void
    {
        $response = $this->post('/generate', [
            'qr_type' => 'business_card',
            'name' => 'Nain khan',
            'phone' => '+971 000000',
            'email' => 'hello@yourbrand.com',
            'whatsapp' => '+971 000000000',
        ]);

        $response->assertOk();
        $response->assertSee('data:image/svg+xml;base64,');
        $response->assertSee('Nain khan');
        $this->assertDatabaseHas('qr_codes', ['name' => 'Nain khan']);
    }

    public function test_user_is_redirected_to_billing_after_the_free_qr_limit_is_reached(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post('/generate', [
            'url' => 'https://first-example.com',
        ]);

        $response = $this->actingAs($user)->post('/generate', [
            'url' => 'https://second-example.com',
        ]);

        $response->assertRedirect(route('billing'));
    }

    public function test_homepage_includes_seo_metadata(): void
    {
        $response = $this->get('/');

        $response->assertOk();
        $response->assertSee('meta name="description"', false);
        $response->assertSee('QR SaaS', false);
    }

    public function test_pricing_page_renders(): void
    {
        $response = $this->get('/pricing');

        $response->assertOk();
        $response->assertSee('Simple pricing for every stage of growth.');
    }

    public function test_api_health_endpoint_returns_ok(): void
    {
        $response = $this->get('/api/health');

        $response->assertOk();
        $response->assertJsonPath('status', 'ok');
    }
}
