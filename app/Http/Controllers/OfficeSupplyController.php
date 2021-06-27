<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOfficeSupplyRequest;
use App\Http\Resources\OfficeSupplyResource;
use App\Models\OfficeSupply;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class OfficeSupplyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        if($this->authorize('viewAny', OfficeSupply::class)) {
            return OfficeSupplyResource::collection(OfficeSupply::all())->preserveQuery();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreOfficeSupplyRequest $request)
    {
        if($this->authorize('create', OfficeSupply::class)){
            $newOfficeSupplyItem = new OfficeSupply();
            $newOfficeSupplyItem->name = $request->input('name');
            $newOfficeSupplyItem->category_id = $request->input('category_id');

            // IMAGE UPLOAD TO PUBLIC DISK
            $imgUploadPath = $request->file('image')->store(
                '', 'public'
            );
            $newOfficeSupplyItem->image = $imgUploadPath;

            $newOfficeSupplyItem->barcode = $request->input('barcode');
            $newOfficeSupplyItem->qrcode_path = $request->input('qrcode_path');
            $newOfficeSupplyItem->description = $request->input('description');
            $newOfficeSupplyItem->expiry_date = $request->input('expiry_date');
            $newOfficeSupplyItem->quantity = $request->input('quantity');
            $newOfficeSupplyItem->price = $request->input('price');
            $newOfficeSupplyItem->user_id = $request->input('user_id');
            $newOfficeSupplyItem->shareable = $request->input('shareable');
            $newOfficeSupplyItem->storage_id = $request->input('storage_id');
            $newOfficeSupplyItem->unit_id = $request->input('unit_id');
            $newOfficeSupplyItem->save();

            return response()->json($newOfficeSupplyItem);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return OfficeSupplyResource
     */
    public function show($id)
    {
        if($this->authorize('view', $officeSupplyItem = OfficeSupply::find($id))){
            return new OfficeSupplyResource($officeSupplyItem);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(StoreOfficeSupplyRequest $request, $id)
    {
        if($this->authorize('update', $officeSupplyItem = OfficeSupply::find($id))){
            $officeSupplyItem->name = $request->input('name');
            $officeSupplyItem->category_id = $request->input('category_id');

            // IMAGE UPLOAD TO PUBLIC DISK
            $imgUploadPath = $request->file('image')->store(
                '', 'public'
            );
            $officeSupplyItem->image = $imgUploadPath;

            $officeSupplyItem->barcode = $request->input('barcode');
            $officeSupplyItem->qrcode_path = $request->input('qrcode_path');
            $officeSupplyItem->description = $request->input('description');
            $officeSupplyItem->expiry_date = $request->input('expiry_date');
            $officeSupplyItem->quantity = $request->input('quantity');
            $officeSupplyItem->price = $request->input('price');
            $officeSupplyItem->user_id = $request->input('user_id');
            $officeSupplyItem->shareable = $request->input('shareable');
            $officeSupplyItem->storage_id = $request->input('storage_id');
            $officeSupplyItem->unit_id = $request->input('unit_id');

            if ($officeSupplyItem->save()){
                return response()->json([
                    'data' => $officeSupplyItem,
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
     * @param  \App\Models\OfficeSupply  $officeSupply
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        if($this->authorize('delete', $officeSupplyItem = OfficeSupply::find($id))){
            if($officeSupplyItem->delete()) {
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
        $officeSupplyItem = OfficeSupply::findOrFail($id);
        $qrFileName = $officeSupplyItem->barcode.'.png';
        QrCode::size(200)
            ->format('png')
            ->generate($officeSupplyItem->barcode, $picPath= storage_path('app/public/QR/'.$qrFileName));

        $responseData = [
            'id' => $id,
            'QRCodeImg' => $picPath
        ];
        return response()->file($picPath);
    }

    public function getItemByQR($barcode){
        if($officeSupplyByBarcode = OfficeSupply::where('barcode', $barcode)->first()){
            return new OfficeSupplyResource($officeSupplyByBarcode);
        }else{
            return response()->json([
                'message' => 'No Office Supply item with barcode '.$barcode.'was found'
            ]);
        }
    }
}
