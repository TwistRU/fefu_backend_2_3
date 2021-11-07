<?php

namespace App\Http\Controllers;

use App\Models\Appeal;
use Illuminate\Http\Request;

class AppealController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $errors = [];
        $success = $request->session()->get('success', false);

        if ($request->isMethod('POST')) {
            $name = $request->name;
            $phone = $request->phone;
            $email = $request->email;
            $message = $request->message;

            if ($name === null || $name === "") {
                $errors['name'] = "Поле \"Имя\" пустое";
            }
            if ($message === null || $message === "") {
                $errors['message'] = "Поле \"Сообщение\" пустое";
            }
            if (($phone === null || $phone === "") && ($email === null || $email === "")) {
                $errors['contacts'] = "Заполните одно из полей: Номер, Имя";
            }
            if (strlen($name) > 20) {
                $errors['nameSize'] = "Длина имени не должна превышать 20 cимволов";
            }
            if (strlen($phone) > 11) {
                $errors['phoneSize'] = "Длина номера не должна превышать 11 символов";
            }
            if (strlen($email) > 100) {
                $errors['emailSize'] = "Длина эл-почты не должна превышать 100 символов";
            }
            if (strlen($message) > 100) {
                $errors['messageSize'] = "Длина сообщения не должны превышать 100 символов";
            }
            if (count($errors) > 0) {
                $request->flash();
            } else {
                $appeal = new Appeal();
                $appeal->name = $name;
                $appeal->phone = $phone;
                $appeal->email = $email;
                $appeal->message = $message;
                $appeal->save();
                $success = true;
                return redirect()->route('appeal')->with('success', $success);
            }
        }
        return view('appeal', ['errors' => $errors, 'success' => $success]);
    }
}
