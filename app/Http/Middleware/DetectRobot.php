<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectRobot
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $userAgent = strtolower($request->userAgent());

        $bots = [
            'bot', 'crawl', 'slurp', 'spider', 'mediapartners', 'google', 'bing', 'yandex', 'baidu', 'duckduckbot',
        ];

        $isBot = false;
        foreach ($bots as $bot) {
            if (strpos($userAgent, $bot) !== false) {
                $isBot = true;
                break;
            }
        }

        // Simpan status bot ke request agar bisa dipakai di controller
        $request->merge(['is_bot' => $isBot]);

        return $next($request);
    }
}
