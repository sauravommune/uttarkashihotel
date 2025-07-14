<?php

namespace App\Traits;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait FileUpload
{
    /**
     * Handles file upload.
     *
     * @param string $input_name Name of the input field.
     * @param string $path Destination path for the file.
     * @param bool $original_name Preserve the original file name.
     * @param string|null $remove_path Path of the old file to remove.
     * @param string|null $custom_name Custom file name.
     * @param bool $storage Whether to use Laravel's storage or move directly.
     * @param string $disk Disk for storage (default: public).
     * @param string|null $prefix Prefix for generated file names.
     * @return string|array|null File path(s) or null if no file uploaded.
     */
    public static function fileUpload(
        $input_name,
        $path = 'uploads',
        $original_name = false,
        $remove_path = null,
        $custom_name = null,
        $storage = true,
        $disk = 'public',
        $prefix = null
    ) {
        $file = request()->file($input_name);

        if (!$file) {
            return null;
        }

        // Ensure the destination directory exists
        File::ensureDirectoryExists(storage_path("app/public/{$path}"));

        // Remove old file if applicable
        if ($remove_path) {
            self::fileRemove($remove_path);
        }

        $names = self::generateFileNames($file, $original_name, $prefix, $custom_name);

        if (is_array($file)) {
            foreach ($file as $key => $singleFile) {
                $storage
                    ? $singleFile->storeAs($path, $names[$key], $disk)
                    : $singleFile->move(public_path($path), $names[$key]);
            }

            return array_map(fn($name) => "{$path}/{$name}", $names);
        }

        $storage
            ? $file->storeAs($path, $names, $disk)
            : $file->move(public_path($path), $names);

        return "{$path}/{$names}";
    }

    /**
     * Removes a file if it exists.
     *
     * @param string $path Path of the file to remove.
     * @return bool True if file was deleted, false otherwise.
     */
    public static function fileRemove($path)
    {
        $fullPath = storage_path("app/public/{$path}");

        return File::exists($fullPath) ? File::delete($fullPath) : false;
    }

    /**
     * Generates file names for upload.
     *
     * @param mixed $file File(s) being uploaded.
     * @param bool $original_name Preserve the original file name.
     * @param string|null $prefix Prefix for the file name.
     * @param string|null $custom_name Custom file name.
     * @return string|array Generated file name(s).
     */
    private static function generateFileNames($file, $original_name, $prefix, $custom_name)
    {
        if (is_array($file)) {
            return array_map(
                fn($singleFile) => self::generateSingleFileName($singleFile, $original_name, $prefix, $custom_name),
                $file
            );
        }

        return self::generateSingleFileName($file, $original_name, $prefix, $custom_name);
    }

    /**
     * Generates a single file name.
     *
     * @param \Illuminate\Http\UploadedFile $file The file being uploaded.
     * @param bool $original_name Preserve the original file name.
     * @param string|null $prefix Prefix for the file name.
     * @param string|null $custom_name Custom file name.
     * @return string Generated file name.
     */
    private static function generateSingleFileName($file, $original_name, $prefix, $custom_name)
    {
        if ($custom_name) {
            return "{$custom_name}.{$file->extension()}";
        }

        if ($original_name) {
            return $file->getClientOriginalName();
        }

        $randomName = Str::random(15);
        return $prefix ? "{$prefix}_{$randomName}.{$file->extension()}" : "{$randomName}.{$file->extension()}";
    }
}
