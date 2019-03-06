<?php

namespace Tests\Unit;

use App\Country;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CountryTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }


    public function test_can_show_countries() {
        $response = $this->json('GET', '/countries');
        $response
            ->assertStatus(201);
    }

    public function test_can_update_country() {
        $response = $this->json('POST', '/api/countries');
        $response
            ->assertStatus(201);
    }
    // public function test_can_show_country() {
    //     $country = factory(Country::class)->create();
    //     $this->get(route('countries.show', $country->id))
    //         ->assertStatus(200);
    // }
    public function test_can_delete_country() {
        $response = $this->json('DELETE', '/api/countries/2');
        $response
            ->assertStatus(201);
    }
    public function test_can_list_countries() {
        $countries = factory(Country::class, 2)->create()->map(function ($country) {
            return $country->only(['name', 'continent']);
        });
        $this->get(route('countries'))
            ->assertStatus(200)
            ->assertJson($countries->toArray())
            ->assertJsonStructure([
                '*' => ['name', 'continent'],
            ]);
    }
}
