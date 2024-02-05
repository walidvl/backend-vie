<?php

namespace App\Http\Controllers;

use App\Models\UserSavedBooks;
use App\Http\Requests\StoreUserSavedBooksRequest;
use App\Http\Requests\UpdateUserSavedBooksRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class UserSavedBooksController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function saveBook()
    {

        $user = Auth::user();

        return response()->json(['message' => $user], 200);

    }

    public function unsaveBook($bookId)
    {
        $user = Auth::user();

        $userBook = UserSavedBooks::where('user_id', $user->id)->where('book_id', $bookId);

        if ($userBook->exists()) {
            $userBook->delete();
            return response()->json(['message' => 'Book unsaved successfully.'], 200);
        }

        return response()->json(['message' => 'Book not found.'], 404);
    }
}
