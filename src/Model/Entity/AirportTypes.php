<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AirportSizes Entity.
 */
class AirportTypes extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array
     */
    protected $_accessible = [
        'id' => true,
        'name' => true,
    ];

}