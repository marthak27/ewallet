<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Balance extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        
        // Load the user model
        $this->load->model('balance_m');
    }
    
    public function transfer_post() {
        $id = $this->put('id');
        // Get the post data
        $userID        = $this->post('user_id');
        $balance        = $this->post('balance');
        $balanceAchieve = $this->post('balance_achieve');
        
        // Validate the post data
        if(!empty($userID) && !empty($balance) && !empty($balanceAchieve)){
            
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'user_id' => $userID,
            );
            $BalanceCount = $this->balance_m->getRows($con);
            
            if($BalanceCount > 0){
                $balanceData = array(
                    'user_id' => $userID,
                    'balance' => $balance,
                    'balance_achieve' => $balanceAchieve
                );
                $insert = $this->balance_m->insert($balanceData);

                $BalanceUpdate = array();
                $BalanceUpdate['balance'] = $balanceSum;
                $update = $this->balance_m->update($balanceUpdate, $id);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Topup berhasil!',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
                
            } else {

                // Insert user data
                $balanceData = array(
                    'user_id' => $userIID,
                    'balance' => $balance,
                    'balance_achieve' => $balanceAchieve
                );
                $insert = $this->balance_m->insert($balanceData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Transfer saldo berhasil!',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
        }else{
            // Set the response and exit
            $this->response("Provide complete user info to add.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }
    
    public function registration_post() {
        // Get the post data
        $username = strip_tags($this->post('username'));
        $email = strip_tags($this->post('email'));
        $password = $this->post('password');
        
        // Validate the post data
        if(!empty($username) && !empty($email) && !empty($password)){
            
            // Check if the given email already exists
            $con['returnType'] = 'count';
            $con['conditions'] = array(
                'email' => $email,
            );
            $userCount = $this->user_m->getRows($con);
            
            if($userCount > 0){
                // Set the response and exit
                $this->response("The given email already exists.", REST_Controller::HTTP_BAD_REQUEST);
            }else{
                // Insert user data
                $userData = array(
                    'username' => $username,
                    'email' => $email,
                    'password' => md5($password)
                );
                $insert = $this->user_m->insert($userData);
                
                // Check if the user data is inserted
                if($insert){
                    // Set the response and exit
                    $this->response([
                        'status' => TRUE,
                        'message' => 'The user has been added successfully.',
                        'data' => $insert
                    ], REST_Controller::HTTP_OK);
                }else{
                    // Set the response and exit
                    $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }else{
            // Set the response and exit
            $this->response("Provide complete user info to add.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

    public function logout_get(){
        //delete all session
        session_destroy();
        $this->response([
            'status' => TRUE,
            'message' => 'log Out successfully',
        ], REST_Controller::HTTP_OK);
        $this->output->set_output(json_encode(array('status'=>true,'msg'=>'log Out successfully')));
    }
    
    public function user_get($id = null) {
        // Returns all the users data if the id not specified,
        // Otherwise, a single user will be returned.
        $con = $id?array('id' => $id):'';
        $users = $this->user_m->getRows($con);
        $usersAll = $this->user_m->get_list_user($con);
        
        // Check if the user data exists
        if(!empty($users)){
            // Set the response and exit
            //OK (200) being the HTTP response code
            $this->response($users, REST_Controller::HTTP_OK);
        } else if (empty($usersAll)){
            $this->response($usersAll, REST_Controller::HTTP_OK);
        } else {
            // Set the response and exit
            //NOT_FOUND (404) being the HTTP response code
            $this->response([
                'status' => FALSE,
                'message' => 'No user was found.'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }
    
    public function user_put() {
        $id = $this->put('id');
        
        // Get the post data
        $username = strip_tags($this->put('username'));
        $email = strip_tags($this->put('email'));
        $password = $this->put('password');
        
        // Validate the post data
        if(!empty($id) && (!empty($username) || !empty($email) || !empty($password))){
            // Update user's account data
            $userData = array();
            if(!empty($username)){
                $userData['username'] = $username;
            }
            if(!empty($email)){
                $userData['email'] = $email;
            }
            if(!empty($password)){
                $userData['password'] = md5($password);
            }
        
            $update = $this->user_m->update($userData, $id);
            
            // Check if the user data is updated
            if($update){
                // Set the response and exit
                $this->response([
                    'status' => TRUE,
                    'message' => 'The user info has been updated successfully.'
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                $this->response("Some problems occurred, please try again.", REST_Controller::HTTP_BAD_REQUEST);
            }
        }else{
            // Set the response and exit
            $this->response("Provide at least one user info to update.", REST_Controller::HTTP_BAD_REQUEST);
        }
    }

}