<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Smtp;
use Illuminate\Http\Request;

class SmtpController extends Controller
{
    public function index()
    {
        $smtp = Smtp::find(1);
        return view('admin.pages.settings.smtp.index', compact('smtp'));
    }

    public function update(Request $request)
    {
        $smtp = Smtp::find(1);
        if ($smtp) {
            $smtp->update([
                'mailer' => $request->mailer,
                'host' => $request->host,
                'port' => $request->port,
                'user_name' => $request->user_name,
                'password' => $request->password,
            ]);
            return redirect()->back();
        } else {
            $smtp = new Smtp();
            $smtp->create([
                'mailer' => $request->mailer,
                'host' => $request->host,
                'port' => $request->port,
                'user_name' => $request->user_name,
                'password' => $request->password,
            ]);

            return redirect()->back();
        }
    }
}
