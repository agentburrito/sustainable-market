<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;

class ListingController extends Controller
{
    protected $imageManager; 

    public function __construct(ImageManager $imageManager)
    {
        $this->imageManager = $imageManager;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('listings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('parent_id', '!=', NULL)->with('parent')->get();
        return view('listings.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        

        $this->validate($request, [
            'organization_name' => 'sometimes|required',
            'title'             => 'required|min:3|max:255|string',
            'price'             => 'sometimes|required|numeric', 
            'contact'           => 'required|min:10|max:20|string', 
            'location'          => 'required|string', 
            'description'       => 'required|string',
            'category'          => 'required' 
        ]);

        $path = NULL; 

        if($request->image != null) {
            $processedImage = $this->imageManager->make($request->file('image')->getPathName())
                ->encode('png')
                ->save(public_path('uploads/images/listings/' . $filename = uniqid(true) . '.png'));
        
            $path = '/uploads/images/listings/'.$filename; 
        }

        $wanted = false; 
        $org_id = NULL;

        if(($request->get('wanted') != NULL)) {
            $wanted = true; 
            $org_id = Auth::user()->organizations->first()->id;
        }

        Listing::create([
            'user_id' => $request->user()->id,
            'category_id' => $request->get('category'),
            'title' => $request->get('title'),
            'price' => $request->get('price'),
            'phone' => $request->get('contact'),
            'location' => $request->get('location'),
            'description' => $request->get('description'),
            'image' => $path, 
            'wanted' => $wanted,
            'organization_id' => $org_id
        ]);

        return redirect()->route('category.show', Category::where('id', $request->get('category'))->first())->withSuccess('Your listing has been created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Listing $listing)
    {
        return view('listings.show', compact('listing'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
