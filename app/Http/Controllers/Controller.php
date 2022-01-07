<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Saves given file to local storage.
     * @throws Exception
     */
    protected function saveImage(UploadedFile $file): string
    {
        if ($file->getSize() >= disk_free_space('.')) {
            throw new Exception("Insufficient disk space.");
        }

        $name = time() . '.' . $file->extension();
        // Append '1' to filename in case two images were uploaded at the same time
        while (Storage::disk('local')->exists($name)) {
            $name = '1' . $name;
        }
        $contents = file_get_contents($file);
        Storage::put('public/' . $name, $contents);
        return $name;
    }

    /**
     * Gets new captcha image and returns it in a form of json.
     */
    public function reloadCaptcha(): JsonResponse
    {
        return response()->json(['captcha' => captcha_img()]);
    }
}
