<?php

namespace App\Http\Controllers;

use App\User;
use App\Doctor;
use App\Patient;
use App\Http\Controllers\Controller;
use App\Person;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Session;
use DB;
use File;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use App\SSP;
use App\Uniqueid;
use Carbon\Carbon;

class AdminController extends Controller
{

    public function dashboard(Request $request){
        return view('index');
    }

    public function login(){
        return view('login');
    }

    public function postlogin(Request $request)
    {   
        $input = Input::all();
        $name = $input['name'];
        $password = $input['password'];
        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            return redirect()->intended('admin/dashboard');
            
        }
        else{
            return redirect()->intended('login');
        }

        
    }

    

    public function doctorAdd(Request $request){
        return view('doctoradd');
    }

    public function patientAdd(Request $request){
        return view('patientadd');
    }

    public function doctorSave(Request $request){

        $start_range = $request->uniqueid['start_range'];
        $end_range = $request->uniqueid['end_range'];
        $count = count($start_range);
        $idList = [];
        for($k=0;$k<$count;$k++){
            $array = [$start_range[$k], $end_range[$k]];
            array_push($idList, $array);
        }
        $i = 0;
        $check = 0;
        foreach($idList as $uniqueID){
            $j = 0;
            foreach($idList as $newuniqueID){
                if($i!=$j){
                    if($uniqueID[0]>=$newuniqueID[0] && $uniqueID[0]<=$newuniqueID[1]){
                        $message = "Overlapping Range1";
                        $check =1;
                        break;
                    }
                    if($uniqueID[1]>=$newuniqueID[0] && $uniqueID[1]<=$newuniqueID[1]){
                        $message = "Overlapping Range";
                        $check =1;
                        break;
                    }
                }
                $j++;
            }
            $i++;
        }
        foreach ($idList as $uniqueID) {
            $exist0 = Uniqueid::where('start_range','>=',$uniqueID[0])->where('end_range','<=',$uniqueID[0])->count();
            $exist1 = Uniqueid::where('start_range','>=',$uniqueID[1])->where('end_range','<=',$uniqueID[1])->count();
            if($exist0>0 || $exist1>0){
                $message = "Range already exists.";
                return Redirect::back()->withInput()->with('message',$message);
            }
        }
        if($check==1){
            return Redirect::back()->withInput()->with('message',$message);
        }
        $doctor = new Doctor();
        $doctor->name = $request->name;
        $doctor->bmdc = $request->bmdc;
        $doctor->gender = $request->gender;
        $doctor->chamber_name = $request->chamber_name;
        $doctor->phone = $request->phone;
        $doctor->chamber_address = $request->chamber_address;
        $doctor->save();
        $p = 0;
        foreach ($idList as $list) {
            $Uniqueid = new Uniqueid();
            $Uniqueid->doctor_id = $doctor->id;
            $Uniqueid->start_range = $list[0];
            $Uniqueid->end_range = $list[1];
            $Uniqueid->save();
            $p++;
        }
        return redirect('admin/doctor/index');

        
    }


    public function patientsave(Request $request){
        $check = Patient::where('unique_id',$request->unique_id)->count();
        if($check>4){
            $message = "This uniqueID already has 5 patients";
            return Redirect::back()->withInput()->with('message',$message);
        }
        $patient = new Patient();
        $patient->unique_id = $request->unique_id;
        $patient->name = $request->name;
        $patient->gender = $request->gender;
        $patient->marrital_status = $request->marrital_status;
        $patient->age = $request->age;
        $patient->phone = $request->phone;
        $patient->address = $request->address;
        $patient->assigned_chamber = $request->assigned_chamber;
        $patient->save();
        return redirect('admin/patient/index');
    }


    public function updatepatient(Request $request){
        $check = Patient::where('unique_id',$request->unique_id)->count();
        // dd($check);
        if($check>4){
            $message = "This uniqueID already has 5 patients";
            return Redirect::back()->withInput()->with('message',$message);
        }
        $patient = Patient::find($request->id);
        $patient->unique_id = $request->unique_id;
        $patient->name = $request->name;
        $patient->gender = $request->gender;
        $patient->marrital_status = $request->marrital_status;
        $patient->age = $request->age;
        $patient->phone = $request->phone;
        $patient->address = $request->address;
        $patient->assigned_chamber = $request->assigned_chamber;
        $patient->save();
        return redirect('admin/patient/index');
    }

    public function patientEdit($id){
        $patient =  Patient::find($id);
        return view('patientedit')->with('patient',$patient);
    }

    public function checkUniqueID(Request $request){
        $patient = Patient::where('unique_id',$request->unique_id)->count();
        if($patient>4){
            $message = "This uniqueID already has 5 patients";
            return response()->json(['error' => "This uniqueID already has 5 patients"], 404);
        }
        $doctor =  DB::table('doctors')
                    ->select('doctors.chamber_name','doctors.id')
                    ->join('uniqueids','doctors.id','=','uniqueids.doctor_id')
                    ->where('start_range','<=', $request->unique_id)
                    ->where('end_range', '>=',$request->unique_id)
                    ->first();
        
        return response()->json(['data' => $doctor]);
    }

    public function validateRange($uniqueIdArray,$inputUniques,$i=-1){
        $check = 0;
        $from = explode("-", $uniqueIdArray);
        $j= 0;
        foreach ($inputUniques as $inputUnique) {
            if($j!=$i){
                $inputUnique = explode("-", $inputUnique);
                if(is_numeric($inputUnique[0]) && is_numeric($inputUnique[1])){
                    if($inputUnique[0]>=$from[0] && $inputUnique[0]<=$from[1]){
                        $message = "Range already exist";
                        $check =1;
                        break;
                    }
                    if($inputUnique[1]>=$from[0] && $inputUnique[0]<=$from[1]){
                        $message = "Range already exist";
                        $check =1;
                        break;
                    }
                }
                else{
                    $check = 2;
                    break;
                }
            }
            $j++;
        }
        return $check;
    }
    public function doctorList(Request $request){
        return view('doctorList');
    }

    public function patientList(Request $request){
        return view('patientList');
    }

    public function getpersons(Request $request){
        
        $table = 
            "(
                SELECT *From persons
            ) testtable";


        $primaryKey = 'id';

        $columns = array(

            array( 'db' => 'id',  'dt' => 'id' ),

            array( 'db' => 'name', 'dt' => 'name' ),

            array( 'db' => 'mobile',  'dt' => 'mobile' ),

            array(

                'db'        => 'created_at',

                'dt'        => 'created_at',

                'formatter' => function( $d, $row ) {

                    return date( 'jS M y', strtotime($d));

                }
            )
        );
        if($_SERVER['HTTP_HOST']=='localhost'){
            $sql_details = array(

                'user' => 'root',

                'pass' => '',

                'db'   => 'microsite',

                'host' => 'localhost'

            );
        }
        else{
            $sql_details = array(

                'user' => 'npab',

                'pass' => 'pigeon2019',

                'db'   => 'npab_microsite',

                'host' => 'npab.net'

            );
        }
        

        // require( 'public/Jquerydatatables/ssp.class.php' );
        require( 'app/ssp.class.php' );
        // echo json_encode(
        // dd($type);
        $result =  SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);

        $start=$_REQUEST['start']+1;

        $idx=0;

        foreach($result['data'] as &$res){

            $res[0]=(string)$start;

            $start++;

            $idx++;

            // $res['post_content']=html_entity_decode($res['post_content']);

        }
        echo json_encode($result);

    }


    public function getPatients(Request $request){
        // $where = " WHERE 1=1";
        
        // if ($request->input('from_date')){
        //     $where .= " AND date>='".$request->input('from_date')."'";
        // }
        
        // if ($request->input('to_date')){
        //     $where .= " AND date<='".$request->input('to_date')."'";
        // }
        
        // if(Auth::user()->type==2){
        //     $where .= " AND stores.territorry_id='".Auth::user()->territorry_id."'";
        // }
        // if(Auth::user()->type==4){
        //     $where .= " AND stores.zone_id='".Auth::user()->zone_id."'";
        // }

        // if ($request->input('store_code')){
        //     $where .= " AND store_code='".$request->input('store_code')."'";
        // }

        // if ($request->input('store_name')){
        //     $where .= " AND store_name='".$request->input('store_name')."'";
        // }

        // if ($request->input('plot_no')){
        //     $where .= " AND plot_no='".$request->input('plot_no')."'";
        // }

        // if ($request->input('mobilenumber')){
        //     $where .= " AND mobilenumber='".$request->input('mobilenumber')."'";
        // }

        // if ($request->input('town_id')){
        //     $where .= " AND stores.town_id='".$request->input('town_id')."'";
        // }

        // if ($request->input('zone_id')){
        //     $where .= " AND stores.zone_id='".$request->input('zone_id')."'";
        // }

        // if ($request->input('territorry_id')){
        //     $where .= " AND stores.territorry_id='".$request->input('territorry_id')."'";
        // }

        // if ($request->input('bdo_name')){
        //     $where .= " AND bdo_name='".$request->input('bdo_name')."'";
        // }

        
        $table = 
            "(
                SELECT *From patients order by patients.id desc
            ) testtable";


        $primaryKey = 'id';



        $columns = array(

            array( 'db' => 'id',  'dt' => 'id' ),

            array( 'db' => 'unique_id', 'dt' => 'unique_id' ),

            array( 'db' => 'assigned_chamber',  'dt' => 'assigned_chamber' ),

            array( 'db' => 'name', 'dt' => 'name' ),

            array( 'db' => 'age',  'dt' => 'age' ),

            array( 'db' => 'gender',  'dt' => 'gender' ),

            array( 'db' => 'marrital_status',  'dt' => 'marrital_status' ),

            array( 'db' => 'phone',  'dt' => 'phone' ),

            array( 'db' => 'address',  'dt' => 'address' ),

            array(

                'db'        => 'created_at',

                'dt'        => 'created_at',

                'formatter' => function( $d, $row ) {

                    return date( 'jS M y', strtotime($d));

                }
            )
        );
        if($_SERVER['HTTP_HOST']=='localhost'){
            $sql_details = array(

                'user' => 'root',

                'pass' => '',

                'db'   => 'smile',

                'host' => 'localhost'

            );
        }
        else{
            $sql_details = array(

                'user' => 'npab',

                'pass' => 'pigeon2019',

                'db'   => 'npab_smile',

                'host' => 'npab.net'

            );
        }
        

        // require( 'public/Jquerydatatables/ssp.class.php' );
        require( 'app/ssp.class.php' );
        // echo json_encode(
        // dd($type);
        $result =  SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);

        $start=$_REQUEST['start']+1;

        $idx=0;

        foreach($result['data'] as &$res){

            $res[0]=(string)$start;

            $start++;

            $idx++;

            // $res['post_content']=html_entity_decode($res['post_content']);

        }

        echo json_encode($result);

    }


    public function doctorEdit($id){
        $doctor =   DB::table('doctors')
                    ->join('uniqueids','doctors.id','=','uniqueids.doctor_id')
                    ->where(['doctors.id' => $id])
                    ->get();
        // dd($doctor);
        return view('doctoredit')->with('doctor',$doctor)->with('id',$id);
    }

    public function updatedoctor(Request $request){
        $start_range = $request->uniqueid['start_range'];
        $end_range = $request->uniqueid['end_range'];
        $count = count($start_range);
        $idList = [];
        for($k=0;$k<$count;$k++){
            $array = [$start_range[$k], $end_range[$k]];
            array_push($idList, $array);
        }
        $i = 0;
        $check = 0;
        foreach($idList as $uniqueID){
            $j = 0;
            foreach($idList as $newuniqueID){
                if($i!=$j){
                    if($uniqueID[0]>=$newuniqueID[0] && $uniqueID[0]<=$newuniqueID[1]){
                        $message = "Overlapping Range1";
                        $check =1;
                        break;
                    }
                    if($uniqueID[1]>=$newuniqueID[0] && $uniqueID[1]<=$newuniqueID[1]){
                        $message = "Overlapping Range";
                        $check =1;
                        break;
                    }
                }
                $j++;
            }
            $i++;
        }
        foreach ($idList as $uniqueID) {
            $exist0 = Uniqueid::where('start_range','>=',$uniqueID[0])->where('end_range','<=',$uniqueID[0])->where('uniqueids.doctor_id',"!=",$request->id)->count();
            $exist1 = Uniqueid::where('start_range','>=',$uniqueID[1])->where('end_range','<=',$uniqueID[1])->where('uniqueids.doctor_id',"!=",$request->id)->count();
            // dd($exist0);
            if($exist0>0 || $exist1>0){
                $message = "Range already exists.";
                return Redirect::back()->withInput()->with('message',$message);
            }
        }
        if($check==1){
            return Redirect::back()->withInput()->with('message',$message);
        }
        $doctor = Doctor::find($request->id);
        $doctor->name = $request->name;
        $doctor->bmdc = $request->bmdc;
        $doctor->gender = $request->gender;
        $doctor->chamber_name = $request->chamber_name;
        $doctor->phone = $request->phone;
        $doctor->chamber_address = $request->chamber_address;
        $doctor->save();
        $p = 0;

        Uniqueid::where('doctor_id',$request->id)->delete();
        foreach ($idList as $list) {
            $Uniqueid = new Uniqueid();
            $Uniqueid->doctor_id = $doctor->id;
            $Uniqueid->start_range = $list[0];
            $Uniqueid->end_range = $list[1];
            $Uniqueid->save();
            $p++;
        }
        return redirect('admin/doctor/index');
    }
    public function doctorDelete($id){
        $doctor = Doctor::where('id',$id)->delete();
        Uniqueid::where('doctor_id',$id)->delete();
    }

    public function logout(){
        Session::flush();
        // Log out
        Auth::logout();
        return redirect()->intended('login');
    }

    public function userAdd(Request $request){
        return view('useradd');
    }

    public function userList(Request $request){
        return view('userlist');
    }

    public function userEdit($id){
        $user = User::where('id',$id)->first();
        return view('useredit')->with('user',$user);
    }

    public function userSave(Request $request){
        if($request->password!=$request->confirm_password){
            return Redirect::back()->withInput()->with('password_mismatch', "Passwords do not match");
        }
        $checkUser = User::where('name',$request->name)->get();
        if(count($checkUser)>0){
            return Redirect::back()->withInput()->with('password_mismatch', "Username already exists.");
        }
        
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->password_real = $request->password;
        $user->type = $request->type;
        $user->save();
        return redirect('admin/user/index');
    }

    public function updateuser(Request $request){
        $checkUser = User::where('name',$request->name)->where('id','!=',$request->id)->get();
        if(count($checkUser)>0){
            return Redirect::back()->withInput()->with('password_mismatch', "Username already exists.");
        }
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->type = $request->type;
        $user->save();
        return redirect('admin/user/index');
    }

    public function getUsers(){
        
        $table = "users";

        $table = "(select *from users) testtable";



        $primaryKey = 'id';

        // $table = "(".$query.") testtable";

        $primaryKey = 'id';
        $columns = array(
            array( 'db' => 'id',  'dt' => 'id' ),
            array( 'db' => 'name', 'dt' => 'name' ),
            array( 'db' => 'email', 'dt' => 'email' ),
            array( 'db' => 'type', 'dt' => 'type' ),
            array(

                'db'        => 'created_at',

                'dt'        => 'created_at',

                'formatter' => function( $d, $row ) {

                    return date( 'jS M y', strtotime($d));

                }
            )
        );
        // $sql_details = array(
        //     'user' => env('DB_USERNAME'),
        //     'pass' => env('DB_PASSWORD'),
        //     'db'   => env('DB_DATABASE'),
        //     'host' => env('DB_HOST')
        // );
        if($_SERVER['HTTP_HOST']=='localhost'){
            $sql_details = array(

                'user' => 'root',

                'pass' => '',

                'db'   => 'smile',

                'host' => 'localhost'

            );
        }
        else{
            $sql_details = array(

                'user' => 'npab',

                'pass' => 'pigeon2019',

                'db'   => 'npab_smile',

                'host' => 'npab.net'

            );
        }
        require(app_path() . '/ssp.class.php');
        $result =  SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);

        $result =  SSP::simple( $_GET, $sql_details, $table, $primaryKey, $columns);
        
        

        // );

        $start=$_REQUEST['start']+1;

        $idx=0;

        foreach($result['data'] as &$res){

            $res[0]=(string)$start;

            $start++;

            $idx++;

            // $res['post_content']=html_entity_decode($res['post_content']);

        }
        echo json_encode($result);


    }

    public function userDelete($id){
        $user = User::where('id',$id)->delete();
    }


   
    public function microsite(){
        return view('microsite');
    }

    public function save(Request $request){
        $person = new Person();
        $person->name = $request->name;
        $person->mobile = $request->mobile;
        $person->save();
        return "success";
    }
 
}
