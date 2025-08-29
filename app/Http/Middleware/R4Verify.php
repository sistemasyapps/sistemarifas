<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class R4Verify
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only JSON over HTTPS
        if (strtolower((string) $request->header('Content-Type')) !== 'application/json') {
            return response()->json(['message' => 'Unsupported Media Type'], 415);
        }

        // IP allow list (optional but recommended by docs)
        $allowList = array_filter(array_map('trim', explode(',', (string) env('R4_ALLOWED_IPS', ''))));
        if (!empty($allowList)) {
            $ip = $request->ip();
            if (!in_array($ip, $allowList, true)) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        // Commerce header required
        $commerce = $request->header('Commerce');
        if (!$commerce || $commerce !== env('R4_COMMERCE')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Authorization HMAC-SHA256 hex of string "Banco" using key = Commerce
        $auth = $request->header('Authorization');
        $expected = hash_hmac('sha256', 'Banco', $commerce);
        if (!$auth || !hash_equals($expected, $auth)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}

