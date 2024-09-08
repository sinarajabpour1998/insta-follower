<?php
namespace Modules\Core\database\seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Modules\Core\Models\Token;

class CoreUserSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()->count(5)->create();

        foreach ($users as $user) {
            $token_md5 = md5($user->id . now() . random_int(0, 10000));
            $token_crypt = Hash::make($token_md5);
            Token::query()->create([
                'user_id' => $user->id,
                'token' => $token_crypt,
                'status' => 'enable',
                'expires_at' => Carbon::now()->addDays(2)
            ]);

        }
    }

}
