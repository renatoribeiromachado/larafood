<?php

use App\Http\Controllers\Api\{
    TenantApiController
};

Route::group([
    'namespace' => 'Api'
], function () {

    Route::get('/tenants', [TenantApiController::class, 'index']);

});


