<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ExampleTest extends TestCase {

    /**
     * landing page
     *
     * @return void
     */
    public function testViewImageUploader(){
        $response = $this->get(route('image-uploader'));
        $response->assertStatus(200);
    }

    /**
     * upload an image
     *
     * @return void
     */
    public function testUploadImage(){
        // attempting to upload a .jpg file should fail validation
        $image = UploadedFile::fake()->create('avatar.jpg');
        $response = $this->json('POST', route('upload-image'), ['image' => $image]);
        $response->assertStatus(422)->assertJsonFragment(['message' => 'The given data was invalid.']);

        // attempting to upload a .png should succeed
        $image = UploadedFile::fake()->create('avatar.png');
        $response = $this->json('POST', route('upload-image'), ['image' => $image]);
        $response->assertStatus(200)->assertJsonFragment(['status' => 'success', 'message' => 'Image uploaded successfully']);
    }

    /**
     * get uploaded images
     *
     * @return void
     */
    public function testGetImages(){
        $response = $this->get(route('get-uploaded-images'));
        $response->assertStatus(200)->assertJsonFragment(['status' => 'success', 'uploadedImages' => null]);
    }
}
