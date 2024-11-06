<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Services\TaskServices;
use Illuminate\Support\Facades\DB;

class TareasController extends Controller
{
    public function index()
    {
        return DB::table('task')->where('idEstado','=',1)->get();
    }
    public function store(Request $request)
    {

        try{
            DB::beginTransaction();
            (new Task)->validar($request->all());
            $services = new TaskServices;
            $p = $services->crear($request->all());
           

           
            $task = Db::table('task')->where('id','=',$p)->first();
            Db::commit();
            return response()->json(['message'=> 'Tarea agregada correctamente','task'=> $task],200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['Error'=> $e->getMessage()],400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return DB::table('task')->where('id','=',$id)->first();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {

        try{
            DB::beginTransaction();
            (new Task)->validar($request->all());
            $services = new TaskServices;
            $p = $services->update($id,$request->all());
            $task = DB::table('task')->where('id','=',$id)->first();
            Db::commit();
            return response()->json(['message'=> 'Tarea actualizada correctamente','task'=> $task],200);
        }
        catch(\Exception $e){
            DB::rollBack();
            return response()->json(['Error'=> $e->getMessage()],400);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $task =  DB::table('task')->where('id','=',$id)->update(
            [
                'idEstado'=> 0,
            ]
        );
        return response()->json(['message'=> 'Tarea eliminada correctamente'],200);
    }
}
