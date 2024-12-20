<?php

namespace App\Traits;

trait ApiResponse
{
    private function successResponse($data, $code)
    {
        return response()->json($data, $code);
    }

    protected function getAll($collection, $code = 200)
    {
        return $this->successResponse(['data' => $collection], $code);
    }

    protected function getOne($instance, $code = 200)
    {
        return $this->successResponse(['data' => $instance], $code);
    }

    protected function errorResponse($message, $code)
    {
        return response()->json(['error' => $message, 'code' => $code], $code);
    }


}
