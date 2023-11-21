<?php

namespace App\Http\Controllers;

use App\Models\Drive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DriveController extends Controller
{
    public function __construct()
    {
        $this -> middleware('auth');
    }

    public function myFiles()
    {
        $user_id =auth()->id() ;
        $drives = Drive::where('user_id','=',$user_id)->get();
        return view('drives.myFiles',compact("drives"));
    }
    public function changeStatus(Request $request, $id)
    {
        // Find the Drive record by ID
        $drive = Drive::findOrFail($id);
        if( $drive->status == 'public'){
            $drive->status = 'private';
        }else{
            $drive->status = 'public';}

        // Save the Drive instance to the database
        $drive->save();

        // Redirect back with a success message
        return redirect()->route('drives.myFiles')->with('success', 'File updated successfully.');
    }


    public function index()
    {
        $drives = Drive::all();
        return view('drives.index',compact("drives"));
    }

    public function notFoundPage()
    {
        return view('notFoundPage');
    }

    public function create()
    {
        return view('drives.create');
    }


public function store(Request $request)
{
    // Validate the form data
    $request->validate([
        'title' => 'required|string|max:200',
        'description' => 'required|string|max:300',
        'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Example: allow only pdf, doc, and docx files with a maximum size of 10MB
    ]);

    // Check if a file is present before processing it
    if ($request->hasFile('file')) {
        // Handle the file upload
        $file = $request->file('file');
        $fileName = time() . $file->getClientOriginalName();
        $filePath = public_path('./upload/' . $fileName);
        $file->move(public_path('./upload'), $fileName);

        // Get file extension
        $fileExtension = $file->getClientOriginalExtension();

        // Create a new Drive instance and fill it with the form data
        $drive = new Drive([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'file' => $fileName,
            'status' => $request->input('status'),
            'user_id' => auth()->id(), // Assuming you are using user authentication
            'extension' => $fileExtension,
        ]);

        // Save the Drive instance to the database
        $drive->save();

        // Redirect back with a success message
        return redirect()->route('drives.myFiles')->with('success', 'File created successfully.');
    }

    // If no file is present, you may want to handle this case accordingly
    return redirect()->back()->with('error', 'Please select a file.');
}




    // public function show($id)
    // {
    //     $drive =Drive::find($id);
    //     return view('drives.show', compact('drive'));
    // }

    public function show($id)
    {
        $drive = DB::table('usersdrivesview')->where('driveID', $id)->first();
        return view('drives.show', compact('drive'));
    }


    public function edit($id)
    {
        $drive = Drive::find($id);
        return view('drives.edit', compact('drive'));
    }

    public function update(Request $request, $id)
    {
        // Validate the form data
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'nullable|string|max:300',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:10240', // Example: allow only pdf, doc, and docx files with a maximum size of 10MB
            'status' => 'required|in:private,public', // Ensure the status is either private or public
        ]);

        // Find the Drive record by ID
        $drive = Drive::findOrFail($id);

        // Handle the file upload if a new file is provided
        if ($request->hasFile('file')) {
            $file = $request->file('file');

            // Delete the old file
            $oldFilePath = public_path('./upload/' . $drive->file);
            if (file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Upload the new file
            $fileName = time() . $file->getClientOriginalName();
            $filePath = public_path('./upload/' . $fileName);
            $file->move(public_path('./upload'), $fileName);

            // Update the file and extension in the database
            $drive->file = $fileName;
            $drive->extension = $file->getClientOriginalExtension();
        }


        // Update other fields
        $drive->title = $request->input('title');
        $drive->description = $request->input('description');
        $drive->status = $request->input('status');

        // Save the Drive instance to the database
        $drive->save();

        // Redirect back with a success message
        return redirect()->route('drives.index')->with('success', 'File updated successfully.');
    }



    public function destroy($id)
    {
        $drive = Drive::find($id);
        $filepath = public_path("/upload/$drive->file");
        unlink($filepath);
        $drive->delete();
        return redirect()->route('drives.index')->with('success', 'File Deleted successfully.');
    }
}
