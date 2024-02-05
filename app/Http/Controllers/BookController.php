<?php

namespace App\Http\Controllers;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
class BookController extends Controller
{

    public function books()
    {
        // Retrieve all book records from the book model
        $books = Book::all();

        // Initialize an empty array to store the response data
        $response = [];

        // Loop through each book record
        foreach ($books as $book) {
            // Construct the full URL to the book using the book name
            $url = asset(Storage::url('public/books/' . $book->image));
            // Create an array containing book URL and additional data
            $bookData = [
                'id'=>$book->id,
                'file' => $url,
                'title' => $book->title,
                'filter' => $book->filter,
                'bookoption' => $book->bookoption
            ];

            // Add the book data to the response array
            $response[] = $bookData;
        }

        return response()->json(['message' => 'Files retrieved successfully', 'files' => $response]);
    }


    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $files = $request->file('file');
            $response = [];

            foreach ($files as $file) {
                // Generate a unique filename while keeping the original file extension
                $filename = $file->getClientOriginalName();

                // Store the file in the public/storage/books directory
                $path = $file->storeAs('public/books', $filename);

                // Remove 'public/' from the stored path


                // For now, you can return the original filename and the path
                $response[] = ['original_filename' => $file->getClientOriginalName(), 'path' => $path];
            }

            return response()->json(['message' => 'Files uploaded successfully', 'files' => $response]);
        }

        return response()->json(['message' => 'No files to upload'], 400);
    }

    public function uploaddata(Request $request)
    {
        // Validate the incoming request data for title, filter, and bookoption
        $request->validate([
            'title' => 'required|string',
            'filter' => 'required|string',
            'bookoption' => 'required|string',
            'image' => 'required|string', // Assuming 'image' is the name of the uploaded image
        ]);

        // Create a new Book model instance

        $book = new Book([
            'title' => $request->input('title'),
            'filter' => $request->input('filter'),
            'bookoption' => $request->input('bookoption'),
            'image' => $request->input('image'), // Store the image name
        ]);

        // Save the book record to the database
        $book->save();

        return response()->json(['message' => 'Book information saved successfully']);
    }



    public function search(Request $request)
    {
        $query = $request->input('query');
        $searchTerms = explode(' ', $query);

        $books = Book::where(function ($query) use ($searchTerms) {
            foreach ($searchTerms as $term) {
                $query->orWhere('title', 'like', '%' . $term . '%')
                    ->orWhereJsonContains('keywords', $term);
            }
        })->get();

        foreach ($books as $book) {
            // Construct the full URL to the book using the book name
            $url = asset(Storage::url('public/books/' . $book->image));
            // Create an array containing book URL and additional data
            $bookData = [
                'id'=>$book->id,
                'file' => $url,
                'title' => $book->title,
                'filter' => $book->filter,
                'bookoption' => $book->bookoption
            ];

            // Add the book data to the response array
            $response[] = $bookData;
        }
        return response()->json(['message' => 'Files retrieved successfully', 'files' => $response]);
    }

}
