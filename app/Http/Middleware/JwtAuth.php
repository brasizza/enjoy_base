<?php

namespace App\Http\Middleware;

use App\Traits\ApiResponser;
use Closure;
use Exception;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class JwtAuth
{

    use ApiResponser;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->hasHeader('Authorization')) {
            return $this->errorResponse('Token inválido', Response::HTTP_UNAUTHORIZED);
        }
        try {
            $bearer = trim(str_replace('Bearer', '', $request->header('Authorization')));
            $decoded = JWT::decode($bearer, new Key(file_get_contents('../cert/pub'), 'RS256'));

            if (time() > $decoded->exp) {
                return $this->errorResponse('Token expirado', Response::HTTP_UNAUTHORIZED);
            }
        } catch (ExpiredException $e) {
            return $this->errorResponse('Token expirado', Response::HTTP_UNAUTHORIZED);
        } catch (Exception $e) {
            return $this->errorResponse('Falha no token', Response::HTTP_FORBIDDEN);
        }
        $request->headers->add(['parceiro' => $decoded->uid, 'parceiro_md5' => md5($decoded->uid.'__TOKEN__')]);

        return $next($request);
    }
}


