<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {debug('User');die($user);
        return true;
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {debug('User');die($user);
        return ($this->isAdmin($user) || $this->isProfile($user, $resource));
    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        return ($this->isAdmin($user) || $this->isProfile($user, $resource));
    }
    
    public function canIndex(IdentityInterface $user, User $resource)
    {
        return $this->isAdmin($user);
    }
    
    protected function isAdmin(IdentityInterface $user)
    {
        return $user->role_id === 1;
    }
    
    protected function isProfile(IdentityInterface $user, User $resource)
    {
        return $user->id === $resource->id;
    }
}
