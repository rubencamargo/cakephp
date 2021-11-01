<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Comment;
use Authorization\IdentityInterface;

/**
 * Comment policy
 */
class CommentPolicy
{
    /**
     * Check if $user can add Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Comment $comment)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Comment $comment)
    {
        // logged in users can edit their own comments.
        //return ($this->isAuthor($user, $comment) || $this->isAdmin($user));
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Comment $comment)
    {
        // logged in users can delete their own comments.
        //return $this->isAuthor($user, $comment);
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Comment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Comment $comment
     * @return bool
     */
    public function canView(IdentityInterface $user, Comment $comment)
    {
        return $this->isAdmin($user);
    }
    
    public function canIndex(IdentityInterface $user, Comment $comment)
    {
        return $this->isAdmin($user);
    }
    
    protected function isAuthor(IdentityInterface $user, Comment $comment)
    {
        return $comment->user_id === $user->getIdentifier();
    }
    
    protected function isAdmin(IdentityInterface $user)
    {
        return $user->role_id === 1;
    }
}
