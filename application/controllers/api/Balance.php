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
        $this->load->model('balance_history_m');
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

                $balanceData = array(
                    'user_id' => $userIID,
                    'balance' => $balance,
                    'balance_achieve' => $balanceAchieve
                );
                $insert = $this->balance_m->insert($balanceData);
                $balanceID = $this->db->insert_id();

                $balanceHistory = array(
                    'user_balance_id' => $balanceIID,
                    'balance_before' => $balanceBefore,
                    'balance_after' => $balanceAfter,
                    'activity' => $activity,
                    'type' => $type,
                    'location' => $location,
                    'user_agent' => $user_agent,
                    'author' => $author,
                );
                $insertHistory = $this->balance_history_m->insert($balanceHistory);
                
                // Check if the user data is inserted
                if($insert && $insertHistory){
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

}