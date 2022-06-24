<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendEmail;

use App\Http\Controllers\Controller;

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Jobs\SendEmail;
use App\Http\Controllers\Controller;

class JobController extends Controller
{
    /**
     * Enqueue jobs
     */
    public function enqueue(Request $request)
    {
        $details = ['email' => 'recipient@example.com'];
        $emailJob = (new      SendEmail($details))->delay(Carbon::now()->addMinutes(5));
        dispatch($emailJob);
    }
    /**
     *
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Symfony\Component\HttpKernel\Exception\HttpException
     */

    //synchronously
    // public function enqueue(Request $request)
    // {
    //     $details = ['email' => 'recipient@example.com'];
    //     SendEmail::dispatchNow($details);
    // }
}