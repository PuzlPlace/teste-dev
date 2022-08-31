<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Validation\UnauthorizedException;

trait CallableIntercept
{
    public function run(callable $fn): JsonResponse
    {
        try {
            $result = $fn();

            return response()->json(['success' => true, 'data' => $result]);
        } catch (UnauthorizedException $unauthorizedException){
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while trying to perform the requested operation.',
                'error' => $unauthorizedException->getMessage(),
            ], 401);
        } catch (\Exception $exception){
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while trying to perform the requested operation.',
                'exception' => $exception->getMessage(),
            ], 422);
        }
    }
}
