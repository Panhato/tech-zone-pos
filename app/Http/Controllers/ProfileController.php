<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * បង្ហាញទំព័រ Profile របស់ User
     */
    public function index()
    {
        // បញ្ជូនទិន្នន័យ User ដែលបាន Login ទៅកាន់ View
        return view('profile.index', [
            'user' => Auth::user()
        ]);
    }

    /**
     * កែសម្រួលព័ត៌មាន Profile និងរូបភាព Avatar
     */
    public function update(Request $request)
    {
        // ១. ទាញយក User បច្ចុប្បន្ន
        $user = Auth::user();
        
        // ២. ត្រួតពិនិត្យទិន្នន័យ (Validation)
        $request->validate([
            'name'   => 'required|string|max:255',
            'phone'  => 'nullable|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // ៣. បច្ចុប្បន្នភាពព័ត៌មានអក្សរ
        $user->name = $request->name;
        $user->phone = $request->phone;

        // ៤. ចាត់ចែងការ Upload រូបភាព (បើមាន)
        if ($request->hasFile('avatar')) {
            
            // បង្កើតឈ្មោះ File ថ្មីដើម្បីការពារការជាន់គ្នា
            $fileName = 'avatar_' . $user->id . '_' . time() . '.' . $request->avatar->extension();
            
            // រក្សាទុកក្នុង storage/app/public/avatars តាមរយៈ disk 'public'
            $path = $request->avatar->storeAs('avatars', $fileName, 'public');

            if ($path) {
                // លុបរូបភាពចាស់ចេញពី Storage ដើម្បីសន្សំទំហំ Disk
                if ($user->avatar) {
                    Storage::disk('public')->delete('avatars/' . $user->avatar);
                }
                
                // រក្សាទុកឈ្មោះ File ថ្មីក្នុង Database
                $user->avatar = $fileName;
            }
        }

        // ៥. រក្សាទុកការផ្លាស់ប្តូរចូល Database
        $user->save();

        // ត្រឡប់ទៅវិញជាមួយ Message ជោគជ័យ
        return back()->with('success', 'ព័ត៌មានត្រូវបានកែសម្រួលជោគជ័យ!');
    }
}