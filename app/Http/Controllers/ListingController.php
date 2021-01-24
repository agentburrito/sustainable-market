<?php

namespace App\Http\Controllers;

use Stripe\Stripe;
use App\Models\Listing;
use App\Models\Category;
use App\Events\ItemPurchase;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Event;
use Illuminate\Notifications\Messages\MailMessage;


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
            'organization_id'   => 'sometimes|required',
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

        if(($request->get('organization_id') != NULL)) {
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
    public function edit(Listing $listing)
    {
        $categories = Category::where('parent_id', '!=', NULL)->with('parent')->get();
        return view('listings.edit', compact('listing', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function update(Request $request, Listing $listing)
    {
        $this->validate($request, [
            'organization_name' => 'sometimes|required',
            'organization_id'   => 'sometimes|required',
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

        $listing->update([
            'category_id' => $request->get('category'),
            'title' => $request->get('title'),
            'price' => $request->get('price'),
            'phone' => $request->get('contact'),
            'location' => $request->get('location'),
            'description' => $request->get('description'),
            'image' => $path, 
        ]);

        return redirect()->route('listing.show', $listing)->withSuccess('Your listing has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Listing $listing)
    {
        $listing->delete(); 

        return redirect()->route('welcome')->withSuccess('Your listing has been deleted successfully!');

    }

    public function purchase(Listing $listing, Request $request)
    {
        \Stripe\Stripe::setApiKey('sk_test_2Fxm5RuasGLd6rMHQYhgnJnu');

        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
              'price_data' => [
                'currency' => 'usd',
                'product_data' => [
                'name' => $listing->title,
            ],
            'unit_amount' => $listing->price*100,
            ],
            'quantity' => 1,
        ]],
        'mode' => 'payment',
        'success_url' => 'http://market.test/listing/' . $listing->id . '/purchase/complete',
        'cancel_url' => 'http://market.test/listing/' . $listing->id,
        ]);

        return response([ 'id' => $session->id ], 200);
    }

    public function complete(Listing $listing, Request $request) 
    {
        $title = $listing->title; 
        $user = $listing->user; 

        // $mail = (new MailMessage)
        //                ->line('Your item has been purchased!')
        //                ->line($listing->title)
        //                ->action('Login Now', url('/login'));

        $category = $listing->category;

        $listing->delete(); 

        return redirect()->route('category.show', $category)->withSuccess('You have successfully bought: ' . $title);
    }
}
