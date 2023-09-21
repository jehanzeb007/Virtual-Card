<?php

namespace Modules\User\Http\Controllers\Admin;

use Modules\User\Entities\User;
use Illuminate\Routing\Controller;
use Modules\Admin\Traits\HasCrudActions;
use Modules\User\Entities\UserInfo;
use Modules\User\Http\Requests\SaveUserRequest;
use Cartalyst\Sentinel\Laravel\Facades\Activation;

class UserController extends Controller
{
    use HasCrudActions;

    /**
     * Model for the resource.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Label of the resource.
     *
     * @var string
     */
    protected $label = 'user::users.user';

    /**
     * View path of the resource.
     *
     * @var string
     */
    protected $viewPath = 'user::admin.users';

    /**
     * Form requests for the resource.
     *
     * @var array|string
     */
    protected $validation = SaveUserRequest::class;

    /**
     * Store a newly created resource in storage.
     *
     * @param \Modules\User\Http\Requests\SaveUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveUserRequest $request)
    {

        $request->merge(['password' => bcrypt($request->password)]);

        $user_data = $request->all();
        $user_data['username'] = $request->first_name.rand(1,999);
        $user = User::create($user_data);

        $user->roles()->attach($request->roles);
        Activation::complete($user, Activation::create($user)->code);

        $data_user_info = [];
        $data_user_info['phone'] = $request->phone;
        $data_user_info['street_address_1'] = $request->street_address_1;
        $data_user_info['street_address_2'] = $request->street_address_2;
        $data_user_info['zip'] = $request->zip;
        $data_user_info['state'] = $request->state;
        $data_user_info['country'] = $request->country;
        $data_user_info['city'] = $request->city;
        $data_user_info['profession'] = $request->profession;
        $data_user_info['about_me'] = $request->about_me;
        $data_user_info['job_title'] = $request->job_title;
        $data_user_info['company'] = $request->company;
        $data_user_info['job_phone'] = $request->job_phone;
        $data_user_info['phone'] = $request->phone;
        $data_user_info['website'] = $request->website;
        $data_user_info['fax'] = $request->fax;
        $data_user_info['fb_messenger'] = $request->fb_messenger;
        $data_user_info['wechat'] = $request->wechat;
        $data_user_info['whatsapp'] = $request->whatsapp;
        $data_user_info['skype'] = $request->skype;
        $data_user_info['telegram'] = $request->telegram;
        $data_user_info['facebook'] = $request->facebook;
        $data_user_info['facebook_page'] = $request->facebook_page;
        $data_user_info['twitter'] = $request->twitter;
        $data_user_info['instagram'] = $request->instagram;
        $data_user_info['tumblr'] = $request->tumblr;
        $data_user_info['pinterest'] = $request->pinterest;
        $data_user_info['snapchat'] = $request->snapchat;
        $data_user_info['linkedin'] = $request->linkedin;
        $data_user_info['cash_app'] = $request->cash_app;
        $data_user_info['paypal'] = $request->paypal;
        $data_user_info['venmo'] = $request->venmo;
        $data_user_info['bank'] = $request->bank;
        $data_user_info['youtube'] = $request->youtube;
        $data_user_info['vimeo'] = $request->vimeo;
        $data_user_info['soundcloud'] = $request->soundcloud;
        $data_user_info['revebnation'] = $request->revebnation;
        $data_user_info['other_music'] = json_encode($request->other_music);
        $data_user_info['favorite_links'] = json_encode($request->favorite_links);
        $data_user_info['user_id'] = $user->id;

        UserInfo::insert($data_user_info);

        return redirect()->route('admin.users.index')
            ->withSuccess(trans('admin::messages.resource_saved', ['resource' => trans('user::users.user')]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @param \Modules\User\Http\Requests\SaveUserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, SaveUserRequest $request)
    {
        $user = User::findOrFail($id);

        if (is_null($request->password)) {
            unset($request['password']);
        } else {
            $request->merge(['password' => bcrypt($request->password)]);
        }

        $user->update($request->all());

        $data_user_info = [];
        $data_user_info['phone'] = $request->phone;
        $data_user_info['street_address_1'] = $request->street_address_1;
        $data_user_info['street_address_2'] = $request->street_address_2;
        $data_user_info['zip'] = $request->zip;
        $data_user_info['state'] = $request->state;
        $data_user_info['country'] = $request->country;
        $data_user_info['city'] = $request->city;
        $data_user_info['profession'] = $request->profession;
        $data_user_info['about_me'] = $request->about_me;
        $data_user_info['job_title'] = $request->job_title;
        $data_user_info['company'] = $request->company;
        $data_user_info['job_phone'] = $request->job_phone;
        $data_user_info['phone'] = $request->phone;
        $data_user_info['website'] = $request->website;
        $data_user_info['fax'] = $request->fax;
        $data_user_info['fb_messenger'] = $request->fb_messenger;
        $data_user_info['wechat'] = $request->wechat;
        $data_user_info['whatsapp'] = $request->whatsapp;
        $data_user_info['skype'] = $request->skype;
        $data_user_info['telegram'] = $request->telegram;
        $data_user_info['facebook'] = $request->facebook;
        $data_user_info['facebook_page'] = $request->facebook_page;
        $data_user_info['twitter'] = $request->twitter;
        $data_user_info['instagram'] = $request->instagram;
        $data_user_info['tumblr'] = $request->tumblr;
        $data_user_info['pinterest'] = $request->pinterest;
        $data_user_info['snapchat'] = $request->snapchat;
        $data_user_info['linkedin'] = $request->linkedin;
        $data_user_info['cash_app'] = $request->cash_app;
        $data_user_info['paypal'] = $request->paypal;
        $data_user_info['venmo'] = $request->venmo;
        $data_user_info['youtube'] = $request->youtube;
        $data_user_info['vimeo'] = $request->vimeo;
        $data_user_info['bank'] = $request->bank;
        $data_user_info['soundcloud'] = $request->soundcloud;
        $data_user_info['revebnation'] = $request->revebnation;
        $data_user_info['other_music'] = json_encode($request->other_music);
        $data_user_info['favorite_links'] = json_encode($request->favorite_links);

        UserInfo::where('user_id','=',$id)->update($data_user_info);

        $user->roles()->sync($request->roles);

        if (! Activation::completed($user) && $request->activated === '1') {
            Activation::complete($user, Activation::create($user)->code);
        }

        if (Activation::completed($user) && $request->activated === '0') {
            return Activation::remove($user);
        }

        return redirect()->route('admin.users.index')
            ->withSuccess(trans('admin::messages.resource_saved', ['resource' => trans('user::users.user')]));
    }
}
