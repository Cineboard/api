<?php

namespace Cineboard\Helper;

use Illuminate\Contracts\Debug\ExceptionHandler;
use Slim\Http\Request;

/**
 * DbConnExceptionHandler
 *
 * Handling errors connection with database
 */
class DbConnExceptionHandler implements ExceptionHandler
{
    /**
     * Report errors
     *
     * @param \Exception $err error
     *
     * @throws \Exception $err error
     */
    public function report(\Exception $err)
    {
        throw $err;
    }

    /**
     * Render errors
     *
     * @param Request $request request
     * @param \Exception $err error
     *
     * @throws \Exception $err error
     */
    public function render($request, \Exception $err)
    {
        throw $err . $request;
    }

    /**
     * Render for console errors
     *
     * @param mixed $output output
     * @param \Exception $err error
     *
     * @throws \Exception $err error
     */
    public function renderForConsole($output, \Exception $err)
    {
        throw $err . $output;
    }
}
