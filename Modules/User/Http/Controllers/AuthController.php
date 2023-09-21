<?php

namespace Modules\User\Http\Controllers;

use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Modules\Page\Entities\Page;
use Modules\User\Entities\User;
use Laravel\Socialite\Facades\Socialite;
use Modules\User\Http\Requests\RegisterRequest;

class AuthController extends BaseAuthController
{
    /**
     * Where to redirect users after login..
     *
     * @return string
     */
    protected function redirectTo()
    {
        if($this->auth->user()->hasRoleId(1)){
            return route('admin.dashboard.index');
        }
        if($this->auth->user()->hasRoleId(3)){
            return route('account.dashboard.index');
        }
        return route('account.profile.edit');
    }

    /**
     * The login URL.
     *
     * @return string
     */
    protected function loginUrl()
    {

        return route('login');
    }

    /**
     * Show login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogin()
    {
        return view('public.auth.login');
    }

    /**
     * Redirect the user to the given provider authentication page.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function redirectToProvider($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the given provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        if (! in_array($provider, app('enabled_social_login_providers'))) {
            abort(404);
        }

        try {
            $user = Socialite::driver($provider)->user();
        } catch (Exception $e) {
            return redirect()->route('login');
        }

        if (User::registered($user->getEmail())) {
            auth()->login(
                User::findByEmail($user->getEmail())
            );

            return redirect($this->redirectTo());
        }

        [$firstName, $lastName] = $this->extractName($user->getName());

        $registeredUser = $this->auth->registerAndActivate([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $user->getEmail(),
            'password' => str_random(),
        ]);

        $this->assignCustomerRole($registeredUser);

        auth()->login($registeredUser);

        return redirect($this->redirectTo());
    }

    private function extractName($name)
    {
        return explode(' ', $name, 2);
    }

    /**
     * Show registrations form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getRegister()
    {
        $privacyPageURL = Page::urlForPage(setting('storefront_privacy_page'));

        return view('public.auth.register', compact('privacyPageURL'));
    }

    /**
     * Show reset password form.
     *
     * @return \Illuminate\Http\Response
     */
    public function getReset()
    {
        return view('public.auth.reset.begin');
    }

    /**
     * Reset complete form route.
     *
     * @param \Modules\User\Entities\User $user
     * @param string $code
     * @return string
     */
    protected function resetCompleteRoute($user, $code)
    {
        return route('reset.complete', [$user->email, $code]);
    }

    /**
     * Password reset complete view.
     *
     * @return string
     */
    protected function resetCompleteView()
    {
        return view('public.auth.reset.complete');
    }
    function cardLogin($user_id){

        $user_id = _decode($user_id);

        $user = User::find($user_id);

        if(empty($user)){
            return redirect()->to(route('login'));
        }
        if($user && $user->password == 'nopassword'/*&& !empty($user->order_id)*/){
            return view('public.auth.card-register',['user_id'=>$user_id]);
        }
        if(!empty($user->refer_id)){
            $refer_id = $user->refer_id;
            $refer_user_info = User::whereId($refer_id)->first();
            return redirect()->to(route('account.profile.view',$refer_user_info->username));
        }
        return redirect()->to(route('account.profile.view',$user->username));
    }
    function cardPostRegister($user_id,RegisterRequest $request){
        $user = User::find($user_id);
        if(empty($user)){
            return redirect()->to(route('login'));
        }
        if($user && $user->password == 'nopassword'){


            if (! Activation::completed($user)) {
                Activation::complete($user, Activation::create($user)->code);
            }

            $trim_user = trim($user->username);

            $user->username = str_replace(' ','.',$trim_user).'.'.$user->id;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->created_at = date("Y-m-d H:i:s");
            $user->save();
            $this->assignCustomerRole($user);
            auth()->login($user);
            return redirect()->to(route('account.profile.edit'));
        }
        return redirect()->to(route('account.profile.view',$user->username));
    }
    function cardPostLogin($user_id){
        $request = \request()->all();
        //_debug($request,1);
        $user = User::find($user_id);
        if(empty($user)){
            return redirect()->to(route('login'));
        }
        if($user && $user->password == 'nopassword'/* && !empty($user->order_id)*/){

            $auth_data = [];
            if (!filter_var($request['user_name'], FILTER_VALIDATE_EMAIL)) {
                $auth_data['username'] = $request['user_name'];
            }else{
                $auth_data['email'] = $request['user_name'];
            }
            $auth_data['password'] = $request['password'];
            if (Auth::attempt($auth_data, 1)) {
                if (! Activation::completed($user)) {
                    Activation::complete($user, Activation::create($user)->code);
                }
                $trim_user = trim($user->username);

                $user->first_name = auth()->user()->first_name;
                $user->middle_name = auth()->user()->middle_name;
                $user->last_name = auth()->user()->last_name;
				$user->username = str_replace(' ','.',$trim_user).'.'.$user->id;
                $user->email = 'Refer to other user';
                $user->password = 'Refer to other user';
                $user->refer_id = auth()->user()->id;
                $user->save();
                $this->assignCustomerRole($user);
                return redirect()->to(route('account.profile.edit'));
            }else{
                return redirect()->back()->withErrors(['Invalid Email/Username Or Password']);
            }
        }
        return redirect()->to(route('account.profile.view',$user->username));

    }
    function getLogout(){
        auth()->logout();
        return redirect()->to(route('home'));
    }
}