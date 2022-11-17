<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Skills;
use App\Models\ProfileSkills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProfilesController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        //Employer can see all profiles
        if(!auth()->user()->is_employer)
        {
            //User can see only own profile
            $this->authorize('view', $user->profile);

            //Gathering user skills in string
            if($user->profile->skills)
            {
                $user_skills = [];

                foreach ($user->profile->skills as $user_skill)
                {
                    $user_skills[] = $user_skill->skills->name;
                }
                $user_skill_str = implode(', ', $user_skills);
                $user['user_skills_str'] = $user_skill_str;
            }
        }

        return view('profiles.index')->with('user', $user);
    }

    public function edit(User $user)
    {
        //Check if user authorised
        $this->authorize('update', $user->profile);

        //Select all skills
        $available_skills = [];
        $skills = Skills::all();
        foreach ($skills as $skill) {
            $available_skills[] = $skill;
        }

        return view('profiles.edit', compact('user', 'available_skills'));
    }

    public function update(User $user)
    {
        //Check if user allowed to update profile
        $this->authorize('update', $user->profile);

        if(auth()->user()->is_employer)
        {
            //validate data
            $data = request()->validate([
                'phone' => 'required|string|min:11|max:255',
                'company_name' => 'required|string|min:2|max:255',
            ]);

            $data['show_phone'] = request('show_phone') ? true : false;
            auth()->user()->profile->update($data);
        }
        else
        {
            //validate data
            $data = request()->validate([
                'phone' => 'required|string|min:11|max:255',
                'cover_letter' => 'required|string|min:100|max:5000',
                'cv' => 'mimes:pdf|max:10000',
                'skills' => ''
            ]);

            if (request('cv')) {
                $imagePath = request('cv')->store('profile', 'public');
                $fileArray = ['cv' => $imagePath];
            }

            $skills = $data['skills'];
            unset($data['skills']);

            auth()->user()->profile->update(array_merge(
                $data,
                $fileArray ?? []
            ));

            //save skills
            if(!empty($skills))
            {
                //Clear existing skills
                auth()->user()->profile->skills()->delete();

                foreach ($skills as $skill_id)
                {
                    auth()->user()->profile->skills()->create([
                        'profile_id' => auth()->user()->profile->id,
                        'skills_id' => $skill_id,
                    ]);
                }
            }
        }

        return redirect("/member/" . $user->id);
    }
}
