<?php

namespace App\Http\Controllers;

use App\groups;
use App\Http\Requests\StoreMemberRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateMemberRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Log;
use App\Mail\newMemberEmail;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except(['create','store','activateMember']);
    }

    public function create(){
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        return view('users.create',compact('countries'));
    }

    public function store(StoreUserRequest $request){
        $path = Storage::disk('public')->put('users', $request->file('image'));
        User::create([
            'name' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'password' => bcrypt($request->password),
            'birthDate' => $request->birthDate,
            'image' => $path,
            'group_id' => null,
            'type' => 'USER',
            'active' => 1
        ]);

        return redirect()->route('login')->with(['message' => 'Your Account successfully created!']);
    }

    public function index(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $users = User::withTrashed()->where('type','USER')->get();
        return view('users.all',compact('users'));
    }

    public function show(User $user){
        if (Auth::user() != $user){
            return redirect()->back();
        }
        return view('users.index',compact('user'));
    }

    public function edit(User $user){
        if (Auth::user()->type != 'USER' || Auth::user() != $user){
            return redirect()->back();
        }
        $countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia and Herzegowina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, the Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia (Hrvatska)", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "East Timor", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "France Metropolitan", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard and Mc Donald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Israel", "Italy", "Jamaica", "Japan", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao, People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macau", "Macedonia, The Former Yugoslav Republic of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia, Federated States of", "Moldova, Republic of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Kitts and Nevis", "Saint Lucia", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Seychelles", "Sierra Leone", "Singapore", "Slovakia (Slovak Republic)", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "Spain", "Sri Lanka", "St. Helena", "St. Pierre and Miquelon", "Sudan", "Suriname", "Svalbard and Jan Mayen Islands", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan, Province of China", "Tajikistan", "Tanzania, United Republic of", "Thailand", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (U.S.)", "Wallis and Futuna Islands", "Western Sahara", "Yemen", "Yugoslavia", "Zambia", "Zimbabwe");
        return view('users.update',compact(['user', 'countries']));
    }

    public function update(UpdateUserRequest $request,User $user){
        if (Auth::user()->type != 'USER' || Auth::user() != $user){
            return redirect()->back();
        }
        $path = $user->image;
        // check if request has file
        if($request->hasFile('image')){
            // check if file exists
            $exists = Storage::disk('public')->exists($user->image);
            if ($exists){
                // delete old image
                Storage::disk('public')->delete($user->image);
                // move new image
                $path = Storage::disk('public')->put('users', $request->file('image'));
            }
        }

        $password = $user->password;
        if ($request->password != null){
            $password = bcrypt($request->password);
        }
        $user->update([
            'name' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'password' => $password,
            'birthDate' => $request->birthDate,
            'image' => $path
        ]);
        return redirect()->back()->with(['message' => 'Your Account successfully updated!']);
    }

    //    user suspend
    public function suspend(User $user){
        if (Auth::user()->type != 'USER' || Auth::user() != $user){
            return redirect()->back();
        }
        $user->update([
            'active' => 0
        ]);
        Auth::logout();
        return redirect()->route('login')->with(['message' => 'Your Account successfully Suspended!']);
    }

    //    user delete
    public function destroy(User $user){
        if (Auth::user()->type != 'USER' || Auth::user() != $user){
            return redirect()->back();
        }
        User::destroy($user->id);
        Auth::logout();
        return redirect()->route('login')->with(['message' => 'Your Account Deleted successfully!']);
    }

    public function admin_suspend($id){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $user = User::withTrashed()->find($id);
        if ($user->active == true){
            $user->update([
                'active' => 0
            ]);
            return redirect()->back()->with(['message' => 'Account successfully Suspended!']);
        }else{
            $user->update([
                'active' => 1
            ]);
            return redirect()->back()->with(['message' => 'Account suspension was successfully canceled!']);
        }
    }

    public function restore($id){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $user = User::withTrashed()->find($id);
        $user->restore();
        return redirect()->back()->with(['message' => 'Account successfully Restored!']);
    }

    public function forceDelete($id){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $user = User::withTrashed()->find($id);
        if ($user){
            // check if file exists
            $exists = Storage::disk('public')->exists($user->image);
            if ($exists){
                // delete old image
                Storage::disk('public')->delete($user->image);
            }
            $user->forceDelete();
            return redirect()->back()->with(['message' => 'Account successfully Deleted!']);
        }
    }

    public function create_member(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $groups = groups::all();
        return view('members.create',compact('groups'));
    }

    public function store_member(StoreMemberRequest $request){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $token =  bin2hex(openssl_random_pseudo_bytes(32));
        $password =  bin2hex(openssl_random_pseudo_bytes(15));
        $path =null;
        // check if request has file
        if($request->hasFile('image')){
            $path = Storage::disk('public')->put('members', $request->file('image'));
        }
        $user = User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($password),
            'token' => $token,
            'image' => $path,
            'group_id' => $request->group,
            'type' => 'MEMBER',
            'active' => 0
        ]);
        Mail::to($user)->send(new newMemberEmail($user,$password));

        return redirect()->route('members')->with(['message' => 'Member account successfully created!']);
    }

    public function allMembers(){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $users = User::where('type','MEMBER')->get();
        return view('members.all',compact('users'));
    }

    public function delete_member(User $user){
        if (Auth::user()->type != 'ADMIN'){
            return redirect()->back();
        }
        $user->logs()->delete();
        $user->delete();
        return redirect()->back()->with(['message' => 'Member account successfully deleted!']);
    }

    public function activateMember($token){
        $user = User::where(['token' => $token, 'active' => 0])->first();
        if ($user){
            $user->update([
                'token' => null,
                'email_verified_at' => \Carbon\Carbon::now(),
                'active' => true
            ]);
            return redirect()->route('login')->with(['message' => 'Your account activated successfully!']);
        }else{
            return redirect()->route('login')->with(['message_err' => 'Invalid link or your account activated!']);
        }
    }

    public function show_member(User $user){
        if (Auth::user()->type != 'MEMBER' || Auth::user() != $user){
            return redirect()->back();
        }
        return view('members.index',compact('user'));
    }

    public function edit_member(User $user){
        if (Auth::user()->type != 'MEMBER' || Auth::user() != $user){
            return redirect()->back();
        }
        return view('members.update',compact(['user']));
    }

    public function update_member(UpdateMemberRequest $request,User $user){
        if (Auth::user()->type != 'MEMBER' || Auth::user() != $user){
            return redirect()->back();
        }
        $path = $user->image;
        // check if request has file
        if($request->hasFile('image')){
            // check if file exists
            $exists = Storage::disk('public')->exists($user->image);
            if ($exists){
                // delete old image
                Storage::disk('public')->delete($user->image);
                // move new image
                $path = Storage::disk('public')->put('members', $request->file('image'));
            }
        }

        $password = $user->password;
        if ($request->password != null){
            $password = bcrypt($request->password);
        }
        if ($user->name != $request->name || $user->phone != $request->phone){
            Log::create([
                'name' => $user->name,
                'phone' => $user->phone,
                'user_id' => $user->id
            ]);
        }
        $user->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => $password,
            'image' => $path
        ]);
        return redirect()->back()->with(['message' => 'Your Account successfully updated!']);
    }

    public function logs_member(){
        if (Auth::user()->type != 'MEMBER'){
            return redirect()->back();
        }
        $logs = Auth::user()->logs;
        return view('members.logs',compact('logs'));
    }

    public function update_old_log(Log $log){
        if (Auth::user()->type != 'MEMBER' || Auth::user()->id != $log->user_id){
            return redirect()->back();
        }
        $user = Auth::user();
        $user->update([
            'name' => $log->name,
            'phone' => $log->phone
        ]);
        return redirect()->back()->with(['message' => 'Your Account successfully updated to old log!']);
    }

    public function delete_old_log(Log $log){
        if (Auth::user()->type != 'MEMBER' || Auth::user()->id != $log->user_id){
            return redirect()->back();
        }
        $log->delete();
        return redirect()->back()->with(['message' => 'Your log successfully deleted!']);
    }
}
