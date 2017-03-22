<?php

namespace App\Controller;
use App\Controller\AppController;

class SportController extends AppController
{	
    /*public function Forget()
    {
        echo ("coucou");
    }*/

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
}
?>