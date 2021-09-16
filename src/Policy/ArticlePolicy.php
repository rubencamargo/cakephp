<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Article;
use Authorization\IdentityInterface;

/**
 * Article policy
 */
class ArticlePolicy
{
    public function canBlog(IdentityInterface $user, Article $article)
    {
        return true; // All logged in users can create articles.
    }
    
    /**
     * Check if $user can add Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Article $article)
    {
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can edit Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Article $article)
    {
        // logged in users can edit their own articles.
        //return ($this->isAuthor($user, $article) || $this->isAdmin($user));
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can delete Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Article $article)
    {
        // logged in users can delete their own articles.
        //return $this->isAuthor($user, $article);
        return $this->isAdmin($user);
    }

    /**
     * Check if $user can view Article
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Article $article
     * @return bool
     */
    public function canView(IdentityInterface $user, Article $article)
    {
        return $this->isAdmin($user);
    }
    
    public function canIndex(IdentityInterface $user, Article $article)
    {
        return $this->isAdmin($user);
    }
    
    protected function isAuthor(IdentityInterface $user, Article $article)
    {
        return $article->user_id === $user->getIdentifier();
    }
    
    protected function isAdmin(IdentityInterface $user)
    {
        return $user->role_id === 1;
    }
}
