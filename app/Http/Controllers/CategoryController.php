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
        $xmlString = file_get_contents(public_path('categories.xml'));
        $categories = simplexml_load_string($xmlString);
        // dd($xmlObject);
        // $json = json_encode($xmlObject);
        // $categories = json_decode($json, true);
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
        $categories = simplexml_load_file(public_path('categories.xml'));

        $count = count($categories);
        $last_item = $categories->category[$count-1];
        $last_id = (int) $last_item->id;
        $newItemId = $last_id + 1;

		$category = $categories->addChild('category');
		$category->addChild('id', $newItemId);
		$category->addChild('name', $request->name);
        file_put_contents(public_path('categories.xml'), $categories->asXML());

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
        $categories = simplexml_load_file(public_path('categories.xml'));
		foreach($categories->category as $category){
			if($category->id == $request->id){
				$category->name = $request->name[$request->id];
				break;
			}
		}
		file_put_contents(public_path('categories.xml'), $categories->asXML());

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
    $id = $request->id;

	$categories = simplexml_load_file(public_path('categories.xml'));

	//we're are going to create iterator to assign to each user
	$index = 0;
	$i = 0;

	foreach($categories->category as $category){
		if($category->id == $id){
			$index = $i;
			break;
		}
		$i++;
	}

	unset($categories->category[$index]);
	file_put_contents(public_path('categories.xml'), $categories->asXML());

    return back()->with('success', 'Deleted Category Successfully');

    }

}
