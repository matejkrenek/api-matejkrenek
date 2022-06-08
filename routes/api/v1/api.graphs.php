<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('/charts')->group(function () {
    Route::get('/population', function (Request $request) {
        if ($request->has('type')) {
            if ($request->get('type') === 'largest') {
                return response([
                    'china' => 1450010342,
                    'india' => 1406444536,
                    'usa' => 334751466,
                    'indonesia' => 279169579,
                    'pakistan' => 229435559,
                    'brazil' => 215485878,
                    'nigeria' => 216443833,
                    'bangladesh' => 167887783,
                    'russia' => 146053855,
                    'mexico' => 131576622
                ], 200);
            }

            if ($request->get('type') === 'process') {
                return response([
                    '2003' => 6381158114,
                    '2004' => 6461159389,
                    '2005' => 6541907027,
                    '2006' => 6623517833,
                    '2007' => 6705946610,
                    '2008' => 6789088686,
                    '2009' => 6872767093,
                    '2010' => 6956823603,
                    '2011' => 7041194301,
                    '2012' => 7125828059,
                    '2013' => 7210581976,
                    '2014' => 7295290765,
                    '2015' => 7379797139,
                    '2016' => 7464022049,
                    '2017' => 7547858925,
                    '2018' => 7631091040,
                    '2019' => 7713468100,
                    '2020' => 7794798739,
                ], 200);
            }
        }

        return response([], 404);
    });
});
