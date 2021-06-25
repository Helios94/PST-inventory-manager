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
//        $validated = $request->validated();
//        return response()->json($validated);

        if($this->authorize('create', Food::class)){
            $newFoodItem = new Food();
            $newFoodItem->name = $request->input('name');
            $newFoodItem->category_id = $request->input('category_id');

            // IMAGE UPLOAD TO PUBLIC DISK
            $imgUploadPath = $request->file('image')->store(
                '', 'public'
            );
            $newFoodItem->image = $imgUploadPath;

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
            $newFoodItem->save();

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
        // RETURNS HTML (USE UPDATE TO UPDATE)
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreFoodRequest $request, $id)
    {
        $validated = $request->validated();
        return response()->json($validated);

        if($this->authorize('update', $foodItem = Food::find($id))){
            $foodItem->name = $request->input('name');
            $foodItem->category_id = $request->input('category_id');

            // IMAGE UPLOAD TO PUBLIC DISK
            $imgUploadPath = $request->file('image')->store(
                '', 'public'
            );
            $foodItem->image = $imgUploadPath;

            $foodItem->barcode = $request->input('barcode');
            $foodItem->qrcode_path = $request->input('qrcode_path');
            $foodItem->description = $request->input('description');
            $foodItem->expiry_date = $request->input('expiry_date');
            $foodItem->quantity = $request->input('quantity');
            $foodItem->price = $request->input('price');
            $foodItem->user_id = $request->input('user_id');
            $foodItem->shareable = $request->input('shareable');
            $foodItem->storage_id = $request->input('storage_id');
            $foodItem->unit_id = $request->input('unit_id');

            if ($foodItem->save()){
                return response()->json([
                    'data' => $foodItem,
                    'message' => 'Updated'
                ]);
            }else{
                return response()->json([
                    'message' => 'An error has occured'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($this->authorize('delete', $foodItem = Food::find($id))){
            if($foodItem->delete()) {
                return response()->json([
                    'message' => 'Deleted'
                ]);
            }else{
                return response()->json([
                    'message' => 'An error has occured'
                ]);
            }
        }
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
