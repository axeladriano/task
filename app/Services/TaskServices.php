<?php  

namespace App\Services;

use Illuminate\Support\Facades\DB;

class TaskServices

{
    public function crear($r){

        $task = DB::table('task')->insertGetId([
            'title' =>  $r['title'],
            'description' =>  $r['description'],
            'completed'=> $r['completed'],
            'idEstado'=> 1,
            'due_date'=>  $r['due_date'],
            'created_at'=> now(),
        ]);
        return $task;
    }    

    public function update($id,$r){

        $task = DB::table('task')->where('id',$id)->update([
            'title' =>  $r['title'],
            'description' =>  $r['description'],
            'completed'=> $r['completed'],
            'idEstado'=> 1,
            'due_date'=>  $r['due_date'],
            'created_at'=> now(),
        ]);
        return $task;
    }   
}