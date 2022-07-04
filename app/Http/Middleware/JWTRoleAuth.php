<?php

namespace App\Http\Middleware;

use App\Models\Admin\Log\UserAction;
use App\Models\Admin\UserRole;
use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;

class JWTRoleAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next , $role = null)
    {
        try {
            // 解析token角色
            $tokenRole = JWTAuth::parseToken()->getClaim('role');
            $user = JWTAuth::parseToken()->authenticate();
            $request->merge(['user' => $user]);

            $response = $next($request);
            if ($tokenRole=='admin') {
                if ($permission = $this->getPermission($request)){
                    $hasPermission = $this->hasPermission($user,$permission);
                    if (!$hasPermission){
                        return response()->json([
                            'code' => 403,
                            'msg' => '暂无权限',  //无权限访问
                        ]);
                    }
                }
            }
            return $response;
        } catch (TokenExpiredException $e) {

            return response()->json([
                'code' => 401,
                'msg' => 'TOKEN 过期' , //token已过期
            ]);
        } catch (TokenInvalidException $e) {

            return response()->json([
                'code' => 401,
                'msg' => 'TOKEN 无效',  //token无效
            ]);
        } catch (JWTException $e) {

            return response()->json([
                'code' => 401,
                'msg' => '缺少TOKEN' , //token为空
            ]);
        }
    }
    protected function hasPermission($user ,$permission){
        if ($permission == 'logout'){
            $name = '退出登陆';
        }elseif($menu = UserRole::select('menu.name','menu.permission')
            ->where('user_role.user_id',$user->id)
            ->where('menu.permission',$permission)
            ->join('role', 'role.id', '=', 'user_role.role_id')
            ->join('role_menu', 'role.id', '=', 'role_menu.role_id')
            ->join('menu', 'menu.id', '=', 'role_menu.menu_id')
            ->first()){
            $name = $menu->name;
        }else{
            return false;
        }
        UserAction::record($name);
        return true;
    }
    protected function getPermission($request)
    {
        $actions = $request->route()->getAction();
        if (!empty($actions['permission'])) {
            return is_array($actions['permission'])?end($actions['permission']):$actions['permission'];
        }
        return false;
    }
}
