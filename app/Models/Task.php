<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'completed',
    ];

    public function validar($request)
    {
         $validacion = Validator::make($request,[
            'title'=> 'required|max:250',
            'description'=> 'required|max:500',
            'completed'=> 'required',
            'due_date'=> 'date|before:today'
         ],[
            'title.required'=> 'El tiene que titulo debe ser requerido',
            'title.max'=> 'El titulo no puedo tener mas de 255 que titulo debe ser requerido',
            'description.required'=> 'El campo description debe de ser requerido',
            'description.max'=> 'El campo description debe de ser requerido',
            'completed.required'=> 'El campo completed debe de ser requerido',
            'due_date.date'=> 'El campo due_date debe de ser requerido',
            'due_date.before'=> 'Debe de ser una fecha anterior o de hoy',
         ]);

         if($validacion->fails())
         {
            throw new ValidationException($validacion);
         }
    }
    
}
