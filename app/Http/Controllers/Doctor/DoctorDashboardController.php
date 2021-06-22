<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Doctor\PlanGenerationRequest;

use App\Models\DoctorModel;
use App\Models\CancerInquiryModel;
use App\Models\InquiryPlanModel;
use Auth;
use PDF;
use Mail;
use Config;

class DoctorDashboardController extends Controller
{
    /**
     * redirect to doctor dashboard.
     *
     *@param array
     */
    public function dashboard()
    {
        $inquries =  (new CancerInquiryModel)->getCancerInquiriesByType(Auth::guard('doctor')->user()->specialization)->toArray();
        return view('doctor.dashboard', ['inquries' => $inquries, 'active' => 'dashboard']);
    }

    /**
     * get detail Inquiry By Id
     *
     *@param array
     */

    public function getDetailInquiryById($id)
    {
        $inquiry =  (new CancerInquiryModel)->getCancerInquiryById($id)->toArray();
        $inquiryPlan =  (new InquiryPlanModel)->getPlanByInquiryId($id);
        if (isset($inquiryPlan->doctor_id)) {
            if ($inquiryPlan->doctor_id != Auth::guard('doctor')->user()->id) {
                return redirect()->route('doctor.dashboard')->with('message', 'There is already plan for this inquery');
            }
        }
        return view('doctor.inqueryDetail', ['inquiry' => $inquiry, 'active' => 'dashboard']);
    }

    /**
     * add Inquiry plan
     *
     *@param array
     */
    public function addPlan(PlanGenerationRequest $request)
    {
        $inputs  = $request->all();
        $inputs['doctor_id'] = Auth::guard('doctor')->user()->id;
        $inputs['plan'] = $inputs['content'];
        unset($inputs['_token']);
        $objId =  (new InquiryPlanModel)->add($inputs);
        CancerInquiryModel::where(array('id' => $inputs['cancer_inquiry_id']))->update(array('status' => 1));
        if ($objId) {
            sendPlanToPatient($inputs['email'], $inputs['name'], $inputs['content']);
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * print Inquiry plan
     *
     *@param id
     */
    public function printPlan($id)
    {
        $inquiryPlan =  (new InquiryPlanModel)->getPlanById($id);
        $data["body"] = $inquiryPlan->plan;
        $pdf = PDF::loadView('doctor.pdfs.printPlan', $data);
        return $pdf->download('plan.pdf');
    }
}
