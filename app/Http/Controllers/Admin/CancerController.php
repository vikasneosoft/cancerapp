<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\CancerRequest;
use App\Models\CancerModel;

class CancerController extends Controller
{
    /**
     * Get Cancer types.
     *
     *
     * @return array
     */
    public function getCancerTypes(){
        $cancerTypes =  (new CancerModel)->getCancerTypes()->toArray();
        return view( 'admin.cancerType.listing',['cancerTypes' => $cancerTypes,'active' => 'cancerType'] );
    }

    /**
     * load view to add Cancer types
     *
     * @return view
     */
    public function viewAddCancerType(){
        return view( 'admin.cancerType.add',['active' => 'cancerType'] );
    }

     /**
     * Store new Cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    public function addCancerType(CancerRequest $request){
        $inputs = $request->all();
        unset($inputs['_token']);
        $objId = (new CancerModel())->addCancerType($inputs);
        if( $objId ){
            flash()->success( 'Added successfully' );
            return response()->json( ['success' => true ] );
        }
        flash()->error('Something went wrong');
        return response()->json( ['success' => false ] );
    }

    /**
     * load view to edit Cancer type
     *
     * @param  $id
     * @return view
     */
    public function viewEditCancerType($id){
        $cancerType = (new CancerModel())->getCancerTypeById($id);
        return view( 'admin.cancerType.edit',['cancerType' => $cancerType,'active' => 'cancerType'] );
    }

    /**
     * edit Cancer type
     *
     * @param  array  $inputs
     * @return objectId
     */
    public function editCancerType(CancerRequest $request){
        $inputs = $request->all();
        $objId = (new CancerModel())->updateCancerType($inputs);
        if( $objId ){
            flash()->success( 'Updated successfully' );
            return response()->json( ['success' => true ] );
        }
        flash()->error('Something went wrong');
        return response()->json( ['success' => false ] );
    }

    /**
     * change status of Cancer type
     *
     * @param array
     * @return true||false
     */
    public function changeStatus(Request $request){
        $inputs = $request->all();
        $objId = (new CancerModel())->updateCancerType($inputs);
        if( $objId ){
            flash()->success( 'Status changed successfully' );
            return response()->json( ['success' => true ] );
        }
        flash()->error('Something went wrong');
        return response()->json( ['success' => false] );
    }

    /**
     * delete Cancer type
     *
     * @param id
     * @return true||false
     */
    public function deleteCancerType(Request $request){
        $objId = (new CancerModel())->deleteCancerType($request->id);
        if($objId){
            flash()->success( 'Deleted successfully' );
            return response()->json(['success'=>true ]);
        } else{
            flash()->error('Something went wrong');
            return response()->json( ['success' => false] );
        }
    }
}