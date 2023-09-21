<?php

namespace Modules\Account\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Image;
use mdeschermeier\shiphero\Shiphero;
use Modules\Order\Entities\Order;
use Modules\User\Entities\User;
use Modules\User\Entities\UserInfo;
use Modules\User\Entities\ProfileCounters;
use Modules\User\Http\Requests\UpdateProfileRequest;
use File;
use JeroenDesloovere\VCard\VCard;

class AccountProfileController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function view($username)
    {
        $my = User::where( 'username', '=', $username )->orWhere( 'username2', '=', $username )->with( 'user_info' )->first();
        if (empty( $my )) {
            abort( 404 );
        }
        if ($my->hasRoleId( 3 )) {
            abort( 404 );
        }

        if(!empty($my->username2) && $my->username2 != $username){
            return \redirect()->route('account.profile.view',$my->username2);
        }
        $guest_user_ip = get_client_ip();
        if (!empty( $guest_user_ip )) {
            $is_already_visit = ProfileCounters::where( 'ip', '=', $guest_user_ip )->where( 'user_id', '=', $my->id )->where( 'type', '=', 'View' )->count();
            if ($is_already_visit == 0) {
                $data_counter = [];
                $data_counter['ip'] = $guest_user_ip;
                $data_counter['user_id'] = $my->id;
                $data_counter['type'] = 'View';
                ProfileCounters::insert( $data_counter );
            }
        }
        $counters = ProfileCounters::select( \DB::raw( 'count(*) as total' ), 'type' )->where( 'user_id', '=', $my->id )->groupBy( 'type' )->pluck( 'total', 'type' )->toArray();
        //_debug($counters,1);
        return view( 'public.account.profile.view', compact( 'my', 'counters' ) );
    }

    public function edit()
    {
        $my = auth()->user();
        //_debug($my,1);
        return view( 'public.account.profile.edit', compact( 'my' ) );
    }

    public function updatePassword()
    {
        $my = auth()->user();
        return view( 'public.account.profile.updatepassword', compact( 'my' ) );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Modules\User\Http\Requests\UpdateProfileRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProfileRequest $request)
    {
        /*echo '<pre>';
        print_r($request->all());exit;*/
        /*$is_exists = User::where('id','!=',Auth::user()->id)->where('username','=',$request->get('username'))->count();
        if($is_exists){
            return redirect()->back()->with('errors',['Sorry! This username is not available.']);
        }*/
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'unique' => 'The :attribute has already been taken.'
        ];
        $validator = \Validator::make( $request->all(), [
            'username' => 'required|unique:users,username,' . Auth::user()->id
        ], $customMessages );
        if ($validator->fails()) {
            return Redirect::back()->withInput()->withErrors( $validator->errors() );
        }
        /*$is_email_exists = User::where('id','!=',Auth::user()->id)->where('username2','=',$request->username)->count();
        if($is_email_exists > 0){
            return Redirect::back()->withInput()->withErrors(['Sorry! This username is not available.']);
        }*/
        $data_update = $request->all();
        if ($request->hasFile( 'profile' )) {
            $file = $request->file( 'profile' );
            $file_name = 'profile-pic.' . $file->getClientOriginalExtension();
            $avatar = $file_name;
            $destinationPath = public_path() . '/images/users/' . auth()->user()->id . '/';
            if (!File::isDirectory( $destinationPath )) {
                File::makeDirectory( $destinationPath, 0777, true, true );
            }
            $data_update['avatar'] = $avatar;
            $file->move( $destinationPath, $file_name );
        } else {
            unset( $data_update['avatar'] );
        }
        $this->bcryptPassword( $request );

        if (!empty( auth()->user()->username2 )) {
            unset( $data_update['username'] );
            if (isset( $data_update['username2'] )) {
                unset( $data_update['username2'] );
            }
        } else {
            $trim_user = trim($data_update['username']);

            $data_update['username2'] = strtolower(str_replace(' ','.',$data_update['username']));
            unset( $data_update['username'] );
        }
        auth()->user()->update( $data_update );
        $data_user_info = [];
        $data_user['first_name'] = $request->first_name;
        $data_user['middle_name'] = $request->middle_name;
        $data_user['last_name'] = $request->last_name;
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
        $data_user_info['company_email'] = $request->company_email;
        $data_user_info['showEmail'] = $request->showEmail;
        $data_user_info['showWhatsapp'] = $request->showWhatsapp;
        $data_user_info['showJobWhatsapp'] = $request->showJobWhatsapp;
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
        $data_user_info['twitter'] = str_replace('@','',$request->twitter);
        $data_user_info['instagram'] = str_replace('@','',$request->instagram);
        $data_user_info['tiktok'] = $request->tiktok;
        $data_user_info['tumblr'] = $request->tumblr;
        $data_user_info['twitch'] = $request->twitch;
        $data_user_info['pinterest'] = $request->pinterest;
        $data_user_info['snapchat'] = str_replace('@','',$request->snapchat);
        $data_user_info['linkedin'] = $request->linkedin;
        $data_user_info['cash_app'] = $request->cash_app;
        $data_user_info['paypal'] = $request->paypal;
        $data_user_info['venmo'] = $request->venmo;
        $bank = [];
        $bank['title'] = $request->bank_title;
        $bank['bank_ibn'] = $request->bank;
        $data_user_info['bank'] = json_encode( $bank );
        $data_user_info['youtube'] = $request->youtube;
        $data_user_info['vimeo'] = $request->vimeo;
        $data_user_info['soundcloud'] = $request->soundcloud;
        $data_user_info['spotify'] = $request->spotify;
        $data_user_info['vsco'] = $request->vsco;
        $data_user_info['other_music'] = json_encode( $request->other_music );
        $data_user_info['favorite_links'] = json_encode( $request->favorite_links );
        $data_user_info['other_bank'] = json_encode( $request->other_bank );
        if (UserInfo::where( 'user_id', '=', auth()->user()->id )->count() == 0) {
            $data_user_info['user_id'] = auth()->user()->id;
            UserInfo::insert( $data_user_info );
        } else {
            UserInfo::where( 'user_id', '=', auth()->user()->id )->update( $data_user_info );
        }
        User::where( 'id', '=', auth()->user()->id )->update( $data_user );
        /*echo '<pre>';
        print_r($data_user_info);exit;*/
        return back()->withSuccess( trans( 'account::messages.profile_updated' ) );
    }

    /**
     * Bcrypt user password.
     *
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    private function bcryptPassword($request)
    {
        if ($request->filled( 'password' )) {
            return $request->merge( ['password' => bcrypt( $request->password )] );
        }

        unset( $request['password'] );
    }

    function generateVcard($username)
    {
        $my = User::where( 'username', '=', $username )->with( 'user_info' )->first();
        if (empty( $my )) {
            abort( 404 );
        }
        $guest_user_ip = get_client_ip();
        if (!empty( $guest_user_ip )) {
            $is_already_visit = ProfileCounters::where( 'ip', '=', $guest_user_ip )->where( 'user_id', '=', $my->id )->where( 'type', '=', 'Download' )->count();
            if ($is_already_visit == 0) {
                $data_counter = [];
                $data_counter['ip'] = $guest_user_ip;
                $data_counter['user_id'] = $my->id;
                $data_counter['type'] = 'Download';
                ProfileCounters::insert( $data_counter );
            }
        }
        $vcard = new VCard();

        $iPod = stripos( $_SERVER['HTTP_USER_AGENT'], "iPod" );
        $iPhone = stripos( $_SERVER['HTTP_USER_AGENT'], "iPhone" );

        $user_info = $my->toArray();
        // define variables
        $lastname = $user_info['first_name'];
        $firstname = $user_info['last_name'];
        $additional = $user_info['middle_name'];
        $prefix = '';
        $suffix = '';

        // add personal data
        $vcard->addName( $firstname, $lastname, $additional, $prefix, $suffix );

        // add work data
        $vcard->addCompany( $user_info['user_info']['company'] );
        $vcard->addJobtitle( $user_info['user_info']['job_title'] );
        $vcard->addRole( '' );
        if ($user_info['user_info']['showEmail'] != 'on') {
            $vcard->addEmail( $user_info['email'] );
        }
        $vcard->addPhoneNumber( $user_info['user_info']['phone'], 'PREF;CELL' );
        $vcard->addPhoneNumber( $user_info['user_info']['job_phone'], 'WORK' );
        if (!empty( $user_info['user_info']['street_address_1'] )) {
            $vcard->addAddress( $user_info['user_info']['street_address_1'] );
        }
        if (!empty( $user_info['user_info']['street_address_2'] )) {
            $vcard->addLabel( $user_info['user_info']['street_address_2'], 'TYPE=Street Address 2' );
        }
        if ($iPod || $iPhone) {
            $vcard->addNote( 'iOS13? Hard press on the profile picture to save the contact!' );
        } else {
            $vcard->addNote( $user_info['user_info']['about_me'] );
        }
        $vcard->addURL( route( 'account.profile.view', $my->username2 ), 'TYPE=Contact public profile' );
        $destinationPath = public_path() . '/images/users/' . $user_info['id'] . '/';

        if (!empty( $user_info['avatar'] )) {
            $file_path = $destinationPath . $user_info['avatar'];
            if (file_exists( $file_path )) {
                $thumb_path = $destinationPath . 'thumb-' . $user_info['avatar'];
                if (!file_exists( $thumb_path )) {
                    \Image::make( $file_path )->resize( 300, 300 )->save( $thumb_path );
                }
                $vcard->addPhoto( $thumb_path );
            }
        } else {
            $file_path = $destinationPath . '1';
            $vcard->addPhoto( public_path() . '/images/users/default.jpg' );
        }

        return $vcard->download();
    }

    function uploadUserImage(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'avatar' => 'required|mimes:jpg,jpeg,bmp,png',
        ] );
        if ($validator->fails()) {
            return ['success' => 'false', 'message' => $validator->errors()];
        }
        $path = public_path() . '/images/users/' . auth()->user()->id . '/';
        $data = [];
        if ($request->hasFile( 'avatar' )) {
            $file = $request->avatar;
            $file_name = 'profile-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move( $path, $file_name );

            $file_path = $path . $file_name;
            $thumb_path = $path . 'thumb-' . $file_name;
            \Image::make( $file_path )->resize( 300, 300 )->save( $thumb_path );
            $data['avatar'] = $file_name;
        }
        if (count( $data ) > 0) {
            if (count( $data ) > 0) {
                User::whereId( auth()->user()->id )->update( $data );
            }
        }
        $image_path = url( '/images/users/' . auth()->user()->id . '/' . 'thumb-' . $data['avatar'] );
        return ['success' => 'true', 'message' => 'Image Update Successfully.', 'image_path' => $image_path];
    }

    function removeUserImage(Request $request)
    {

        $data['avatar'] = NULL;

        if (count( $data ) > 0) {
            if (count( $data ) > 0) {
                User::whereId( auth()->user()->id )->update( $data );
            }
        }

        $image_path = url( '/images/users/default.jpg' );
        return ['success' => 'true', 'message' => 'Image removed Successfully.', 'image_path' => $image_path];
    }

    function removeCompanyImage(Request $request)
    {

        $data['company_avatar'] = NULL;

        if (count( $data ) > 0) {
            if (count( $data ) > 0) {
                User::whereId( auth()->user()->id )->update( $data );
            }
        }

        $image_path = url( '/images/users/default.jpg' );
        return ['success' => 'true', 'message' => 'Image removed Successfully.', 'image_path' => $image_path];
    }

    function uploadCompImage(Request $request)
    {
        $validator = \Validator::make( $request->all(), [
            'company_avatar' => 'required|mimes:jpg,jpeg,bmp,png',
        ] );
        if ($validator->fails()) {
            return ['success' => 'false', 'message' => $validator->errors()];
        }
        $path = public_path() . '/images/users/' . auth()->user()->id . '/';
        $data = [];
        if ($request->hasFile( 'company_avatar' )) {
            $file = $request->company_avatar;
            $file_name = 'company-' . time() . '.' . $file->getClientOriginalExtension();
            $file->move( $path, $file_name );

            $file_path = $path . $file_name;
            $thumb_path = $path . 'thumb-' . $file_name;
            \Image::make( $file_path )->resize( 300, 300 )->save( $thumb_path );

            $data['company_avatar'] = $file_name;
        }
        if (count( $data ) > 0) {
            if (count( $data ) > 0) {
                User::whereId( auth()->user()->id )->update( $data );
            }
        }

        $image_path = url( '/images/users/' . auth()->user()->id . '/' . 'thumb-' . $data['company_avatar'] );
        return ['success' => 'true', 'message' => 'Image Update Successfully.', 'image_path' => $image_path];
    }

    function cronSendOrders()
    {
        $orders = Order::where( 'status', '=', 'pending' )->where( 'sent_for_delivery', '=', 'No' )->get();
        if ($orders->count() > 0) {
            Shiphero::setKey( '0a5c4b0e17978e3644daae5502e06c9cc77c4ea1' );
            Shiphero::verifyPeer( false ); //Disables Host/Peer Verification
            foreach ($orders as $order) {
                //_debug($order);
                // Define the order
                $items_Array = [];
                foreach ($order->products as $product) {
                    $items_Array[] = [
                        'sku' => 'SC-' . $product->id,
                        'name' => $product->name,
                    ];
                }
                $order_post = array(
                    'email' => $order->customer_email,
                    'line_items' => $items_Array,
                    'note_attributes' => array(),
                    'shipping_address' => array(
                        'first_name' => $order->shipping_first_name,
                        'last_name' => $order->shipping_first_name,
                        'phone' => $order->customer_phone,
                        'address1' => $order->shipping_address_1,
                        'address2' => $order->shipping_address_2,
                        'city' => $order->shipping_city,
                        'province' => $order->shipping_state,
                        'province_code' => $order->shipping_zip,
                        'country' => $order->shipping_country_name,
                        'country_code' => $order->shipping_country,
                    ),
                    'order_id' => $order->id,
                    'subtotal_price' => $order->sub_total->format( $order->currency ),
                    'total_price' => $order->total->format( $order->currency ),
                    'total_discounts' => $order->discount->format( $order->currency ),
                );
                //_debug($order,1);
                // Create the Order
                $order_response = Shiphero::createOrder( $order_post );
                Order::whereId( $order->id )->update( ['delivery_response' => json_encode( $order_response ), 'sent_for_delivery' => 'Yes'] );
                //echo $order->id;
                //_debug($order_response,1);
            }
        }
        return 'true';
    }
    function bar_codes_url_fix($file_name){
        $file_name = str_replace('.png','',$file_name);
        return \redirect()->to(route('cardLogin',\_encode($file_name)));

    }
}
