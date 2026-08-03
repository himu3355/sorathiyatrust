<?php

namespace App\Policies;

use App\Models\CommunityMember;
use App\Models\User;

class CommunityMemberPolicy
{
    public function viewAny(User $user): bool
    {
        return $user !== null;
    }

    public function view(User $user, CommunityMember $communityMember): bool
    {
        return $user !== null;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, CommunityMember $communityMember): bool
    {
        return $user !== null;
    }

    public function delete(User $user, CommunityMember $communityMember): bool
    {
        return $user !== null;
    }

    public function restore(User $user, CommunityMember $communityMember): bool
    {
        return $user !== null;
    }

    public function forceDelete(User $user, CommunityMember $communityMember): bool
    {
        return $user !== null;
    }
}
