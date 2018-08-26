<?php

namespace App\Http\Middleware;

use App\Repositories\SocialMediaRepository;
use Carbon\Carbon;
use Closure;
use Illuminate\Support\Facades\Cache;

class GetSocialMedia
{
    private $repository;

    public function __construct(SocialMediaRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Cache::has('socialmedias')) {
            $socialMedias = $this->repository->findWhere([
                ['active', '=', 1],
                ['url', '<>', null],
            ]);

            $expiresAt = Carbon::now()->addDays(7);

            Cache::put('socialmedias', $socialMedias, $expiresAt);
        }

        return $next($request);
    }
}
