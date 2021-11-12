<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\testCrud;

class TestCrudController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * @OA\Get(
     *     path="/TestCrud",
     *     summary="List all test Crud",
     *     operationId="index",
     *     tags={"test crud"},
     *     @OA\Parameter(
     *         name="include",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="array",
     *             @OA\Items(
     *                 type="string",
     *                 enum = {"user"},
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="An paged array of posts",
     *         @OA\JsonContent(
     *             type="array",
     *             @OA\Items(ref="#/components/schemas/TestCrudResponse")
     *         ),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     */
    public function index(){
        $test = testCrud::all();
        return response()->json($test);
    }

    public function showDetail($id){
        $test = testCrud::find($id);
        if(!$test){
            return response()->json(['msg'=>'data tidak di temukan']);
        }
        return response()->json($test);
    }
    /**
     * @OA\Post(
     *     path="/TestCrud",
     *     summary="New test crud create",
     *     operationId="store",
     *     tags={"Post"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Post object",
     *         @OA\JsonContent(ref="#/components/schemas/testCrudRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="A post",
     *         @OA\JsonContent(ref="#/components/schemas/TestCrudResponse"),
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="unexpected error",
     *         @OA\Schema(ref="#/components/schemas/Error")
     *     )
     * )
     * @param Request $request
     * @return array
     */
    public function create(Request $request){
        $data = $request->all();
        try{
            $test = testCrud::create($data);
            return response()->json(['msg'=>'data berhasil masuk','data'=>$data]);
            
        }
        catch(\Exception $e){
            return response()->json(['msg'=>'error is ='.$e.'']);
            
        }
        
    }
    
    public function update(Request $request,$id){
        $test = testCrud::find($id);
        if(!$test){
            return response()->json(['msg'=>'data tidak di temukan']);
        }
        
        try{
            $this->validate($request,[
                'name'=>'required|unique:testCrud',
                'desc'=>'required'
            ]);

            $data = $request->all();
            $test->fill($data);
            $test->save();
            
            return response()->json(['msg'=>'data berhasil di ubah','data'=>$data]);
        }
        catch(\Exception $e){
            return response()->json(['msg'=>'error is ='.$e.'']);
            
        }
    }   
    
    public function delete($id){
        $test = testCrud::find($id);
        if(!$test){
            return response()->json(['msg'=>'data tidak di temukan']);
        }

        $test->delete();
        return response()->json(['msg'=>'data berhasil di hapus']);
    }


    //
}
