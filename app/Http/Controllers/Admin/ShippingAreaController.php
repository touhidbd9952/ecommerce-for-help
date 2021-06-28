<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ShipDistrict;
use App\Models\ShipDivision;
use App\Models\ShipState;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingAreaController extends Controller
{
    //create division
    public function createDivision(){
        $divisions = ShipDivision::orderBy('id','DESC')->get();
        return view('admin.ship-division.create',compact('divisions'));
    }

    //store division
    public function divisionStore(Request $request){
        $request->validate([
            'division_name' => 'required',
        ]);

        ShipDivision::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //division edit
     public function divisionEdit($division_id){
         $division = ShipDivision::findOrFail($division_id);
         return view('admin.ship-division.edit',compact('division'));
     }

     //update division
     public function divisionUpdate(Request $request){
        $division_id = $request->id;
        $request->validate([
            'division_name' => 'required',
        ]);
        ShipDivision::findOrFail($division_id)->update([
            'division_name' => $request->division_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('division')->with($notification);
     }

     //division Destroy
     public function divisionDestroy($division_id){
         ShipDivision::findOrFail($division_id)->delete();
         $notification=array(
            'message'=>'Delete Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
     }

    // ================================= District ========================
    public function districtCreate(){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $districts = ShipDistrict::with('division')->orderBy('id','DESC')->get();
        return view('admin.ship-distict.create',compact('districts','divisions'));
    }

    //district store
    public function districtStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'division_id' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipDistrict::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //district edit
    public function districtEdit($district_id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $district = ShipDistrict::findOrFail($district_id);
        return view('admin.ship-distict.edit',compact('divisions','district'));
    }

    //distirct update
    public function districtUpdate(Request $request){
        $district_id = $request->id;
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipDistrict::findOrFail($district_id)->update([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('district')->with($notification);
    }

    //district destory
    public function districtDestroy($district_id){
        ShipDistrict::findOrFail($district_id)->delete();
        $notification=array(
           'message'=>'Delete Success',
           'alert-type'=>'success'
       );
       return Redirect()->back()->with($notification);
    }


    // ==================== state ===============
    public function stateCreate(){
        $states = ShipState::with('division','district')->orderBy('id','DESC')->get();
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        return view('admin.ship-state.create',compact('states','divisions'));
    }

    //get district with ajax
    public function getDistrictAjax($division_id){
           $ship = ShipDistrict::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
           return json_encode($ship);
    }

    //store
    public function stateStore(Request $request){
        $request->validate([
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipState::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'created_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'Added Success',
            'alert-type'=>'success'
        );
        return Redirect()->back()->with($notification);
    }

    //state edit
    public function stateEdit($state_id){
        $divisions = ShipDivision::orderBy('division_name','ASC')->get();
        $state = ShipState::findOrFail($state_id);
        return view('admin.ship-state.edit',compact('divisions','state'));
    }

    //state update
    public function stateUpdate(Request $request){
        $state_id = $request->id;
        $request->validate([
            'division_id' => 'required',
            'state_name' => 'required',
        ],[
            'division_id.required' => 'select divison'
        ]);

        ShipState::findOrFail($state_id)->update([
            'division_id' => $request->division_id,
            'state_name' => $request->state_name,
            'updated_at' => Carbon::now(),
        ]);
        $notification=array(
            'message'=>'update Success',
            'alert-type'=>'success'
        );
        return Redirect()->route('state')->with($notification);
    }


     //district destory
     public function stateDestroy($state_id){
        ShipState::findOrFail($state_id)->delete();
        $notification=array(
           'message'=>'Delete Success',
           'alert-type'=>'success'
       );
       return Redirect()->back()->with($notification);
    }

}
