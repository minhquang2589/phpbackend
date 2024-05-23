<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Blog;
use Illuminate\Support\Facades\Validator;

class BlogController extends Controller
{
    //
    public function blogUpload()
    {
        return view('blog.upload');
    }
    //
    public function blogUpdate()
    {
        $blog = Blog::all();
        return view('blog.update', [
            'blog' => $blog,
        ]);
    }
    //
    public function blogDelete($id)
    {
        try {
            DB::beginTransaction();
            $blog = Blog::find($id);
            if (!$blog) {
                return redirect()->back()->with('error', 'blog not found.');
            }
            $blog->delete();
            DB::commit();
            return redirect()->back()->with('success', 'blog deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to delete blog.');
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
    public function handleUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:150',
            'description' => 'required|string|max:400',
            'image' => 'required|image|max:2048',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('image')) {
                $originName = $request->file('image')->getClientOriginalName();
                $fileName = pathinfo($originName, PATHINFO_FILENAME);
                $extension = $request->file('image')->getClientOriginalExtension();
                $fileName = $fileName . '_' . time() . '.' . $extension;
                $request->file('image')->move(public_path('images'), $fileName);
                $url = asset('images/' . $fileName);

                $blog = new Blog();
                $blog->title = $request->input('title');
                $blog->description = $request->input('description');
                $blog->image_url = $fileName;
                $blog->content = $request->input('content');
                $blog->save();
                DB::commit();
            }
            return redirect()->back()->with('success', 'blog uploaded successfully!');
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error', 'An error occurred while uploading the blog.');
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
    public function blogEditSubmit(Request $request)
    {
        $data = $request->all();
        $status = isset($data['status']) && $data['status'] === 'on' ? '1' : '0';
        $Blog = Blog::find($data['id']);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $Blog->image_url = $imageName;
        }
        $Blog->title = $data['title'];
        $Blog->description = $data['description'];
        $Blog->content = $data['content'];
        $Blog->status = $status;
        $Blog->save();
        return redirect()->back()->with('success', 'Update blog successfully!');
    }
}
