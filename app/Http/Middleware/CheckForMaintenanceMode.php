<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckForMaintenanceMode
{
    protected $app;

    public function __construct(Application $app)
    {
        $this->app = $app;
    }

    public function handle($request, Closure $next)
    {
        if ($this->app->isDownForMaintenance() && !$this->isBackendRequest($request)) {
            // $data = json_decode(file_get_contents($this->app->storagePath() . '/framework/down'), true);

            // throw new MaintenanceModeException($data['time'], $data['retry'], $data['message']);
            return abort(503);
        }

        return $next($request);
    }

    private function isBackendRequest($request)
    {
        return ($request->is('admin*') or $request->is('login') or $request->is('logout'));
    }
}