<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Booking;
use App\Models\BookingTransaction;
use App\Models\User;

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
	*	Set instance for each protected property
	*/
    function __construct()
    {
    	$this->booking = new Booking();
    	$this->bookingTransaction = new BookingTransaction();
    	$this->user = new User();
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
	*	Function for authenticate user for login
	*	@param Instance of Request
	*/
    public function login(Request $request)
    {
    	
    	
    }
    
    /**
	*	Function to create new user record
	*	@param Instance of Request
	*/
    public function createUser(Request $request)
    {
    	
    	
    }

    /**
	*	Function to update user record
	*	@param Instance of Request
	*/
    public function updateUser(Request $request)
    {
    	
    	
    }

    /**
	*	Function to delete user record
	*	@param Instance of Request
	*/
    public function deleteUser(Request $request)
    {
    	
    	
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
