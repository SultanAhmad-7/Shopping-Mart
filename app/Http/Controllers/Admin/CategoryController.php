<?php

namespace App\Http\Controllers\Admin;
use App\Section;
use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with(['sections', 'parentCategory'])->get();
       // $categories = json_decode(json_encode($categories), true);
        // echo "<pre>";
        // print_r($categories);
        // die();
        return view('admin.categories.index')->with(compact('categories'));
    }
    /**
     * Update Category Status
     */
    public function updateCategoryStatus(Request $request)
    {
        if($request->ajax()){
            $data = $request->all();
            if($data['status'] == 'Active'){
                $status = 0;
            }else{
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function addEditCategory(Request $request, $id=null){
        if($id==""){
            $title = "Add Category";
            $category = new Category;
            $editCategory = array();
            $getCategories = array();
            $message = "Category Added Successfully.";
        }else {
            $title = "Update Category";
            $editCategory = Category::where('id', $id)->first();
            $editCategory = json_decode(json_encode($editCategory), true);
            // it will select section and categories.
            $getCategories = Category::with('subCategories')->where(['section_id'=> $editCategory['section_id'], 'parent_id' => 0, 'status' => 1])->get();
           $getCategories = json_decode(json_encode($getCategories),true);
           $category = Category::find($id);
           $message = "Category Updated Successfully.";
           // use it for debugging purpose.
            // echo "<pre>";
            // print_r($getCategories);
            // die();
            
        }

        if($request->isMethod('POST')){
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);
            // die();
            $rules = [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'section_id'    => 'required',
                'url'           => 'required',
                'category_image' => 'image'
            ];

            $msgCustomization = [
                'category_name.required' => 'Name is Required.',
                'category_name.regex'    => 'Valid Name is Required.',
                'section_id.required'    => 'Section is Required.',
                
                'category_image.image'   => 'Valid Image is Required.'
            ];
            $this->validate($request, $rules, $msgCustomization);

            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if ($image_tmp->isValid()) {
                    // // Get image Extension
                    $extension = $image_tmp->getClientOriginalExtension();
                    // Generate New Image Name
                    $imageName = random_int(111, 999) . '.' . $extension;
                    $imagePath = 'img/adm_img/admin_category/' . $imageName;
                    // Upload the image
                    Image::make($image_tmp)->resize('400', '400')->save($imagePath);
                    
                        $category->category_image = $imageName;
                    
                } 
            }
           
           if(empty($data['category_discount']))
           {
                $data['category_discount'] = 0.00;
           }
          if(empty($data['description'])) 
          {
              $data['description'] = "";
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

          $category->parent_id = $data['parent_id'];
          $category->section_id = $data['section_id'];
          $category->category_name = $data['category_name'];
        // $category->category_image = '';
          $category->category_discount = $data['category_discount'];
          $category->description = $data['description'];
          $category->url = $data['url'];
          $category->meta_title = $data['meta_title'];
          $category->meta_description = $data['meta_description'];
          $category->meta_keywords = $data['meta_keywords'];
          $category->status = 1;
          $category->save();
          Session::flash('success_msg', $message);
          return redirect('admin/categories');
        }
        $sections = Section::where('status',1)->get();
        return view('admin.categories.add_edit_category')
                            ->with(compact('sections','title','editCategory', 'getCategories'));
    }
    
    // when section change category will be displayed according to section relation.
    public function sectionChangeCategory(Request $request)
    {
        if($request->ajax())
        {
            $data = $request->all();
            $getCategories = Category::with('subCategories')->where(['section_id'=> $data['section_id'], 'parent_id' => 0, 'status' => 1])->get();
           $getCategories = json_decode(json_encode($getCategories),true);
            // echo "<pre>";
            // print_r($getCategories);
            // die();
            return view('admin.categories.append_category_level')->with(compact('getCategories'));
        }
    }

    /**
     *  Now deleting the category image
     */
    public function deleteCategoryImage($id)
    {
        $this->deleteCategoryImageFromDirector($id);

        Category::where('id', $id)->update(['category_image' => '']);

        Session::flash('success_msg', "Category Image Deleted Successfully.");
        return redirect()->back();
    }

    /**
     * Delete category
     */

     public function deleteCategory($id)
     {
         //$this->deleteCategoryImageFromDirector($id);
         //$categoryDelete = Category::where('id', $id)->delete();
        
        //  if(isset($categoryDelete)) {
        //     Category::where('parent_id')->first()->delete();
        //  }
        Category::where('id', $id)->delete();
         Session::flash('success_msg', 'Category Deleted Successfully.');
         return redirect()->back();
     }

     public function deleteCategoryImageFromDirector($id)
     {
        $getCategoryImage = Category::select('category_image')->where('id', $id)->first();

        $categoryImagePath = 'img/adm_img/admin_category/';
        if(!empty($getCategoryImage) || $getCategoryImage != '') {
            
            if(file_exists($categoryImagePath.$getCategoryImage->category_image))
            {
                    unlink($categoryImagePath.$getCategoryImage->category_image);
            }
        }
     }
}
