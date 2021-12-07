<?php
namespace App\Model\Behavior;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Behavior;
use Cake\ORM\Entity;
use Cake\ORM\Query;
use Cake\Utility\Text;

class SluggableBehavior extends Behavior
{
	protected $_defaultConfig = [
        'field' => 'title',
        'slug' => 'slug',
        'replacement' => '-',
    ];

    public function slug(EntityInterface $entity)
    {
        $config = $this->getConfig();
        $value = $entity->get($config['field']);
        $entity->set($config['slug'], strtolower(Text::slug($value, $config['replacement'])));
    }

    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options)
    {
        $this->slug($entity);
    }
}