<?php

namespace Database\Seeders\DefaultSeeder;

use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserSeeder extends Seeder {

    public function run(): void {

        loadSeederFromClientOrDef('users', 'var_user_seeder/');
//         self::LoadOldData();
        loadSeederFromClientOrDef('roles', 'var_user_seeder/');
        loadSeederFromClientOrDef('permissions', 'var_user_seeder/');
        loadSeederFromClientOrDef('model_has_permissions', 'var_user_seeder/');
        loadSeederFromClientOrDef('model_has_roles', 'var_user_seeder/');
        loadSeederFromClientOrDef('role_has_permissions', 'var_user_seeder/');
        loadSeederFromClientOrDef('sessions', 'var_user_seeder/');


    }

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
    public function LoadOldData() {
        $oldUsers = DB::connection('secondary_db')->table('tbl_user')->get();

        foreach ($oldUsers as $oldUser) {
            $addUser = new User();
            $addUser->id = $oldUser->user_id;
            $addUser->name = $oldUser->name;
            $addUser->email = $oldUser->email;
            $addUser->password = Hash::make($oldUser->email);
            if ($oldUser->user_id == 1) {
                $addUser->name = "Hany Darwish";
                $addUser->email = "hany.freestyle4u@gmail.com";
                $addUser->password = Hash::make("hany.freestyle4u@gmail.com");
            }
            $addUser->sales = $oldUser->sales;
            $addUser->user_follow = $oldUser->user_follow;
            $addUser->google_code = $oldUser->google_code;
            $addUser->is_active = $oldUser->state;
            $addUser->is_archived = $oldUser->archived_user;
            $addUser->team_leader = $oldUser->team_leader;
            $addUser->save();
        }
    }

    public function UpdateTeamLeader(){
        $users = User::query()
            ->where('team_leader', true)
            ->where('sales', true)
            ->where('is_active', true)
            ->where('is_archived', false)
            ->get();
        foreach ($users as $user) {
            $isSerialized = @unserialize($user->user_follow) !== false || $user->user_follow === 'b:0;';

            if ($isSerialized) {
                $followedIds = unserialize($user->user_follow);

                $activeUserIds = User::query()
                    ->whereIn('id', $followedIds)
                    ->where('is_active', true)
                    ->where('is_archived', false)
                    ->where('sales', true)
                    ->pluck('id')
                    ->toArray();
                $user->user_team = $activeUserIds;
                $user->save();
            }
        }
    }
}
