<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campaign;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function random($count){
        $campaign = Campaign::select('*')
                    ->inRandomOrder()
                    ->limit($count)
                    ->get();
        
        $data['campaigns'] = $campaign;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Success Create Data',
            'data'=>$data
        ],200);
    }

    public function index(){
        //
        $campaign = Campaign::paginate(1);

        $data['campaigns'] = $campaign;
        
        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Get All data',
            'data'=>$data,
        ],200);
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
        // $request->validate([
        //     'title'=>'required',
        //     'description'=>'required',
        //     'campaign_photo'=>'required|mimes:png,jpg'
        // ]);
        // dd('hai');


        $campaign = Campaign::create([
            'title'=>$request->title,
            'description'=>$request->description
        ]);

        if($request->hasfile('campaign_photo')){
            
            $image = $request->file('campaign_photo');
            $image_extension = $image->getClientOriginalExtension();
            $image_name=$campaign->id.'.'.$image_extension;
            $image_folder='/photos/campaign/';
            $image_location = $image_folder.$image_name;


            try{
                $image->move(public_path($image_folder),$image_name);

                $campaign->update([
                    'campaign_photo'=>$image_location,
                ]);
            }catch(\Exception $e){
                return response()->json([
                    'response_code'=>'01',
                    'response_message'=>'Failed Add Campaign',
                    'data' =>$data,
                ],200);
            }

        $data['campaigns'] = $campaign;

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
    public function detail($id)
    {
        //
        $campaign = Campaign::find($id);
        $data['campaign']=$campaign;

        return response()->json([
            'response_code'=>'00',
            'response_message'=>'Success Show Data',
            'data'=>$data
        ],200);
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
