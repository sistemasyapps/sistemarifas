<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class R4Verify
{
    public function handle(Request $request, Closure $next): Response
    {
        // Only JSON
        $contentType = strtolower((string) $request->header('Content-Type'));
        if ($contentType === '' || !str_starts_with($contentType, 'application/json')) {
            return response()->json(['message' => 'Unsupported Media Type'], 415);
        }

        // IP allow list (opcional)
        $allowList = array_filter(array_map('trim', explode(',', (string) env('R4_ALLOWED_IPS', ''))));
        if (!empty($allowList)) {
            $ip = $request->ip();
            if (!in_array($ip, $allowList, true)) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
        }

        $path = $request->path(); // e.g. "api/R4consulta" or "api/R4notifica"

        // Según PDF: para R4consulta y R4notifica solo se exige Authorization en formato UUID y Content-Type JSON.
        if ($request->is('api/R4consulta') || $request->is('api/R4notifica')) {
            $auth = (string) $request->header('Authorization');
            $expected = env('R4_AUTH_TOKEN');

            // Validar formato UUID y coincidencia exacta con R4_AUTH_TOKEN
            $uuidRegex = '/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/';
            if (!$auth || !$expected || !hash_equals($expected, $auth) || !preg_match($uuidRegex, $auth)) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            return $next($request);
        }

        // Fallback para otros endpoints (no usados actualmente):
        // Exigir Commerce + Authorization HMAC-SHA256 de "Banco" usando Commerce como clave
        $commerce = $request->header('Commerce');
        $auth = $request->header('Authorization');
        $expected = $commerce ? hash_hmac('sha256', 'Banco', $commerce) : null;
        if (!$commerce || !$auth || !$expected || !hash_equals($expected, $auth)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
