<?php

namespace App\Exceptions;

use Throwable;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    /**
     * Render an exception into an HTTP response (serverless-friendly).
     */
    public function render($request, Throwable $e)
    {
        // For Vercel serverless: avoid Blade view compilation errors
        if (app()->environment('production') && $request->expectsJson() === false) {
            $statusCode = $e instanceof HttpExceptionInterface ? $e->getStatusCode() : 500;
            // Always show the exception message here for debugging (temporary)
            $message = $e->getMessage() . ' [' . get_class($e) . ']';
            $trace = collect($e->getTrace())->take(5)->map(function ($t) {
                return (isset($t['file']) ? $t['file'] . ':' . ($t['line'] ?? '') : '') . ' ' . ($t['function'] ?? '');
            })->implode("\n");
            
            // Return simple HTML response instead of compiled Blade view
            return response()->make(
                '<!DOCTYPE html>
                <html>
                <head>
                    <title>Error ' . $statusCode . '</title>
                    <style>
                        body { font-family: sans-serif; text-align: center; padding: 50px; }
                        h1 { font-size: 48px; margin: 0; }
                        p { color: #666; }
                    </style>
                </head>
                <body>
                    <h1>' . $statusCode . '</h1>
                    <p>' . htmlspecialchars($message) . '</p>
                    <pre style="text-align:left; white-space:pre-wrap; color:#333; background:#f5f5f5; padding:10px; border-radius:6px;">' . htmlspecialchars($trace) . '</pre>
                    <p><a href="/">← Back to Home</a></p>
                </body>
                </html>',
                $statusCode
            );
        }

        return parent::render($request, $e);
    }
}

