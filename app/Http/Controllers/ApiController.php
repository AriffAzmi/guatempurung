<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Booking;
use App\Models\BookingTransaction;
use App\Models\User;
use App\Encryption\Hash;

class ApiController extends Controller
{
	/**
	*	Booking Model Instance
	*	@var array
	*/
    protected $booking;

    /**
	*	Booking Transaction Model Instance
	*	@var array
	*/
    protected $bookingTransaction;

    /**
	*	User Model Instance
	*	@var array
	*/
    protected $user;

    /**
    *   Hash Encryption Instance
    *   @var array
    */
    protected $hash;

    /**
	*	Set instance for each protected property
	*/
    function __construct()
    {
    	$this->booking = new Booking();
    	$this->bookingTransaction = new BookingTransaction();
    	$this->user = new User();
        $this->hash = new Hash();
    }

    /**
	*	Function to return instance of booking
         */
    public function booking()
    {
    	return $this->booking;
    }

    /**
	*	Function to return instance of booking transaction
	*/
    public function bookingTransaction()
    {
    	return $this->bookingTransaction;
    }

	/**
	*	Function to return instance of user
	*/    
    public function user()
    {
    	return $this->user;
    }

    /**
    *   Function to return instance of http request
    */    
    public function request()
    {
        return (new Request());
    }

    /**
    *   Function to return instance of Hash
    */    
    public function hash()
    {
        return $this->hash;
    }


    public function testhash(Request $request)
    {
        $hash = $this->hash()->encrypt($request->password,env("HASH_KEY"));
        $original_data = $this->hash()->decrypt($hash,env("HASH_KEY"));
        $result[] = [
            'hash' => $hash,
            'original_data' => $original_data
        ];

        return response()->json($result);
    }

    /**
	*	Function for authenticate user for login
	*	@param Instance of Request
	*/
    public function login(Request $request)
    {
    	if (strlen($request->email) <= 0) {
            
            $response['result'] = [
                'status' => false,
                'message' => "Required key email was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else if (strlen($request->password) <= 0) {
            
            $response['result'] = [
                'status' => false,
                'message' => "Required key password was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else{

            $this->user()->email = $request->email;
            $this->user()->password = $this->hash()->encrypt($request->password,env("HASH_KEY"));
            $check = $this->user()->find();
            
            if (count($check) > 0) {
                
                $response['result'] = [
                    'status' => true,
                    $check
                ];

                return response()->json($response);
            }
            else{

                $response['result'] = [
                    'status' => false,
                    'message' => 'Record not found'
                ];

                return response()->json($response);
            }
        }
    	
    }
    
    /**
	*	Function to create new user record
	*	@param Instance of Request
	*/
    public function createUser(Request $request)
    {
        
        if (strlen($request->name) <= 0) {
            
            $response['result'][] = [
                'status' => false,
                'message' => "Required key name was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else if (strlen($request->email) <= 0) {
            
            $response['result'][] = [
                'status' => false,
                'message' => "Required key email was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else if (strlen($request->password) <= 0) {
            
            $response['result'][] = [
                'status' => false,
                'message' => "Required key password was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else{

            $check = $this->user()->ifExist($request->email);

            if ($check[0]->total > 0) {
                
                $response['result'][] = [
                    'status' => false,
                    'message' => "This email was exist in the record"
                ];

                return response()->json($response);
                exit();
            }
            else{

                $this->user()->name = $request->name;
                $this->user()->email = $request->email;
                $this->user()->password = $this->hash->encrypt($request->password,env("HASH_KEY"));

                if ($this->user()->save()) {
                    
                    $response['result'][] = [
                        'status' => false,
                        'message' => "Successfully register"
                    ];

                    return response()->json($response);
                    exit();
                }
                else{

                    $response['result'][] = [
                        'status' => false,
                        'message' => "Something error while registering your account"
                    ];

                    return response()->json($response);
                    exit();   
                }
            }
        }
    }

    /**
	*	Function to update user record
	*	@param Instance of Request
	*/
    public function updateUser(Request $request)
    {
    	if (strlen($request->id) <= 0) {
            
            $response['result'] = [
                'status' => false,
                'message' => "Required key id was not found or it was empty"
            ];

            return response()->json($response);
            exit();
        }
        else{

            $check = User::find($request->id);

            if (count($check) > 0) {
                
                if (strlen($request->name) > 0) {
                    
                    $this->user()->name = $request->name;
                }
                else if(strlen($request->password) > 0){

                    $this->user()->password = $this->hash->encrypt($request->password);
                }
                
                if ($this->user()->save()) {
                    
                    $response['result'] = [
                        'status' => true,
                        'message' => "Successfully update user"
                    ];

                    return response()->json($response);
                    exit();
                }
                else{

                    $response['result'] = [
                        'status' => false,
                        'message' => "Something error while updating user record"
                    ];

                    return response()->json($response);
                    exit();
                }
            }
        }
    }

    /**
	*	Function to delete user record
	*	@param Instance of Request
	*/
    public function deleteUser(Request $request)
    {
    	
    	$check = User::find($request->id);

        if (count($check) > 0) {

            if($this->user()->delete()){

                $response['result'] = [
                    'status' => true,
                    'message' => "Successfully delete user"
                ];

                return response()->json($response);
                exit();
            }
            else{

                $response['result'] = [
                    'status' => false,
                    'message' => "Something error while deleting user record"
                ];

                return response()->json($response);
                exit();
            }
        }
        else{

            $response['result'] = [
                'status' => false,
                'message' => "Record not found"
            ];

            return response()->json($response);
            exit();
        }
    }

    /**
	*	Function to create new booking record
	*	@param Instance of Request
	*/
    public function createBooking(Request $request)
    {
    	

    }

    /**
	*	Function to delete booking record
	*	@param Instance of Request
	*/
    public function updateBooking(Request $request)
    {
    	

    }

    /**
	*	Function to retrieve all booking record
	*	@param Instance of Request
	*/
    public function listBooking(Request $request)
    {
    	

    }

    /**
	*	Function to retrieve booking record by specific condition
	*	@param Instance of Request
	*/
    public function findBooking(Request $request)
    {
    	

    }

    /**
	*	Function to delete booking record
	*	@param Instance of Request
	*/
    public function deleteBooking(Request $request)
    {
    	

    }

}
