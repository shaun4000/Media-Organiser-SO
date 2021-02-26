<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the xml file contents
        $xmlString = file_get_contents(public_path('categories.xml'));
        $categories = simplexml_load_string($xmlString);

        // Pass the xml file contents to the categories view
        return view('categories', compact('categories'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // If validation fails the user will be returned to the previous page
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        // Load the xml file
        $categories = simplexml_load_file(public_path('categories.xml'));

        // Assess the latest ID for a new entry
        $count = count($categories);
        $last_item = $categories->category[$count-1];
        $last_id = (int) $last_item->id;
        $newItemId = $last_id + 1;

        // Insert the new data into the xml file
		$category = $categories->addChild('category');
		$category->addChild('id', $newItemId);
		$category->addChild('name', $request->name);
        file_put_contents(public_path('categories.xml'), $categories->asXML());

        // Return a success message back to the view
        return back()->with('success', 'Category Added Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // If validation fails the user will be returned to the previous page
        $validated = $request->validate([
            'name' => 'required|max:255',
        ]);

        // Load the xml file
        $categories = simplexml_load_file(public_path('categories.xml'));

        // Loop through the categories to find the correct entry and amend the name
		foreach($categories->category as $category){
			if($category->id == $request->id){
				$category->name = $request->name[$request->id];
				break;
			}
		}
		file_put_contents(public_path('categories.xml'), $categories->asXML());

        // Return a success message back to the view
        return back()->with('success', 'Category Edited Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        //Get the id passed from the view
        $id = $request->id;

        // Load the xml file
	    $categories = simplexml_load_file(public_path('categories.xml'));

        // Set variables to 0
	    $index = 0;
	    $i = 0;

        // Loop through each category to find the correct entry
	    foreach($categories->category as $category){
	    	if($category->id == $id){
	    		$index = $i;
	    		break;
	    	}
	    	$i++;
	    }

        // When the correct entry is found, delete it
	    unset($categories->category[$index]);
	    file_put_contents(public_path('categories.xml'), $categories->asXML());

        // Return a success message back to the view
        return back()->with('success', 'Deleted Category Successfully');

    }

}
