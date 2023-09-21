<?php

namespace Modules\Translation\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Translation\Entities\Translation;
use \Statickidz\GoogleTranslate;

class TranslationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $translations = Translation::retrieve();
        if(request()->has('translate') && request()->get('translate') == 'true'){
            foreach ($translations as $translationKey=>$translation){
                if(!isset($translation['es_DO'])){

                    $text = $translation['en'];
                    if(!empty(trim($text))){
                        $source = 'en';
                        $target = 'es_DO';
                        $trans = new GoogleTranslate();
                        $result = $trans->translate($source, $target, $text);

                        Translation::firstOrCreate(['key' => $translationKey])
                            ->translations()
                            ->updateOrCreate(
                                ['locale' => 'es_DO'],
                                ['value' => $result]
                            );
                    }
                }
            }
        }
        return view('translation::admin.translations.index', compact('translations'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param string $key
     * @return \Illuminate\Http\Response
     */
    public function update($key)
    {
        Translation::firstOrCreate(['key' => $key])
            ->translations()
            ->updateOrCreate(
                ['locale' => request('locale')],
                ['value' => request('value', '')]
            );

        return trans('admin::messages.resource_saved', ['resource' => trans('translation::translations.translation')]);
    }
}
