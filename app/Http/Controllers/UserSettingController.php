<?php

namespace App\Http\Controllers;



use App\Http\Requests\UserRequest;
use App\Interface\UserSettingInterface;
use App\Models\Language;
use App\Models\LogLogin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class UserSettingController extends Controller
{
    private $user;

    public function __construct(UserSettingInterface $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $user = $this->user->index();
        return view('user_settings.index', compact('user'));
    }
    public function update(UserRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('images', 'public');
        }
        $this->user->update($data);
        return redirect()->route('userSetting')->with('success',  __('Data updated successfully.'));
    }

    public function changePassword_index()
    {
        return view('user_settings.changePassword');
    }
    public function changePassword_update(Request $request)
    {
        $this->user->changePassword_update($request);
        return redirect()->route('userChangePassword')->with('success',  __('password updated successfully.'));
    }
    public function logLogin()
    {
        $logs = LogLogin::where('user_id',auth()->user()->id)->get();
        return view('user_settings.logLogin', compact('logs'));
    }
    public function changeLanguage($language_id)
    {
        $language = Language::where('id',$language_id)->first();
        App::setLocale($language->short_name);
        $user =auth()->user();
        $user->update(['language_id'=>$language->id]);
        return back();

    }
}
