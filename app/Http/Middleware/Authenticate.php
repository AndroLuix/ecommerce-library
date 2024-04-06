<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware

{

    public function handle($request, \Closure $next, ...$guards){
        $this->guards = $guards;
        return parent::handle($request, $next, ...$guards);
    }
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
    $typeUser = $this->guards;
    //dd($typeUser);
    if($typeUser[0] == 'admin'){

        //dd('ok');
        return $request->expectsJson() ? null : route('admin.login.attempt');
        
    }else{
        return $request->expectsJson() ? null : route('login');
    }

    }
}
