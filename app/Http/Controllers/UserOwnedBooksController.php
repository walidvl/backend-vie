<?php

namespace App\Http\Controllers;

use App\Models\UserOwnedBooks;
use App\Http\Requests\StoreUserOwnedBooksRequest;
use App\Http\Requests\UpdateUserOwnedBooksRequest;

class UserOwnedBooksController extends Controller
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserOwnedBooksRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserOwnedBooks $userOwnedBooks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserOwnedBooks $userOwnedBooks)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserOwnedBooksRequest $request, UserOwnedBooks $userOwnedBooks)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserOwnedBooks $userOwnedBooks)
    {
        //
    }
}
