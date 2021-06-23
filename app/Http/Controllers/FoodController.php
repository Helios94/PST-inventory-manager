<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFoodRequest;
use App\Http\Resources\FoodResource;
use App\Models\Food;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        if($this->authorize('viewAny', Food::class)) {
//            return FoodResource::collection(Food::paginate(1))->preserveQuery();
            return FoodResource::collection(Food::all())->preserveQuery();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFoodRequest $request)
    {
        if($this->authorize('store', Food::class)){
            $newFoodItem = new Food();
            $newFoodItem->name = $request->input('name');
            $newFoodItem->category_id = $request->input('category_id');
            $newFoodItem->image = $request->input('image');
            $newFoodItem->barcode = $request->input('barcode');
            $newFoodItem->qrcode_path = $request->input('qrcode_path');
            $newFoodItem->description = $request->input('description');
            $newFoodItem->expiry_date = $request->input('expiry_date');
            $newFoodItem->quantity = $request->input('quantity');
            $newFoodItem->price = $request->input('price');
            $newFoodItem->user_id = $request->input('user_id');
            $newFoodItem->shareable = $request->input('shareable');
            $newFoodItem->storage_id = $request->input('storage_id');
            $newFoodItem->unit_id = $request->input('unit_id');

            return response()->json($newFoodItem);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param int $id
     * @return FoodResource
     */
    public function show($id)
    {
        if($this->authorize('view', Food::find($id))){
            return new FoodResource(Food::findOrFail($id));
        }
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

    public function qrCodePicture($id)
    {
        $foodItem = Food::findOrFail($id);
        $qrFileName = $foodItem->barcode.'.png';
        QrCode::size(200)
            ->format('png')
            ->generate($foodItem->barcode, $picPath= storage_path('app/public/QR/'.$qrFileName));

        $responseData = [
            'id' => $id,
            'QRCodeImg' => $picPath
        ];
//        return response()->json($responseData);
        return response()->file($picPath);
    }
}
