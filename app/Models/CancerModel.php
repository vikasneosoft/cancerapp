<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancerModel extends Model
{
    use HasFactory;
    protected $table = 'cancer_types';
    protected $fillable = ['name','status' ];

    /**
     * Get Cancer types.
     *
     *
     * @return array
     */
    function getCancerTypes(){
        return $this->select('id','name','status')
        ->orderby('id','desc')
        ->get();
    }

    /**
     * Get active Cancer type
     *
     *
     * @return array
     */
    function getActiveCancerTypes(){
        return $this::where(array('status'=>1))
        ->orderby('id','asc')
        ->pluck( 'name', 'id' );
    }

   
    /**
     * Get Cancer type by id.
     *
     * @param  $id
     * @return array
     */
    function getCancerTypeById($id){
        return $this::find($id);
    }


    /**
     * Store new Cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addCancerType($inputs){
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * Update Cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    function updateCancerType($inputs){
        $obj = $this::find($inputs['id']);
        $obj->update( $inputs );
        return $obj->id;
    }

    /**
     * Delete Cancer type
     *
     * @param  array  $inputs
     * @return true
     */
    function deleteCancerType($id){
        return $this::where(array('id' => $id))->delete();
    }

    
}
