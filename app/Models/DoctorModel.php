<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;
class DoctorModel extends Authenticatable
{
    use HasFactory;
    protected $guard_name = 'doctor';

    protected  $table = 'doctors';
     
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id','name','password','email','specialization','status'];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get doctor list.
     *
     *
     * @return array
     */
    function getDoctors(){
        return $this::with('cancerType')->select('id','name','email','status','specialization')
        ->orderby('id','desc')
        ->get();
    }


   
    /**
     * Get doctor by id.
     *
     * @param  $id
     * @return array
     */
    function getDoctorById($id){
        return $this::find($id);
    }


    /**
     * Store new doctor
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addDoctor($inputs){
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update doctor
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateDoctor($inputs){
        $obj = $this::find($inputs['id']);
        $obj->update( $inputs );
        return $obj->id;
    }

    /**
     * Delete doctor by id
     *
     * @param  array  $inputs
     * @return true
     */
    function deleteDoctor($id){
        return $this::where(array('id' => $id))->delete();
    }

    /**
     * Get specializations
     *
     *
     * @return array
     */
    public function cancerType(){
        return $this->belongsTo(CancerModel::class,'specialization','id')
                    ->select(array('id','name'));
    }
}
