<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Illuminate\Database\QueryException;
use HttpResponseException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Register the exception handling callbacks for the application.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->reportable(function (Throwable $e) {
			//
		});
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Throwable  $exception
	 * @return \Symfony\Component\HttpFoundation\Response
	 *
	 * @throws \Throwable
	 */
	public function render($request, Throwable $exception)
	{
		if ($exception instanceof MethodNotAllowedHttpException)
			abort(response()->json(['error' => 'MethodNotAllowedHttpException'], 405));
		
		elseif ($exception instanceof QueryException)
			abort(response()->json(['error' => 'QueryException'], 500));
		
		elseif ($exception instanceof NotFoundHttpException)
			abort(response()->json(['error' => 'NotFoundHttpException'], 404));
		
		elseif ($exception instanceof ModelNotFoundException)
			abort(response()->json(['error' => 'ModelNotFoundException'], 404));
		
		elseif ($exception instanceof \BadMethodCallException)
			abort(response()->json(['error' => 'BadMethodCallException'], 405));
		
		elseif ($exception instanceof \InvalidArgumentException)
			abort(response()->json(['error' => 'InvalidArgumentException'], 405));
		
		elseif ($exception instanceof \ErrorException)
			abort(response()->json(['error' => 'ErrorException'], 405));
		
		elseif ($exception instanceof \ReflectionException)
			abort(response()->json(['error' => 'ReflectionException'], 405));
		
		elseif ($exception instanceof BindingResolutionException)
			abort(response()->json(['error' => 'BindingResolutionException'], 405));
		
		elseif ($exception instanceof \ParseError)
			abort(response()->json(['error' => 'ParseError'], 405));
		
		elseif ($exception instanceof \ArgumentCountError)
			abort(response()->json(['error' => 'ArgumentCountError'], 405));
		
		elseif ($exception instanceof FatalError)
			abort(response()->json(['error' => 'FatalError'], 500));
		
		elseif ($exception instanceof \Error)
			abort(response()->json(['error' => 'Error'], 500));
		
		elseif ($exception instanceof HttpResponseException)
			abort(response()->json(['error' => 'HttpResponseExecption'], 500));
		
		elseif ($exception instanceof AuthorizationException)
			abort(response()->json(['error' => 'Unauthorized'], 401));

		elseif ($exception instanceof \PDOException)
			abort(response()->json(['error' => 'PDOExecption'], 500));

		return parent::render($request, $exception);
	}
}
