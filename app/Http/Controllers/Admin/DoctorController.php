<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\DoctorRequest;
use App\Models\DoctorModel;
use App\Models\CancerModel;

class DoctorController extends Controller
{
    /**
     * Get doctor list.
     *
     *
     * @return array
     */
    //public function getDoctors()
    public function index()
    {
        $doctors =  (new DoctorModel)->getDoctors()->toArray();
        return view('admin.doctors.listing', ['doctors' => $doctors, 'active' => 'doctor']);
    }

    /**
     * load view to add doctor
     *
     * @return view
     */
    //public function viewAddDoctor()
    public function create()
    {
        $cancerTypes =  (new CancerModel)->getActiveCancerTypes()->toArray();
        return view('admin.doctors.add', ['cancerTypes' => $cancerTypes, 'active' => 'doctor']);
    }

    /**
     * Store new doctor
     *
     * @param  array  $inputs
     * @return objectId
     */
    //public function addDoctor(DoctorRequest $request)
    public function store(DoctorRequest $request)
    {
        $inputs = $request->all();
        $password = str_shuffle('ABCD234');
        $inputs['password'] = bcrypt($password);
        unset($inputs['_token']);
        $objId = (new DoctorModel())->addDoctor($inputs);
        if ($objId) {
            sendCredentialsToDocor($inputs['email'], $inputs['name'], $password);
            flash()->success('Added successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * load view to edit doctor
     *
     * @param  $id
     * @return view
     */
    // public function viewEditDoctor($id)
    public function show($id)
    {
        $doctor = (new DoctorModel())->getDoctorById($id);
        $cancerTypes =  (new CancerModel)->getActiveCancerTypes()->toArray();
        return view('admin.doctors.edit', ['cancerTypes' => $cancerTypes, 'doctor' => $doctor, 'active' => 'doctor']);
    }

    /**
     * load view to edit doctor
     *
     * @param  $id
     * @return view
     */
    // public function viewEditDoctor($id)
    public function edit($id)
    {
        $doctor = (new DoctorModel())->getDoctorById($id);
        $cancerTypes =  (new CancerModel)->getActiveCancerTypes()->toArray();
        return view('admin.doctors.edit', ['cancerTypes' => $cancerTypes, 'doctor' => $doctor, 'active' => 'doctor']);
    }

    /**
     * edit Cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    //  public function editDoctor(DoctorRequest $request)
    public function update(DoctorRequest $request)
    {
        $inputs = $request->all();
        $objId = (new DoctorModel())->updateDoctor($inputs);
        if ($objId) {
            flash()->success('Updated successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * change status of doctor
     *
     * @param array
     * @return true||false
     */
    public function changeDoctorStatus(Request $request)
    {
        $inputs = $request->all();
        $objId = (new DoctorModel())->updateDoctor($inputs);
        if ($objId) {
            flash()->success('Status changed successfully');
            return response()->json(['success' => true]);
        }
        flash()->error('Something went wrong');
        return response()->json(['success' => false]);
    }

    /**
     * delete doctor
     *
     * @param id
     * @return true||false
     */
    //public function deleteDoctor(Request $request)
    public function destroy(Request $request)
    {

        $objId = (new DoctorModel())->deleteDoctor($request->id);
        if ($objId) {
            flash()->success('Deleted successfully');
            return response()->json(['success' => true]);
        } else {
            flash()->error('Something went wrong');
            return response()->json(['success' => false]);
        }
    }
}
