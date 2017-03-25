<?php

namespace App\Controller;
use App\Controller\AppController;

class SportController extends AppController
{	

    public function index()
    {
        if ($this->request->is('post')) {
         	$data = $this->request->data;
            $method=$this->request->data['index'];
            $this->loadModel("Members");
            if($method=='connexion')
            {
         	    $this->request->session()->write('uid', 0);         	            
             	$check = $this->Members->checkUser($data['email'], $data['password']);
             	if($check == null){
             		$this->Flash->error('Vos identifiants sont incorrects');
             	}
             	else {
             		$this->request->session()->write('uid', $check);
             		$this->Flash->success('Connexion réussie !!!');
             		$this->redirect(['action' => 'monCompte']);
             	}
            }
            // Envoi e-mail
            else if($method=='mdpoublie') {
                    $infos= $this->Members->userInfo($this->request->session()->read('uid'));
                    $email = new Email();
                    /*$email->from([$this->request->data["sender"] => "Sender"]
                    ->to($data['email'])
                    ->subject("Nouveau mot de passe")
                    ->send("Voici votre nouveau mot de passe : ".$infos['password']);*/
            
            }
        }
    }
    

    public function monCompte() {
    	$uid = $this->request->session()->read('uid');
        if($uid!=null)
        {
            $this->set("uid", $uid);
            $this->loadModel("Members");
            $infos= $this->Members->userInfo($this->request->session()->read('uid'));
            if($infos) $this->set("infos", $infos);
        }
        else
        {
            $this->redirect(['action' => 'index']);
            $this->Flash->error('Veuillez vous connecter');
        } 
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if($data!=null)
            {
                move_uploaded_file($data['photo']['tmp_name'], WWW_ROOT.'img/avatars/'.$infos['id'].'.jpg');
                $this->redirect(['action' => 'monCompte']);
            }
            else $this->Flash->error('Extension non valide');
        }    
        
    }   

    public function inscription() {
    	if ($this->request->is('post')) {
    		$data = $this->request->data;
         	$this->loadModel("Members");
         	$check = $this->Members->checkUserInscription($data['email'], $data['password']);
            if($check == null){
                $this->Flash->error('Erreur e-mail');
            }
         	else {
         		$member = $this->Members->newEntity();
         		$member = $this->Members->patchEntity($member, $data);
            	if ($this->Members->save($member)) {
                	$this->Flash->success(__('Inscription réussie !!!'));
                    $this->request->session()->write('uid', $member['id']);
            	}
           		else {
           			$this->Flash->error(__('Erreur lors de linscription, veuillez recommencer'));
           		}
         		$this->redirect(['action' => 'monCompte']);
         	}
         }
    }
    public function logout()
    {
        $this->Flash->success('You are logged out');
        $this->request->session()->write('uid', null);
        $this->redirect(['action' => 'index']);
    } 
    public function accueil()
    {

    }  
	public function mesobjectsconnectes(){
		$uid = $this->request->session()->read('uid');
		$this->loadModel("Devices");
		$infos=$this->Devices->deviceInfo($this->request->session()->read('uid'));
		$this->set("infos", $infos);
		$totest=null;
		$this->set("test",$totest);
		$this->set("id",$uid);
	}
	/**
     * Add method
     *
     * @return \Cake\Network\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->loadModel("Devices");
        $device = $this->Devices->newEntity();
        if ($this->request->is('post')) {
            $device = $this->Devices->patchEntity($device, $this->request->data);
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $members = $this->Devices->Members->find('list', ['limit' => 200]);
        $this->set(compact('device', 'members'));
        $this->set('_serialize', ['device']);
    }
	/**
     * Edit method
     *
     * @param string|null $id Device id.
     * @return \Cake\Network\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id)
    {
		$this->loadModel("Devices");
        $device = $this->Devices->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $device = $this->Devices->patchEntity($device, $this->request->data);
            if ($this->Devices->save($device)) {
                $this->Flash->success(__('The device has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The device could not be saved. Please, try again.'));
        }
        $members = $this->Devices->Members->find('list', ['limit' => 200]);
        $this->set(compact('device', 'members'));
        $this->set('_serialize', ['device']);
    }
	/**
     * Delete method
     *
     * @param string|null $id Device id.
     * @return \Cake\Network\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id)
    {
		$this->loadModel("Devices");
        $this->request->allowMethod(['post', 'delete']);
        $device = $this->Devices->get($id);
        if ($this->Devices->delete($device)) {
            $this->Flash->success(__('The device has been deleted.'));
        } else {
            $this->Flash->error(__('The device could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
?>