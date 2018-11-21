<?php

namespace Tests;

class AdminMiddlewareTest extends TestCase
{
    /** @test */
    public function guests_can_access_public_routes()
    {
        $response = $this->get('/anyone');

        $response->assertOk();
        $response->assertSee('content for anyone');
    }

    /** @test */
    public function guests_cant_access_auth_or_admin_routes()
    {
        $response = $this->get('/logged-in-page');

        $response->assertRedirect('/login');

        $response = $this->get('/admin-only-page');

        $response->assertStatus(403);
    }

    /** @test */
    public function logged_in_users_can_access_auth_routes()
    {
        $response = $this->actingAs($this->regularUser)->get('/logged-in-page');

        $response->assertOk();
        $response->assertSee('content for logged in users');
    }

    /** @test */
    public function logged_in_non_admin_users_cant_access_admin_routes()
    {
        $response = $this->actingAs($this->regularUser)->get('/admin-only-page');

        $response->assertStatus(403);
    }

    /** @test */
    public function logged_in_admin_users_can_access_admin_routes()
    {
        $response = $this->actingAs($this->adminUser)->get('/admin-only-page');

        $response->assertOk();
        $response->assertSee('content for admins');
    }
}
