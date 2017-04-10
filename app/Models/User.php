<?php

namespace App\Models;

// use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use DB;

class User extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // protected $fillable = [
    //     'name', 'email', 'password',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table="users";


    public function ifExist($data=null)
    {
        $check = DB::select("
            select 
                count(*) as total
            from 
                users 
            where 
                name=?
                OR
                email=?
                OR
                password=?
            limit 1", 
            [$data,$data,$data]
        );

        return $check;
    }

    // public function find()
    // {
    //     $object = get_object_vars($this);

    //     $clause = "";
    //     $params= "";

    //     foreach ($object['attributes'] as $key => $value) {
            
    //         $clause.="$key=? AND ";
    //         $params[] = $value;
    //     }

    //     $clause = rtrim($clause,"AND ");

    //     $result = DB::select("select * from users where $clause", $params);

    //     return $result;
    // }
    
}
