<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;

abstract class Request extends FormRequest
{
    public function wantsJson()
    {
        return true;
    }

    public function response(array $errors)
    {
        $response = [
            'success' => false,
            'msg' => $errors
        ];
        if ($this->ajax() || $this->wantsJson()) {
            return new JsonResponse($response, 422);
        }

        return $this->redirector->to($this->getRedirectUrl())
            ->withInput($this->except($this->dontFlash))
            ->withErrors($errors, $this->errorBag);
    }
}
