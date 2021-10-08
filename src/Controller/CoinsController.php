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

        $coinsSync = new \App\Utility\CoinSync();

        if($coinsSync->doSync()) {
            $this->Flash->success( 'Sync is done!' );
            $this->redirect( [ 'action' => 'index' ] );
        } else {
            $this->Flash->error( 'Coin API seems to be down!' );
            $this->redirect( [ 'action' => 'index' ] );
        }

    }

}
