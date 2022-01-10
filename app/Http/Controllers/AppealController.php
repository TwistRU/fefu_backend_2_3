<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppealPostRequest;
use App\Models\Appeal;
use App\Sanitizers\PhoneSanitizer;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function __invoke(Request $request)
    {
        $suggest_shown = $request->session()->get('suggest_shown');
        if ($suggest_shown) {
            $request->session()->put("suggest_shown", false);
        }
        if ($request->isMethod('POST')) {
            $validated = $request->validate(AppealPostRequest::rules());
            $appeal = new Appeal();
            $appeal->name = $validated['name'];
            $appeal->surname = $validated['surname'];
            $appeal->patronymic = $validated['patronymic'];
            $appeal->age = $validated['age'];
            $appeal->gender = $validated['gender'];
            $appeal->phone = PhoneSanitizer::sanitize($validated['phone']);
            $appeal->email = $validated['email'];
            $appeal->message = $validated['message'];
            $appeal->save();
            $request->session()->put("appealed", true);
            return redirect()->route('appeal');
        }
        return view('appeal')->with("suggest_shown", $suggest_shown);
    }
}
