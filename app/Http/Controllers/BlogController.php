<?php

namespace App\Http\Controllers;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function random($count){
        $blog = Blog::select('*')
                ->inRandomOrder()
                ->limit($count)
                ->get();

        $data['blogs'] = $blog;
            
        return response()->json([
                'response_code'=>'00',
                'response_message'=>'Success Create Data',
                'data'=>$data
                ],200);
    }
    public function index()
    {
        //
       
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blog = Blog::create([
            'blog_title'=>$request->blog_title,
            'blog_description'=>$request->blog_description,
        ]);

        if($request->hasfile('blog_photo')){
            
            $blog_image = $request->file('blog_photo');
            $image_extension = $blog_image->getClientOriginalExtension();
            $image_name=$blog->id.'.'.$image_extension;
            $image_folder='/photos/blog/';
            $image_location = $image_folder.$image_name;


            try{
                $blog_image ->move(public_path($image_folder),$image_name);

                $blog->update([
                    'blog_photo'=>$image_location,
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'response_code'=>'01',
                    'response_message'=>'Failed Add Campaign',
                    'data' =>$data,
                ],200);
            }

        $data['blogs'] = $blog;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Success Create Data',
            'data'=>$data
        ],200);

       }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
