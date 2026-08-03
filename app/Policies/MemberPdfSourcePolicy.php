<?php

namespace App\Policies;

use App\Models\MemberPdfSource;
use App\Models\User;

class MemberPdfSourcePolicy
{
    public function viewAny(User $user): bool
    {
        return $user !== null;
    }

    public function view(User $user, MemberPdfSource $memberPdfSource): bool
    {
        return $user !== null;
    }

    public function create(User $user): bool
    {
        return $user !== null;
    }

    public function update(User $user, MemberPdfSource $memberPdfSource): bool
    {
        return $user !== null;
    }

    public function delete(User $user, MemberPdfSource $memberPdfSource): bool
    {
        return $user !== null;
    }

    public function restore(User $user, MemberPdfSource $memberPdfSource): bool
    {
        return $user !== null;
    }

    public function forceDelete(User $user, MemberPdfSource $memberPdfSource): bool
    {
        return $user !== null;
    }
}
