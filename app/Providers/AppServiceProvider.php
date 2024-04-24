<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Response as ObjectResponse;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Response::macro('render', function ($data) {
            $code_response = [
                'success' => ObjectResponse::HTTP_OK,
                'created' => ObjectResponse::HTTP_CREATED,
                'updated' => ObjectResponse::HTTP_OK,
                'deleted' => ObjectResponse::HTTP_NO_CONTENT,
                'bad_request' => ObjectResponse::HTTP_BAD_REQUEST,
                'unauthorized' => ObjectResponse::HTTP_UNAUTHORIZED,
                'not_found' => ObjectResponse::HTTP_NOT_FOUND,
                'error' => ObjectResponse::HTTP_INTERNAL_SERVER_ERROR,
                'invalidate_request' => ObjectResponse::HTTP_UNPROCESSABLE_ENTITY,
                ];

            $code = intval(in_array($data['status'], ['success', 'created', 'updated', 'deleted']));
            $response = [
                'status' => $data['status'],
                'status_code' => $code_response[$data['status']],
                'code' => $code,
                'message' => $data['message'],
            ];

            if(array_key_exists('errors', $data))
                $response['errors'] = $data['errors'];
            if(array_key_exists('data', $data))
                 $response['data'] = $data['data'];
            return Response::json($response, $code_response[$data['status']]);
        });
    }
}
