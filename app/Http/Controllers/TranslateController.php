<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use Illuminate\Http\Request;

class TranslateController extends Controller
{
    public function translate(Request $request)
    {
        $translation = null;
        $text = $request->text;

        if ($text) {
            $exploded = explode(' ', $text);
            $words = [];
            foreach ($exploded as $word) {
                /** @var Dictionary $model */
                $model = Dictionary::where('english', $word)->first();
                if (null === $model) {
                    continue;
                }
                $words[] = $model->getInterslavic();
            }
            $translation = implode(' ', $words);
        }

        return view('translate', compact('translation', 'text'));
    }
}
