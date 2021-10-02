<?php
declare( strict_types = 1 );

namespace App\Model\Table;

use App\Model\Entity\Coin;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ResultSetInterface;
use Cake\ORM\Behavior\TimestampBehavior;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Coins Model
 *
 * @method Coin newEmptyEntity()
 * @method Coin newEntity( array $data, array $options = [] )
 * @method Coin[] newEntities( array $data, array $options = [] )
 * @method Coin get( $primaryKey, $options = [] )
 * @method Coin findOrCreate( $search, ?callable $callback = null, $options = [] )
 * @method Coin patchEntity( EntityInterface $entity, array $data, array $options = [] )
 * @method Coin[] patchEntities( iterable $entities, array $data, array $options = [] )
 * @method Coin|false save( EntityInterface $entity, $options = [] )
 * @method Coin saveOrFail( EntityInterface $entity, $options = [] )
 * @method Coin[]|ResultSetInterface|false saveMany( iterable $entities, $options = [] )
 * @method Coin[]|ResultSetInterface saveManyOrFail( iterable $entities, $options = [] )
 * @method Coin[]|ResultSetInterface|false deleteMany( iterable $entities, $options = [] )
 * @method Coin[]|ResultSetInterface deleteManyOrFail( iterable $entities, $options = [] )
 *
 * @mixin TimestampBehavior
 */
class CoinsTable extends Table {
    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize( array $config ): void {
        parent::initialize( $config );

        $this->setTable( 'coins' );
        $this->setDisplayField( 'name' );
        $this->setPrimaryKey( 'id' );

        $this->addBehavior( 'Timestamp' );
    }

    /**
     * Default validation rules.
     *
     * @param Validator $validator Validator instance.
     * @return Validator
     */
    public function validationDefault( Validator $validator ): Validator {
        $validator->integer( 'id' )
            ->allowEmptyString( 'id', null, 'create' );

        $validator->scalar( 'ext_ident' )
            ->maxLength( 'ext_ident', 255 )
            ->requirePresence( 'ext_ident', 'create' )
            ->notEmptyString( 'ext_ident' );

        $validator->scalar( 'name' )
            ->maxLength( 'name', 255 )
            ->requirePresence( 'name', 'create' )
            ->notEmptyString( 'name' );

        $validator->scalar( 'symbol' )
            ->maxLength( 'symbol', 255 )
            ->requirePresence( 'symbol', 'create' )
            ->notEmptyString( 'symbol' );

        $validator->nonNegativeInteger( 'rank' )
            ->requirePresence( 'rank', 'create' )
            ->notEmptyString( 'rank' );

        $validator->numeric( 'price' )
            ->requirePresence( 'price', 'create' )
            ->notEmptyString( 'price' );

        $validator->numeric( 'volume' )
            ->requirePresence( 'volume', 'create' )
            ->notEmptyString( 'volume' );

        $validator->requirePresence( 'marketCap', 'create' )
            ->notEmptyString( 'marketCap' );

        $validator->requirePresence( 'availableSupply', 'create' )
            ->notEmptyString( 'availableSupply' );

        $validator->requirePresence( 'totalSupply', 'create' )
            ->notEmptyString( 'totalSupply' );

        $validator->numeric( 'priceChange1h' )
            ->requirePresence( 'priceChange1h', 'create' )
            ->notEmptyString( 'priceChange1h' );

        $validator->numeric( 'priceChange1d' )
            ->requirePresence( 'priceChange1d', 'create' )
            ->notEmptyString( 'priceChange1d' );

        $validator->numeric( 'priceChange1w' )
            ->requirePresence( 'priceChange1w', 'create' )
            ->notEmptyString( 'priceChange1w' );

        $validator->scalar( 'websiteUrl' )
            ->maxLength( 'websiteUrl', 255 )
            ->requirePresence( 'websiteUrl', 'create' )
            ->notEmptyString( 'websiteUrl' );

        return $validator;
    }
}
