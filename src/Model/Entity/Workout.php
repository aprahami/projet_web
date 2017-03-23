<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Workout Entity
 *
 * @property int $id
 * @property string $member_id
 * @property \Cake\I18n\Time $date
 * @property \Cake\I18n\Time $end_date
 * @property string $location_name
 * @property string $description
 * @property string $sport
 * @property int $contest_id
 *
 * @property \App\Model\Entity\Member $member
 * @property \App\Model\Entity\Contest $contest
 * @property \App\Model\Entity\Log[] $logs
 */
class Workout extends Entity
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
        '*' => true,
        'id' => false
    ];
}
