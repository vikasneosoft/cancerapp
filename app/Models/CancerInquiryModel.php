<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CancerInquiryModel extends Model
{
    use HasFactory;
    protected $table = 'cancer_inquiries';
    protected $fillable = ['id','name','email','contact_number','state','city','address','pincode','cancer_type','document','status'];

    /**
     * Store new Cancer Inquiry
     *
     * @param  array  $inputs
     * @return objectId
     */
    function addInquiry($inputs){
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
    function getCancerInquiriesByType($cancerType){
        return $this::with(array('cancerType'))->select('id','name','email','contact_number','state','city','address','pincode','cancer_type','document','status')
            ->where(array('cancer_type'=>$cancerType))
            ->get();
    }

    /**
     * get Cancer Inquiry by type of cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    function getCancerInquiryById($id){
        return $this::with(array('cancerType','plans'))->select('id','name','email','contact_number','state','city','address','pincode','cancer_type','document','status')
            ->where(array('id'=>$id))
            ->first();
    }

    /**
     * Get specializations
     *
     *
     * @return array
     */
    public function cancerType(){
        return $this->belongsTo(CancerModel::class,'cancer_type','id')
                    ->select(array('id','name'));
    }

    /**
     * Get plan related to this inquery
     *
     *
     * @return array
     */
    public function plans(){
        return $this->hasMany(InquiryPlanModel::class,'cancer_inquiry_id','id')
                    ->select(array('id','cancer_inquiry_id'));
    }

}
