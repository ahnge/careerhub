<?php

namespace App\Helpers;

use League\Flysystem\WhitespacePathNormalizer;
use Illuminate\Support\Facades\Redirect;

class MyHelper
{
    static function storeAndGetPath($request, string $folder, string $name): string
    {

        // Get the appopriate suffix
        switch ($name) {
            case 'profile_img':
                $suffix = 'profile';
                break;

            case 'company_logo':
                $suffix = 'logo';
                break;

            case 'resume':
                $suffix = 'resume';
                break;

            default:
                $suffix = '';
                break;
        };

        // Get the file extension
        $file = $request->file($name);
        $extension = $file->extension();

        // Store the file and get the path
        $path = $request->file($name)->storeAs(
            $folder,
            $request->user()->name . $request->user()->id . $suffix . '.' . $extension
        );

        // Normalize the path
        $path_normalizer = new WhitespacePathNormalizer();
        $normalized_path = $path_normalizer->normalizePath($path);

        return $normalized_path;
    }

    static function validate_extension($request, string $file_name): bool
    {
        $allowed_file_extensions = ['jpg', 'png', 'jpeg', 'txt', 'bmp', 'pdf', 'doc'];

        // Get the file extension
        $file = $request->file($file_name);
        $extension = $file->extension();

        // Ensure file type is valid
        if (!in_array(strtolower($extension), $allowed_file_extensions)) {
            return false;
        }

        return true;
    }
}
