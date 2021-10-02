<?php
declare( strict_types = 1 );

namespace App\Controller;

use App\Model\Entity\Coin;
use App\Model\Table\CoinsTable;
use Cake\Datasource\Exception\RecordNotFoundException;
use Cake\Datasource\ResultSetInterface;
use Cake\Http\Response;

/**
 * Coins Controller
 *
 * @property CoinsTable $Coins
 * @method Coin[]|ResultSetInterface paginate( $object = null, array $settings = [] )
 */
class CoinsController extends AppController {
    /**
     * Index method
     *
     * @return Response|null|void Renders view
     */
    public function index() {
        $coins = $this->paginate( $this->Coins );

        $this->set( compact( 'coins' ) );
    }

    /**
     * View method
     *
     * @param string|null $id Coin id.
     * @return Response|null|void Renders view
     * @throws RecordNotFoundException When record not found.
     */
    public function view( $id = null ) {
        $coin = $this->Coins->get( $id, [
            'contain' => [],
        ] );

        $this->set( compact( 'coin' ) );
    }

    /**
     * Add method
     *
     * @return Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add() {
        $coin = $this->Coins->newEmptyEntity();
        if( $this->request->is( 'post' ) ) {
            $coin = $this->Coins->patchEntity( $coin, $this->request->getData() );
            if( $this->Coins->save( $coin ) ) {
                $this->Flash->success( __( 'The coin has been saved.' ) );

                return $this->redirect( [ 'action' => 'index' ] );
            }
            $this->Flash->error( __( 'The coin could not be saved. Please, try again.' ) );
        }
        $this->set( compact( 'coin' ) );
    }

    /**
     * Edit method
     *
     * @param string|null $id Coin id.
     * @return Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws RecordNotFoundException When record not found.
     */
    public function edit( $id = null ) {
        $coin = $this->Coins->get( $id, [
            'contain' => [],
        ] );
        if( $this->request->is( [ 'patch', 'post', 'put' ] ) ) {
            $coin = $this->Coins->patchEntity( $coin, $this->request->getData() );
            if( $this->Coins->save( $coin ) ) {
                $this->Flash->success( __( 'The coin has been saved.' ) );

                return $this->redirect( [ 'action' => 'index' ] );
            }
            $this->Flash->error( __( 'The coin could not be saved. Please, try again.' ) );
        }
        $this->set( compact( 'coin' ) );
    }

    /**
     * Delete method
     *
     * @param string|null $id Coin id.
     * @return Response|null|void Redirects to index.
     * @throws RecordNotFoundException When record not found.
     */
    public function delete( $id = null ) {
        $this->request->allowMethod( [ 'post', 'delete' ] );
        $coin = $this->Coins->get( $id );
        if( $this->Coins->delete( $coin ) ) {
            $this->Flash->success( __( 'The coin has been deleted.' ) );
        } else {
            $this->Flash->error( __( 'The coin could not be deleted. Please, try again.' ) );
        }

        return $this->redirect( [ 'action' => 'index' ] );
    }

    // ========== SYNC ==========

    public function sync() {

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

            $this->Flash->success( 'Sync is done!' );
            $this->redirect( [ 'action' => 'index' ] );

        else:

            $this->Flash->error( 'Coin API seems to be down!' );
            $this->redirect( [ 'action' => 'index' ] );

        endif;

    }

}
