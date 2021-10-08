<?php
declare(strict_types=1);

namespace App\Utility;

use App\Model\Table\CoinsTable;
use Cake\Datasource\ModelAwareTrait;

class CoinSync {
    use ModelAwareTrait;

    public CoinsTable $Coins;

    public function doSync() {

        $this->loadModel('Coins');

        $return      = [];
        $url         = "https://api.coinstats.app/public/v1/coins?skip=0&limit=5&currency=EUR";
        $json_string = file_get_contents( $url );
        if( $json_string ) :

            $json        = json_decode( $json_string );
            $touched_ids = [];

            if( !empty( $json ) ) {
                foreach( $json->coins as $entry ) {

                    $data = [
                        'name'            => $entry->name,
                        'ext_ident'       => $entry->id,
                        'symbol'          => $entry->symbol,
                        'rank'            => $entry->rank,
                        'price'           => $entry->price,
                        'volume'          => $entry->volume,
                        'marketCap'       => $entry->marketCap,
                        'availableSupply' => $entry->availableSupply,
                        'totalSupply'     => $entry->totalSupply,
                        'priceChange1h'   => $entry->priceChange1h,
                        'priceChange1d'   => $entry->priceChange1d,
                        'priceChange1w'   => $entry->priceChange1w,
                        'websiteUrl'      => $entry->websiteUrl
                    ];

                    $entity = false;

                    $result = $this->Coins->find()
                        ->where( [ 'ext_ident' => $entry->id ] )
                        ->toArray();

                    // Update or create depending if the entity is already in DB
                    if( sizeof( $result ) == 1 ) {
                        $entity = $result[0];
                    } elseif( sizeof( $result ) == 0 ) {
                        $entity = $this->Coins->newEmptyEntity();
                    }
                    $entity = $this->Coins->patchEntity( $entity, $data );

                    if( $this->Coins->save( $entity ) ) {
                        $return['success'][] = $entity->id;
                    } else {
                        $return['error'][] = [
                            'id'    => $entity->id,
                            'error' => $entity->getErrors()
                        ];
                    }

                    $touched_ids[] = $entry->id;

                }
            }

            if( !empty( $touched_ids ) ):
                $db_entries = $this->Coins->find( 'list', [
                    'valueField' => 'ext_ident'
                ] )
                    ->toArray();
                $diff       = array_diff( $db_entries, $touched_ids );
                if( !empty( $diff ) ):
                    $this->Coins->deleteAll( [ 'ext_ident IN' => $diff ] );
                endif;
            endif;

            return true;

        else:

            return false;

        endif;

    }

}
