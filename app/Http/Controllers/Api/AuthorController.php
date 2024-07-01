<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Author;

class AuthorController extends Controller
{

    public function index()
    {
        $authors = Author::all();
        return response()->json($authors, 200);
    }

    public function show($id)
    {
        $author = Author::find($id);
        if (!$author) return response()->json(['error' => 'Autor não encontrado'], 404); 
        
        return response()->json($author, 200);
    }
    
    public function create(Request $request){
        
        $rules = [
            'name' => 'required|string',
            'birthday' => 'required'
        ];

        $request->validate($rules);

        try {

            $author = Author::create($request->all());
            if ($author) return response()->json(['success' => 'Autor: '.$author->name.' cadastrado com sucesso!'], 201);

        } catch (\Exception $e){

            return response()->json(['error' => 'Erro ao cadastrar autor: ' . $e->getMessage()], 500);

        }
    }

    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required|string',
            'birthday' => 'required'
        ];

        $request->validate($rules);

        try {

            $author = Author::find($id);
            if (!$author) return response()->json(['error' => 'Autor não encontrado'], 404);

            $author->update($request->all());

            return response()->json(['success' => 'Autor atualizado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar autor: ' . $e->getMessage()], 500);
        }
    }

    public function delete($id)
    {
        try {
            $author = Author::find($id);
            if (!$author) {
                return response()->json(['error' => 'Autor não encontrado'], 404);
            }

            $author->delete();

            return response()->json(['success' => 'Autor deletado com sucesso!'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar autor: ' . $e->getMessage()], 500);
        }
    }

    
}
