<?php

namespace App\Policies;

use Modules\BlockManager\Block;
use Modules\CommunityManager\Community;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommunityPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any modules block manager blocks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return !!$user;;
    }

    /**
     * Determine whether the user can view the modules block manager block.
     *
     * @param  \App\User  $user
     * @param  \App\ModulesBlockManagerBlock  $modulesBlockManagerBlock
     * @return mixed
     */
    public function view(User $user)
    {
        return !!$user;;
    }

    /**
     * Determine whether the user can create modules block manager blocks.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Community $community)
    {
        return !!$user;
    }

    /**
     * Determine whether the user can update the modules block manager block.
     *
     * @param  \App\User  $user
     * @param  \App\ModulesBlockManagerBlock  $modulesBlockManagerBlock
     * @return mixed
     */
    public function update(User $user, Community $community)
    {
        return $community->owner($user) || $community->admin($user);
    }

    /**
     * Determine whether the user can delete the modules block manager block.
     *
     * @param  \App\User  $user
     * @param  \App\ModulesBlockManagerBlock  $modulesBlockManagerBlock
     * @return mixed
     */
    public function delete(User $user,Community $community)
    {
        return $community->owner($user);
    }

    public function getLocationOptions(User $user,Community $community)
    {
        return $community->owner($user);
    }
    /**
     * Determine whether the user can restore the modules block manager block.
     *
     * @param  \App\User  $user
     * @param  \App\ModulesBlockManagerBlock  $modulesBlockManagerBlock
     * @return mixed
     */
    public function restore(User $user, Community $community)
    {
        return $community->owner($user) || $community->admin($user);
    }

    /**
     * Determine whether the user can permanently delete the modules block manager block.
     *
     * @param  \App\User  $user
     * @param  \App\ModulesBlockManagerBlock  $modulesBlockManagerBlock
     * @return mixed
     */
    public function forceDelete(User $user, Community $community)
    {
        return $community->owner($user);
    }
}
