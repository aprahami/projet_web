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
                // Envoi e-mail
                else if($method=='mdpoublie') {
                    $new_mdp=$this->Members->changerMdp($data['email']);
                    if($new_mdp!=null)
                    {
                        $this->Flash->success("Nouveau mot de passe : pass");   
                    }          
                    else $this->Flash->error('Erreur changement de mot de passe');                                       
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
}
?>