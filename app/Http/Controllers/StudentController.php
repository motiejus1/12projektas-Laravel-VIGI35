<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;

class StudentController extends Controller
{
    
    protected $localApiKey;    
    
    
    // public function __construct()
    // {
    //     $this->localApiKey = config('app.localApiKey');

    //     // $request = new Request;
    //     // dd($request->apiToken);
    //     dd($request->apiToken);
    //     if($this->localApiKey != $request->apiToken ) {
        
    //         return response()->json(array(
    //             'error' => 'Neteisingas API raktas'
    //         ));
    //     }
    // }
    


        //Middleware


    public function checkApiCode($request) {
        $this->localApiKey = config('app.localApiKey');
        if($this->localApiKey != $request->apiToken ) {
            return false;
        }
        return true;
    }     

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        // dd($this->checkApiCode($request));
        if(!$this->checkApiCode($request)) {
            return response()->json(array(
                'error' => 'Neteisingas API raktas'
            ));
        };

        $students = Student::all();

        return response()->json(array(
            'students' => $students
        ));

        //return response()->json($students);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if(!$this->checkApiCode($request)) {
            return response()->json(array(
                'error' => 'Neteisingas API raktas'
            ));
        };

        $student = new Student();


        //$_GET arba
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->teacher = $request->teacher;

         $student->save();


        return response()->json(array(
            'success' => 'Sėkmingai kreiptasi į store metodą',
            'student' => $student
            )
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)

    {

        if(!$this->checkApiCode($request)) {
            return response()->json(array(
                'error' => 'Neteisingas API raktas'
            ));
        };

        $student = Student::find($id);

        if(empty($student)) {
            return response()->json(array(
                'error' => 'Studentas nerastas'
            ));
        }

        return response()->json($student);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if(!$this->checkApiCode($request)) {
            return response()->json(array(
                'error' => 'Neteisingas API raktas'
            ));
        };

        $student = Student::find($id);
        $student->name = $request->name;
        $student->surname = $request->surname;
        $student->email = $request->email;
        $student->phone = $request->phone;
        $student->teacher = $request->teacher;

         $student->save();

         return response()->json(array(
            'success' => 'Sėkmingai kreiptasi į update metodą',
            'student' => $student
            )
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


     //Student $student

     //$id

     // ReactJs karkasui perduodam Student objekta. OBjekto nesupras
     // AJAX uzklausa. AJAX uzklausa supranta tik id.
     // (AJAX ir HTML- blade failus) - musu frontend karkasas
     //LAravel metodus  - backend API
    public function destroy(Request $request, $id)
    {


        if(!$this->checkApiCode($request)) {
            return response()->json(array(
                'error' => 'Neteisingas API raktas'
            ));
        };

        $student = Student::find($id);
        $student->delete();

        return response()->json(array(
            'success' => 'Sėkmingai kreiptasi į destroy metodą',
            'id' => $id
            )
        );
    }

    //Kaip mes turime karkasa
    // Controleris Modelis Vaizdas(internetines svetaines, aplikacijas telefonui, kazkokias programas)
    // Resources Modelis Vaizdas(modulius)
    // Resources - universali programinio kodo dalis kuria mes galime isiterpti bet kur projekte ir bet kuriame projekte 
}
