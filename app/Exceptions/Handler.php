<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;


class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        HttpException::class,
        ModelNotFoundException::class,
    ];

    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     * @param  \Exception $e
     * @return void
     */
    public function report(Exception $e)
    {
        return parent::report($e);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Exception $e
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $e)
    {
        if ($e instanceof NotFoundHttpException) {
           if (strpos($request->getHost(), 'api') !== false) {
                return response()->json("Sorry, this url does not exit", 404);
           }
        } elseif ($e instanceof \Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException) {
            return response([
                'success' => false,
                'msg' => 'Too many requests. Slow your roll! Only 5 request within 1 minute'
            ]);
        }
		else if ($e instanceof TokenExpiredException) {
			return response()->json(['token_expired'], $e->getStatusCode());
		} else if ($e instanceof TokenInvalidException) {
			return response()->json(['token_invalid'], $e->getStatusCode());
		}
		else if ($e instanceof JWTException) {
			return response()->json(['could_not_create_token'], $e->getStatusCode());
		}


        return parent::render($request, $e);
    }
}
