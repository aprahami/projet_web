<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Earnings Controller
 *
 * @property \App\Model\Table\EarningsTable $Earnings
 */
class EarningsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Stickers']
        ];
        $earnings = $this->paginate($this->Earnings);

        $this->set(compact('earnings'));
        $this->set('_serialize', ['earnings']);
    }

    /**
     * View method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $earning = $this->Earnings->get($id, [
            'contain' => ['Members', 'Stickers']
        ]);

        $this->set('earning', $earning);
        $this->set('_serialize', ['earning']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $earning = $this->Earnings->newEntity();
        if ($this->request->is('post')) {
            $earning = $this->Earnings->patchEntity($earning, $this->request->data);
            if ($this->Earnings->save($earning)) {
                $this->Flash->success(__('The earning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earning could not be saved. Please, try again.'));
        }
        $members = $this->Earnings->Members->find('list', ['limit' => 200]);
        $stickers = $this->Earnings->Stickers->find('list', ['limit' => 200]);
        $this->set(compact('earning', 'members', 'stickers'));
        $this->set('_serialize', ['earning']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $earning = $this->Earnings->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $earning = $this->Earnings->patchEntity($earning, $this->request->data);
            if ($this->Earnings->save($earning)) {
                $this->Flash->success(__('The earning has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The earning could not be saved. Please, try again.'));
        }
        $members = $this->Earnings->Members->find('list', ['limit' => 200]);
        $stickers = $this->Earnings->Stickers->find('list', ['limit' => 200]);
        $this->set(compact('earning', 'members', 'stickers'));
        $this->set('_serialize', ['earning']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Earning id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $earning = $this->Earnings->get($id);
        if ($this->Earnings->delete($earning)) {
            $this->Flash->success(__('The earning has been deleted.'));
        } else {
            $this->Flash->error(__('The earning could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
