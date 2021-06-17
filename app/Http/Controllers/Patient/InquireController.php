<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CancerInquiryModel;
use App\Http\Requests\Frontend\InquiryRequest;

use Config;
class InquireController extends Controller
{
    public function addInquiry(InquiryRequest $request){
        $inputs = $request->all();
        $documents = $request->file();
        $destinationPath =  public_path(Config::get('constants.DOCUMENT_FOLDER'));
        $imgName = time().$request->document->getClientOriginalName();
        $image =  $documents['document'];
        $imagepath = $destinationPath . $imgName;
        $image->move($destinationPath,$imagepath);
        $inputs['document'] = $imgName;
        $inputs['status'] = 0;
        unset($inputs['_token']);
        $objId = (new CancerInquiryModel())->addInquiry($inputs);
        if($objId){
            flash()->success('Your inquiry is submitted successfully' );
            return response()->json( ['success' => true ] );
        }
        flash()->error('Something went wrong');
        return response()->json( ['success' => false ] );
       
        
    }
}
