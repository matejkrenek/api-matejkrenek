<?php

namespace App\Facades;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

class API
{
    /**
     * Register api routes.
     *
     * @return void
     */
    public static function routes()
    {
        $files = self::apiFiles();

        Route::middleware('api')->prefix('/' . self::version())->group(function () use ($files) {
            foreach ($files as $file) {
                Route::group([], $file->getPathname());
            }
        });
    }

    /**
     * API route files
     *
     * @return \Symfony\Component\Finder\SplFileInfo[]
     */
    protected static function apiFiles()
    {
        $folder = base_path("routes/api/" . self::version());
        $files = File::files($folder);

        return $files;
    }

    /**
     * Api version
     *
     * @return string
     */
    public static function version()
    {
        return config('api.version');
    }

    /**
     * Api controller
     *
     * @return string
     */
    public static function controller($class)
    {
        $controller = "App\Http\Controllers\API\\" . str(self::version())->upper() . "\\" . $class;

        return $controller;
    }
}
