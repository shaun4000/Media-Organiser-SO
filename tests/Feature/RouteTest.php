<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHome()
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertViewIs('index');
    }

        /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddAlbum()
    {
        $response = $this->get(route('add-album'));

        $response->assertStatus(200);
        $response->assertViewIs('add-album');
    }


       /**
     * A basic test example.
     *
     * @return void
     */
    public function testAddArtist()
    {
        $response = $this->get(route('add-artist'));

        $response->assertStatus(200);
        $response->assertViewIs('add-artist');
    }

   /**
     * A basic test example.
     *
     * @return void
     */
    public function testPlaylists()
    {
        $response = $this->get(route('playlists'));

        $response->assertStatus(200);
        $response->assertViewIs('playlists');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCategories()
    {
        $response = $this->get(route('categories'));

        $response->assertStatus(200);
        $response->assertViewIs('categories');
    }
}
