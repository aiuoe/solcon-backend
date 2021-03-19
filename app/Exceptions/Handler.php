<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\ErrorHandler\Error\FatalError;
use Nuwave\Lighthouse\Exceptions\AuthorizationException;
use Throwable;


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
		if ($exception instanceof NotFoundHttpException || $exception instanceof ModelNotFoundException)
			abort(404);
		
		elseif ($exception instanceof \ArgumentCountError || $exception instanceof \ParseError || $exception instanceof BindingResolutionException || $exception instanceof \ReflectionException || $exception instanceof \ErrorException || $exception instanceof \InvalidArgumentException || $exception instanceof \BadMethodCallException || $exception instanceof MethodNotAllowedHttpException)
			abort(405);
		
		elseif ($exception instanceof AuthorizationException)
			abort(401);

		elseif ($exception instanceof \Exception || $exception instanceof HttpException || $exception instanceof HttpResponseException || $exception instanceof \Error || $exception instanceof FatalError || $exception instanceof \PDOException || $exception instanceof QueryException)
			abort(500);

		return parent::render($request, $exception);
	}

	public function report(Throwable $exception)
	{
	    if (app()->bound('sentry') && $this->shouldReport($exception)) {
	        app('sentry')->captureException($exception);
	    }

	    parent::report($exception);
	}
}
