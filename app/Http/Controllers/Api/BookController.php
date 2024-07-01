<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Book, Author};

class BookController extends Controller
{
    public function index()
    {
        try {
            $books = Book::with('authors')->get();
            return response()->json($books);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao recuperar livros'], 500);
        }
    }
    
    public function create(Request $request)
    {
        try {
            $book = new Book();
            $book->title = $request->input('title');
            $book->publication_year = $request->input('publication_year');
            $book->save();

            $authors = $request->input('authors');
            if($authors){
                $bookAuthorIds = [];
                foreach ($authors as $author) {
                    $authorModel = Author::where('name', $author)->first();
                    if ($authorModel) {
                        $bookAuthorIds[] = $authorModel->id;
                    } else {
                        throw new \Exception("Autor: '$author' não encontrado");
                    }
                }
                $book->authors()->sync($bookAuthorIds);
            }

            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao criar livro: ' . $e->getMessage()], 500);
        }
    }
    
    public function show($id)
    {
        try {
            $book = Book::with('authors')->find($id);
            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao recuperar livro'], 404);
        }
    }
    
    public function update(Request $request, $id)
    {
        try {
            $book = Book::find($id);
            $book->title = $request->input('title');
            $book->publication_year = $request->input('publication_year');
            $book->save();

            $authors = $request->input('authors');
            if($authors){
                $bookAuthorIds = [];
                foreach ($authors as $author) {
                    $authorModel = Author::where('name', $author)->first();
                    if ($authorModel) {
                        $bookAuthorIds[] = $authorModel->id;
                    } else {
                        throw new \Exception("Autor: '$author' não encontrado");
                    }
                }
                
                $book->authors()->sync($bookAuthorIds);
            }

            return response()->json($book);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao atualizar livro. ' .$e], 500);
        }
    }
    
    public function delete($id)
    {
        try {
            $book = Book::find($id);
            $book->authors()->detach();
            $book->delete();
            return response()->json(['message' => 'Livro deletado com sucesso']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Erro ao deletar livro'], 500);
        }
    }
}
