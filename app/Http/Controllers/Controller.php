<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    // Uploading Image and Save It
    public function uploadImage($image, $dir = 'global')
    {
        if($image)
        {
            $uploadedImage = $image;
            $imageName = time() . '.' . $uploadedImage->getClientOriginalExtension();
            $direction = public_path('control/image/' . $dir . '/');
            $uploadedImage->move($direction, $imageName);
            return 'control/image/' . $dir . '/' . $imageName;
        }
    }
}
