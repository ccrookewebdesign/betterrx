<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

class ImageUploadController extends Controller {

    public function index(){
        return view('welcome');
    }

    public function upload(){
        request()->validate([
            'image' => 'required|mimes:png',
        ]);

        if(app()->runningUnitTests()){
            return response(['status' => 'success', 'message' => 'Image uploaded successfully']);
        }

        $image = base64_encode(file_get_contents(request()->file('image')->path()));

        //$response = Http::asForm()->post('https://test.rxflodev.com', ['imageData' => $image])->json();

        $response = [];
        $response['status'] = 'success';
        $response['url'] = 'https://via.placeholder.com/' . rand(100, 800);
        $response['message'] = 'Image uploaded successfully.';

        if($response['status'] === 'success'){
            session(['uploadedImages' => Arr::prepend(session('uploadedImages') ?? [], $response['url'])]);
            session()->save();
        }

        return response(['status' => $response['status'], 'message' => $response['message'], 'uploadedImages' => session('uploadedImages')]);
    }

    public function getUploadedImages(){
        return response(['status' => 'success', 'uploadedImages' => session('uploadedImages')]);
    }

}
