<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{

    public function blogView()
    {
        $blog = Blog::where('status', 1)->first();
        return response()->json([
            'success' => true,
            'blog' => $blog
        ]);
    }
    ///
    public function blogEditView()
    {
        $blog = Blog::all();
        return response()->json([
            'success' => true,
            'blog' => $blog
        ]);
    }
    //
    public function editBlogView($id)
    {
        $blog = Blog::where('id', $id)->first();
        return response()->json([
            'success' => true,
            'blog' => $blog
        ]);
    }
    //
    public function removeBlog($id)
    {
        try {
            DB::beginTransaction();
            $blog = Blog::find($id);
            if (!$blog) {
                return response()->json([
                    'success' => false,
                    'error' => ['blog not found.']
                ]);
            }
            $blog->delete();
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => ['blog deleted successfully.']
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'error' => ['Failed to delete blog.']
            ]);
        }
    }
    //
    public function blogFileUpload(Request $request)
    {
        try {
            if ($request->hasFile('upload')) {
                $originName = $request->file('upload')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('upload')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('upload')->move(public_path('images'), $fileName);
                $url = asset('images/' . $fileName);
                return response()->json([
                    'url' => $url,
                    'uploaded' => 1,
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'uploaded' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
    ///
    public function blogUpload(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:400',
            'images' => 'required|image|max:2048',
            'status' => 'required',
        ],);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all(),
            ]);
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->move(public_path('images'), $imageName);
                $blog = new Blog();
                $blog->title = $request->input('title');
                $blog->description = $request->input('description');
                $blog->image_url = $imageName;
                $blog->status = $request->status;
                $blog->content = $request->input('content');
                $blog->save();
            }

            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'Upload blog successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'eror' => ['An error occurred while uploading the blog.'],
            ]);
        }
    }
    //
    public function blogEdit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', [
            'blog' => $blog
        ]);
    }
    //
    public function blogUpdate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:400',
            'images' => 'required|image|max:2048',
            'status' => 'required',
        ],);
        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'error' => $validator->errors()->all(),
            ]);
        }
        try {
            DB::beginTransaction();
            $Blog = Blog::find($request->blogId);
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images'), $imageName);
                $Blog->title = $request->title;
                $Blog->image_url = $imageName;
                $Blog->description = $request->description;
                $Blog->content = $request->content;
                $Blog->status = $request->status;
                $Blog->save();
            }
            DB::commit();
            return response()->json([
                'success' => true,
                'message' => 'update blog successfully!',
            ]);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json([
                'success' => false,
                'erorr' => ['An error occurred while uodate the blog.'],
            ]);
        }
    }
}
