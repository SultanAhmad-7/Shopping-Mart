<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Section;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
   
      
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['category' => function($query){
            $query->select('id', 'category_name');
        }, 'section' => function($query){
            $query->select('id', 'name');
        }])->get();
    //   $products = json_decode(json_encode($products), true);
    //     echo "<pre>";
    //     print_r($products);
    //     die();
        return view('admin.products.index')->with(compact('products'));
    }
    
    /**
     * @return status active or inactive
     */
    public function updateProductStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'product_id' => $data['product_id']]);
        }
    }

    /**
     * Update and Add the Record
     */
    public function addEditProduct(Request $request, $id=null)
    {
        if($id=="")
        {
            $title = "Add Product";
            $product = new Product;
            $productData = array();
            $message = "Product added successfully.";
        } else{
            $title = "Update Product";
            $productData = Product::findOrFail($id);
            $productData = json_decode(json_encode($productData), true);
            $product = Product::findOrFail($id);
            // echo "<pre>";
            // print_r($productData); die();
            $message = "Product updated successfully.";
        }

        if($request->isMethod('POST'))
        {
           $data = $request->all();
            // Now declare some rules 
            // echo "<pre>";
            // print_r($data);
            // die();
            $rules = [
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|alpha_num',
                'product_price' => 'required|numeric',
                'product_color' => 'required|alpha',
                'product_weight' => 'required|numeric',
                'main_image' => 'image',

                

            ];
            $messages = [
                'category_id.required' => 'Category needs to be selected.',
                'product_name.regex' => 'Product Name field should be filled.',
                'product_name.alpha' => 'Product Name should has alphabatic letters.',
                'product_code.required' => 'Product code field should be filled.',
                'product_code.alpha_num' => 'Product code should has numeric letters.',
                'product_price.required' => 'Product price field should be filled.',
                'product_price.numeric' => 'Product price must has numeric characters.',
                'product_color.required' => 'Product color filed should be filled.',
                'product_color.alpha' => 'Product color must has alphabatic letters.',
                'product_weight.required' => 'Product weight field should be filled.',
                'product_weight.numeric' => 'Product weight should be contain numeric characters.',
                'description.required' => 'Product Description field should be filled.',
                'main_image.image' => 'Valid Product Image is required.'
            ];
            $this->validate($request, $rules, $messages);
                // Image Upload after resize.
            if($request->hasFile('main_image')){
                $tmp_image = $request->file('main_image');
                if($tmp_image->isValid()){
                    $mainImageName = $tmp_image->getClientOriginalName();
                    $mainImageExt = $tmp_image->getClientOriginalExtension();
                    $imageName = $mainImageName.'-'.rand(111,9999).'.'.$mainImageExt;
                    $imagePathL = 'img/adm_img/admin_product/large/' . $imageName;
                    $imagePathM = 'img/adm_img/admin_product/medium/' . $imageName;
                    $imagePathS = 'img/adm_img/admin_product/small/' . $imageName;
                    Image::make($tmp_image)->save($imagePathL); // 1040 x 1200
                    Image::make($tmp_image)->resize(520,600)->save($imagePathM);
                    Image::make($tmp_image)->resize(260,300)->save($imagePathS);
                    $product->main_image = $imageName;
                }
            }
                // Video Upload
            if($request->hasFile('product_video')){
                $tmperory_video = $request->file('product_video');
                if($tmperory_video->isValid())
                {
                    $name = $tmperory_video->getClientOriginalName();
                    $extenion = $tmperory_video->getClientOriginalExtension();
                    $videoName = $name.'-'.rand(111,999).'.'.$extenion;
                    $videoPath = public_path().'/videos/product_video/';
                    $tmperory_video->move($videoPath, $videoName);
                    $product->product_video = $videoName;
                }

            }
                if(empty($data['is_featured'])) 
                {
                    $is_featured = 'No';
                } else {
                    $is_featured = 'Yes';
                }

                if(empty($data['product_discount'])){
                    $data['product_discount'] = 0.00;
                }
                if(empty($data['wash_care'])){
                    $data['wash_care'] = "";
                }
                if(empty($data['fabric'])) {
                    $data['fabric'] = "";
                }
                if(empty($data['sleeve'])) {
                    $data['sleeve'] = "";
                }
                if(empty($data['pattern'])) {
                    $data['pattern'] = "";
                }
                if(empty($data['fit'])){
                    $data['fit'] = "";
                }

                if(empty($data['occasion'])) {
                    $data['occasion'] = "";
                }

                if(empty($data['meta_title']))
                    {
                      $data['meta_title'] = "";
                    }
                
                if(empty($data['meta_description']))
                  {
                      $data['meta_description'] = "";
                  }
                               if(empty($data['meta_keywords']))
                {
                    $data['meta_keywords'] = "";
                }

                //echo $is_featured; die();
            $category = Category::find($data['category_id']);
            $product->section_id = $category['section_id'];
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_color = $data['product_color'];
            $product->product_price = $data['product_price'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
           // $product->product_video = "";//$data['product_video'];
          // $product->main_image = "";//$data['main_image'];
            $product->description = $data['description'];
            $product->wash_care = $data['wash_care'];
            $product->fabric = $data['fabric'];
            $product->sleeve = $data['sleeve'];
            $product->pattern = $data['pattern'];
            $product->fit = $data['fit'];
            $product->occasion = $data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->is_featured = $is_featured;
            $product->status = 1;
           // $product = json_decode(json_encode($product));
            $product->save();
          
            Session::flash('success_msg', $message);
            return redirect(route('product.lists'));
        }

           $fabricArray = array('Cotton', 'Polyester', 'Whool');
           $sleeveArray = array('Full Sleeve', 'Half Sleeve', 'Short Sleeve', 'Sleeveless');
          $patternArray = array('Checked', 'Plain', 'Printed', 'Self', 'Solid');
              $fitArray = array('Regular', 'Slim');
        $occasionArray = array('Casual', 'Formal');
            $categories = Section::with('categories')->get();
            // Now lets debug it
            $categories = json_decode(json_encode($categories), true);
            // echo "<pre>";
            // print_r($categories);
            // die();
        
        return view('admin.products.add_edit_product')
                    ->with(compact('title', 
                              'fabricArray',
                              'sleeveArray',
                              'patternArray',
                              'fitArray',
                            'occasionArray',
                                        'categories',
                                        'productData'
                                        ));
    }

    /**
     *  Now deleting the category image
     */
    public function deleteProductImage($id)
    {
        $this->deleteProductImageFromDirector($id);

        Product::where('id', $id)->update(['main_image' => '']);

        Session::flash('success_msg', "Product Image Deleted Successfully.");
        return redirect()->back();
    }

    public function deleteProductImageFromDirector($id)
     {
        $getProductImage = Product::select('main_image')->where('id', $id)->first();

        $imagePathL = 'img/adm_img/admin_product/large/' ;
        $imagePathM = 'img/adm_img/admin_product/medium/';
        $imagePathS = 'img/adm_img/admin_product/small/' ;
        if(!empty($getProductImage) || $getProductImage != '') {
            
            if(file_exists($imagePathL.$getProductImage->main_image))
            {
                    unlink($imagePathL.$getProductImage->main_image);
            }
              
            if(file_exists($imagePathM.$getProductImage->main_image))
            {
                    unlink($imagePathM.$getProductImage->main_image);
            }
              
            if(file_exists($imagePathS.$getProductImage->main_image))
            {
                    unlink($imagePathS.$getProductImage->main_image);
            }
        }
     }

      /**
     *  Now deleting the Product Video
     */
    public function deleteProductVideo($id)
    {
        $this->deleteProductVideoFromDirector($id);

        Product::where('id', $id)->update(['product_video' => '']);

        Session::flash('success_msg', "Product Video Deleted Successfully.");
        return redirect()->back();
    }
    public function deleteProductVideoFromDirector($id)
    {
       $getProductVideo = Product::select('product_video')->where('id', $id)->first();

       $imagePathL = 'videos/product_video/' ;
       if(!empty($getProductVideo) || $getProductVideo != '') {
           
           if(file_exists($imagePathL.$getProductVideo->product_video))
           {
                   unlink($imagePathL.$getProductVideo->product_video);
           }

       }
    }

    
    /**
     * Delete category
     */

    public function deleteProduct($id)
    {
        //$this->deleteCategoryImageFromDirector($id);
        //$categoryDelete = Category::where('id', $id)->delete();
       
       //  if(isset($categoryDelete)) {
       //     Category::where('parent_id')->first()->delete();
       //  }
       Product::where('id', $id)->delete();
        Session::flash('success_msg', 'Product Deleted Successfully.');
        return redirect()->back();
    }




}
