<?php


namespace App\Traits;


use App\Models\GraphedUser;
use App\Models\Interaction;
use App\Models\User;
use App\Services\GraphService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;


/**
 * Trait IsInteraction
 * Stores procedures that all interactions shares for graphDB connection
 * @package App\Traits
 */
trait IsInteraction
{
    //interaction weight, for calculating scores
    public $weight = 1;

    /** logs user interaction and saves the model
     * @param $users
     * @return bool
     */
    public function logInteractionAndSave($users)
    {
        $this->logInteraction($users);
        return $this->save();
    }

    /** Logs user interactions into graphDB
     * @param $users
     */
    public function logInteraction($users)
    {
        foreach ($users as $user) {
            $userDoneTo = GraphedUser::firstOrCreate(['email' => $user->email], ['name' => $user->name]);
            $userDid = GraphedUser::firstOrCreate(['email' => Auth::user()->email], ['name' => Auth::user()->name]);
            $interaction = $userDid->didInteract->where('type', $this->getClassName())
                ->whenEmpty( function () use ($userDid)
                {
                    $interaction = $this->createNewInteraction();
                    $userDid->didInteract()->save($interaction);
                    return $interaction;
                }
                )->first();
            $userDoneTo->wasInteractedTo()->attach($interaction);
        }
    }

    /** creates new interaction node
     * @return mixed
     */
    private function createNewInteraction()
    {
        return Interaction::create(['type' => $this->getClassName(), 'weight' => $this->weight]);
    }

    /**returns class name
     * @return mixed|string|null
     */
    private function getClassName()
    {
        $classArrayRoute = explode('\\', get_class($this));
        return array_pop($classArrayRoute);
    }
}
