<?php
declare( strict_types = 1 );

namespace App\Model\Entity;

use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Coin Entity
 *
 * @property int $id
 * @property string $ext_ident
 * @property string $name
 * @property string $symbol
 * @property int $rank
 * @property float $price
 * @property float $volume
 * @property int $marketCap
 * @property int $availableSupply
 * @property int $totalSupply
 * @property float $priceChange1h
 * @property float $priceChange1d
 * @property float $priceChange1w
 * @property string $websiteUrl
 * @property FrozenTime|null $created
 * @property FrozenTime|null $modified
 */
class Coin extends Entity {
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
        'ext_ident'       => true,
        'name'            => true,
        'symbol'          => true,
        'rank'            => true,
        'price'           => true,
        'volume'          => true,
        'marketCap'       => true,
        'availableSupply' => true,
        'totalSupply'     => true,
        'priceChange1h'   => true,
        'priceChange1d'   => true,
        'priceChange1w'   => true,
        'websiteUrl'      => true,
        'created'         => true,
        'modified'        => true,
    ];
}
