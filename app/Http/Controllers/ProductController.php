<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helper\Helper;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use File;

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
        return response()->json(count($datas) > 0 ? $this->helping->indexData($datas) : $this->helping->noContent());
    }

    public function store(Request $request)
    {
        if (request('id')) return $this->update($request, request('id'));

        $validator = Validator::make($request->all(), [
            'title'  => 'required|string',
            'description' => 'string',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
        ]);

        if ($validator->fails()) {
            return response()->json($this->helping->validatingErrors($validator->errors()->first()));
        }

        $imageName = time().'.'.$request->image->extension();  
        $request->image->move(public_path('images'), $imageName);

        $input = $request->all();
        $input['image'] = $imageName;
        $input['user_id'] = auth()->user()->id;

        try {
            $data = Product::query()->create($input);
            if($data){
                $products = Product::with('user')->get();
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
            'image' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($this->helping->validatingErrors($validator->errors()->first()));
        }

        $input = $request->all();
        
        //different image to update
        $imageCheck = File::exists($request->image); 
        if($imageCheck){
            $extensions = ['svg', 'jpeg', 'png', 'jpg', 'gif'];
            $extension = $request->image->extension();
            if(! in_array($extension, $extensions)){
                return response()->json($this->helping->validatingErrors("The image field file should be an image of svg, jpeg, png, jpg and gif"));
            }
            
            $imageName = time().'.'. $extension;  
            $request->image->move(public_path('images'), $imageName);
            $input['image'] = $imageName;
        }
        
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
            return response()->json($this->helping->deletingData($products));
        } catch (\Exception $e) {
            return response()->json($this->helping->invalidDeleteId($products));
        }
    }
}
