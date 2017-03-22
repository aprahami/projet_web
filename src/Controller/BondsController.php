<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Bonds Controller
 *
 * @property \App\Model\Table\BondsTable $Bonds
 */
class BondsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Members', 'Member2s']
        ];
        $bonds = $this->paginate($this->Bonds);

        $this->set(compact('bonds'));
        $this->set('_serialize', ['bonds']);
    }

    /**
     * View method
     *
     * @param string|null $id Bond id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $bond = $this->Bonds->get($id, [
            'contain' => ['Members', 'Member2s']
        ]);

        $this->set('bond', $bond);
        $this->set('_serialize', ['bond']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $bond = $this->Bonds->newEntity();
        if ($this->request->is('post')) {
            $bond = $this->Bonds->patchEntity($bond, $this->request->data);
            if ($this->Bonds->save($bond)) {
                $this->Flash->success(__('The bond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bond could not be saved. Please, try again.'));
        }
        $members = $this->Bonds->Members->find('list', ['limit' => 200]);
        $member2s = $this->Bonds->Member2s->find('list', ['limit' => 200]);
        $this->set(compact('bond', 'members', 'member2s'));
        $this->set('_serialize', ['bond']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Bond id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $bond = $this->Bonds->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $bond = $this->Bonds->patchEntity($bond, $this->request->data);
            if ($this->Bonds->save($bond)) {
                $this->Flash->success(__('The bond has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The bond could not be saved. Please, try again.'));
        }
        $members = $this->Bonds->Members->find('list', ['limit' => 200]);
        $member2s = $this->Bonds->Member2s->find('list', ['limit' => 200]);
        $this->set(compact('bond', 'members', 'member2s'));
        $this->set('_serialize', ['bond']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Bond id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $bond = $this->Bonds->get($id);
        if ($this->Bonds->delete($bond)) {
            $this->Flash->success(__('The bond has been deleted.'));
        } else {
            $this->Flash->error(__('The bond could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
