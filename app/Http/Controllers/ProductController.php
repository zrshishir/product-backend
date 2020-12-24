<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

class ProductController extends Controller
{
    private $helping;

    public function __construct()
    {
        $this->helping = new Helper();
    }

    public function index()
    {
        $datas = Product::with('user')->get();
        // $datas['url'] = url('/api');
        return response()->json(count($datas) > 0 ? $this->helping->indexData($datas) : $this->helping->noContent());
    }

    public function store(Request $request)
    {
        if (request('id')) return $this->update($request, request('id'));
        
        
        $validator = Validator::make($request->all(), [
            'title'  => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->helping->validatingErrors($validator->errors()->first()));
        }

        $imageName = $this->processImage($request->image);  
        
        $input = $request->all();
        $input['image'] = $imageName;
        $input['user_id'] = auth()->user()->id;
        
        try {
            $data = Product::query()->create([
                'user_id' => auth()->user()->id,
                'title' => $input['title'],
                'description' => $input['description'],
                'price' => $input['price'],
                'image' => $input['image']
            ]);
            if($data){
                $products = Product::with('user')->get();
                // $products['url'] = url('/api');
                return response()->json($this->helping->savingData($products));
            }
        } catch (\Exception $e) {
            return response()->json($this->helping->serverError());
        }
    }

    public function update(Request $request, $id)
    {
        $dtExist = Product::find($id);
        	
        if(! $dtExist){
            return response()->json($this->helping->invalidEditId());
        }

        $validator = Validator::make($request->all(), [
            'title'  => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            // 'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->helping->validatingErrors($validator->errors()->first()));
        }

        $input = $request->all();
        
        $imageName = $this->processImage($request->image);
        $input['image'] = $imageName;
        
        try {
            $data = Product::where('id', $id)->update([
                'user_id' => auth()->user()->id,
                'title' => $input['title'],
                'description' => $input['description'],
                'price' => $input['price'],
                'image' => $input['image']
            ]);
            if($data){
                $products = Product::with('user')->get();
                // $products['url'] = url('/api');
                return response()->json($this->helping->savingData($products));
            }
        } catch (\Exception $e) {
            return response()->json($this->helping->serverError());
        }
    }

    public function destroy($id)
    {
        $products = Product::with('user')->get();
        if(! is_numeric($id)){
            return response()->json($this->helping->notNumeric($products));
        }
        
        try {
            $data = Product::query()->findOrFail($id);
            $data->delete();
            $products = Product::with('user')->get();
            // $products['url'] = url('/api');
            return response()->json($this->helping->deletingData($products));
        } catch (\Exception $e) {
            return response()->json($this->helping->invalidDeleteId($products));
        }
    }

    public function processImage($imageString){
        
        if(substr($imageString, -4, 4) == ".png" || substr($imageString, -5, 5) == ".jpeg"){
            return $imageString;
        }
        if($imageString){
            $image = $imageString;
            $photo = substr($image, strpos($image, ",")+1);
            //decode base64 string
            $image = base64_decode($photo);
            
            $imageName = microtime(true) . '.' . 'png';
            $path = '/images/' . $imageName;
            // $path = "http://image-storage.shadhinapp.com/public/imports/documents/" . $imageName;
            // file_put_contents($path, $image);
            Storage::disk('local')->put($path, $image);
            return $imageName;
        }
        return null;
    }
}
