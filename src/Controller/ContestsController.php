<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Contests Controller
 *
 * @property \App\Model\Table\ContestsTable $Contests
 */
class ContestsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Network\Response|null
     */
    public function index()
    {
        $contests = $this->paginate($this->Contests);

        $this->set(compact('contests'));
        $this->set('_serialize', ['contests']);
    }

    /**
     * View method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Network\Response|null
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $contest = $this->Contests->get($id, [
            'contain' => ['Workouts']
        ]);

        $this->set('contest', $contest);
        $this->set('_serialize', ['contest']);
    }

    /**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $contest = $this->Contests->newEntity();
        if ($this->request->is('post')) {
            $contest = $this->Contests->patchEntity($contest, $this->request->data);
            if ($this->Contests->save($contest)) {
                $this->Flash->success(__('The contest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contest could not be saved. Please, try again.'));
        }
        $this->set(compact('contest'));
        $this->set('_serialize', ['contest']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $contest = $this->Contests->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contest = $this->Contests->patchEntity($contest, $this->request->data);
            if ($this->Contests->save($contest)) {
                $this->Flash->success(__('The contest has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The contest could not be saved. Please, try again.'));
        }
        $this->set(compact('contest'));
        $this->set('_serialize', ['contest']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Contest id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contest = $this->Contests->get($id);
        if ($this->Contests->delete($contest)) {
            $this->Flash->success(__('The contest has been deleted.'));
        } else {
            $this->Flash->error(__('The contest could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
