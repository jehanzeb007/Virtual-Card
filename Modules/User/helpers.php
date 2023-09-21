<?php

if (! function_exists('permission_value')) {
    /**
     * Get the integer representation value of the permission.
     *
     * @param array $permissions
     * @param string $permission
     * @return int
     */
    function permission_value(array $permissions, $permission)
    {
        $value = array_get($permissions, $permission);

        if (is_null($value)) {
            return 0;
        } elseif ($value) {
            return 1;
        } elseif (! $value) {
            return -1;
        }
    }
}
if (! function_exists('_encode')) {
    function _encode($str){
        $str = base64_encode($str);
        $str = str_replace('=','gcc_ab',$str);
        $str = str_replace('Z','jazznju',$str);
        //$str = gzcompress($str, 9);
        $str = strtr(base64_encode($str), '+/=', '._-');
        return urlencode($str);
    }
}
if (! function_exists('_decode')) {
    function _decode($str)
    {
        $str = base64_decode(strtr(urldecode($str), '._-', '+/='));
        //$str = gzuncompress($str);
        $str = str_replace('gcc_ab', '=', $str);
        $str = str_replace('jazznju', 'Z', $str);

        $str = base64_decode($str);

        return $str;
    }
}
if (! function_exists('getThisUserLinks')) {
    function getThisUserLinks($user_id)
    {
        return \Modules\User\Entities\User::select('id')->where('refer_id','=',$user_id)->get()->toArray();
    }
}
