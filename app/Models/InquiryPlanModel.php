<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryPlanModel extends Model
{
    use HasFactory;
    protected $table = 'cancer_inquiry_plans';
    protected $fillable = ['id','cancer_inquiry_id','doctor_id','plan' ];

     /**
     * Store new Cancer inquiry plan
     *
     * @param  array  $inputs
     * @return objectId
     */
    function add($inputs){
        $obj = new $this($inputs);
        $obj->save();
        return $obj->id;
    }

    /**
     * get Cancer Inquiry by type of cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    function getPlanByInquiryId($id){
        return $this::select('id','doctor_id')
            ->where(array('cancer_inquiry_id'=>$id))
            ->first();
    }

    /**
     * get Cancer Inquiry by type of cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    function getPlanById($id){
        return $this::select('id','doctor_id','plan')
            ->where(array('id'=>$id))
            ->first();
    }

}
