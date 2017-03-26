<?php

namespace App\Controller;
use App\Controller\AppController;
use Cake\I18n\Time;

class SportController extends AppController
{   
    public function index()
    {
        $uid = $this->request->session()->read('uid');
        if($uid!=0)
        {
            $this->redirect(['action' => 'mon_compte']);
            echo($uid);
        }
        else
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
                else if($method=='mdpoublie') {
                    $new_mdp=$this->Members->changerMdp($data['email']);
                    if($new_mdp!=null)
                    {
                        $this->Flash->success("Nouveau mot de passe : pass");   
                    }          
                    else $this->Flash->error('Erreur changement de mot de passe');                                       
                }
                else if($method=='inscription')
                {
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
        }  
    }
    

    public function monCompte() {
        $uid = $this->request->session()->read('uid');
        if($uid!=0)
        {
            $this->set("uid", $uid);
            $this->loadModel("Members");
            $infos= $this->Members->userInfo($this->request->session()->read('uid'));
            if($infos) $this->set("infos", $infos); 
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

    public function logout()
    {
        $uid = $this->request->session()->read('uid');
        if($uid==0)
        {
            $this->Flash->success('You are already logged out');
            $this->redirect(['action' => 'index']);
        }
        else
        {
            $this->Flash->success('You are logged out');
            $this->request->session()->write('uid', 0);
            $this->redirect(['action' => 'index']);
        }
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
        $uid = $this->request->session()->read('uid');
        $this->set("id",$uid);
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

    public function messeances()
    {
        $uid = $this->request->session()->read('uid');
        $this->set("uid", $uid);
        if($uid==0)
        {
            $this->redirect(['action' => 'index']);
            $this->Flash->error('Veuillez vous connecter');
        }
        else
        {
            $this->loadModel("Workouts");
            $workouts=$this->Workouts->getWorkouts($uid);
            $this->set('workouts', $workouts);
            if ($this->request->is('post')) {
                $data= $this->request->data;
                $time_begin= new Time();
                    $time_begin->year($data['date']['year']);
                    echo($data['date']['year']);
                    $time_begin->month($data['date']['month']);
                    $time_begin->day($data['date']['day']);
                    $time_begin->hour($data['date']['hour']);
                    $time_begin->minute($data['date']['minute']);
                    $time_begin->second(00);
                $time_end= new Time();
                    $time_end->year($data['end_date']['year']);
                    $time_end->month($data['end_date']['month']);
                    $time_end->day($data['end_date']['day']);
                    $time_end->hour($data['end_date']['hour']);
                    $time_end->minute($data['end_date']['minute']);
                    $time_end->second(00);


                $workout = $this->Workouts->newEntity();
                
                $workout->member_id = $uid;
                $workout->date = $time_begin;
                $workout->end_date = $time_end;
                $workout->location_name = $data['location_name'];
                $workout->description = $data['description'];
                $workout->sport = $data['sport'];
                //$workout->contest_id = $data['contest_id'];

                if ($this->Workouts->save($workout)) {
                    $this->Flash->success(__('The workout has been saved.'));

                    return $this->redirect(['action' => 'messeances']);
                }
                $this->Flash->error(__('The workout could not be saved. Please, try again.'));
            }
        }   
    }
    public function classement()
    {
        $uid = $this->request->session()->read('uid');
        $this->set("uid", $uid);
        $this->loadModel("Members");
        $this->loadModel("Workouts");
        

        $infos3= $this->Workouts->count_workouts();
        
        $this->set("infos3",$infos3);
    }
}
?>