<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
    public function sendResponse($message, $result, $code = 200)
    {
        $response = [
            'success' => true,
            'successCode' => $code,
            'message' => $message,
            'results'    => $result,
        ];
        return response()->json($response, 200);
    }
    public function sendError($error, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'errors' => $error,
        ];
        if (!empty($errorMessages)) {
            $response['message'] = $errorMessages;
        }
        return response()->json($response, $code);
    }
}
