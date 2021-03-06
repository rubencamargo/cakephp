<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Article Entity
 *
 * @property int $id
 * @property int $user_id
 * @property string $title
 * @property string|null $slug
 * @property string|null $body
 * @property string|null $image_name
 * @property string|null $image_type
 * @property string|null $image_size
 * @property bool|null $published
 * @property \Cake\I18n\FrozenTime|null $created
 * @property \Cake\I18n\FrozenTime|null $modified
 *
 * @property \App\Model\Entity\User $user
 * @property \App\Model\Entity\Comment[] $comments
 * @property \App\Model\Entity\Tag[] $tags
 */
class Article extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'user_id' => true,
        'type_id' => true,
        'title' => true,
        'slug' => true,
        'body' => true,
        'image_name' => true,
        'image_type' => true,
        'image_size' => true,
        'published' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'comments' => true,
        'tags' => true
    ];
}
