<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{


    public function images()
    {
        // Retrieve all image records from the Image model
        $images = Image::all();

        // Initialize an empty array to store the response data
        $response = [];

        // Loop through each image record
        foreach ($images as $image) {
            // Construct the full URL to the image using the image name
            $url = asset(Storage::url('public/books/' . $image->image));

            // Create an array containing image URL and additional data
            $imageData = [
                'file' => $url,
                'title' => $image->title,
                'filter' => $image->filter,
                'bookoption' => $image->bookoption
            ];

            // Add the image data to the response array
            $response[] = $imageData;
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

        $book = new Image([
            'title' => $request->input('title'),
            'filter' => $request->input('filter'),
            'bookoption' => $request->input('bookoption'),
            'image' => $request->input('image'), // Store the image name
        ]);

        // Save the book record to the database
        $book->save();

        return response()->json(['message' => 'Book information saved successfully']);
    }
}
