<?php


namespace App\Services;


use App\Models\GraphedUser;
use App\Models\Interaction;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GraphService
{
    /** Insert user into graphDB when registered
     * @param User $user
     */
    public function insertUser(User $user)
    {
        GraphedUser::create(['_id' => $user->id, 'name' => $user->name, 'email' => $user->email]);
    }

    public function returnRecommendationList()
    {
        $currUser = GraphedUser::where(['email' => Auth::user()->email])->first();
        $interactions = $currUser->didInteract()->get();
        $users = collect();
        foreach($interactions as $interaction){
            foreach ($interaction->objects()->get()->whereNotIn('_id',[Auth::user()->id]) as $user){
                $users->push(collect([User::find($user->_id), $interaction->weight]));
            }
        }
        $points = $users->mapToGroups(function ($item, $key){
            return [$item->get(0)->email => $item->get(1)];
        });

        $sortedUsers = $users->map(function ($item) use ($points) {
            if($points->get($item->get(0)->email) !== null){
                $item->put(1, $points->get($item->get(0)->email)->sum());
                return $item;
            }
        })->sort(function ($item1, $item2){
            if($item1->get(1) == $item2->get(1)){
                return 0;
            }
            return $item1->get(1) > $item2->get(1) ? -1 : 1;
        });
        return $sortedUsers->unique(function($item){
            return $item->get(0)->email;
        })->all();
    }
}
