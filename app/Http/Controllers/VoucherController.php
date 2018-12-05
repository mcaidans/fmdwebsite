<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Redeem;
use App\Voucher;
use Carbon\Carbon;

use File;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\DB;


class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(\Auth::check()){
           $user = \Auth::user();
        }else{
           $user = false;
        }
        $vouchers = Voucher::all()->sortBy('id');
        foreach($vouchers as $voucher){
            if($user){
                $redemption = $user->redeems()->where([
                ['created_at', '>=', Carbon::now()->subHours($voucher->timeout)],
                ['voucher_id', '=', $voucher->id]
                ])->first();
                if ($redemption){
                    $voucher->isRedeemed = true;
                    $voucher->redeemedAt = $redemption->created_at->toDayDateTimeString();
                    $voucher->redeemAvailable = $redemption->created_at->addHours($voucher->timeout)->toDayDateTimeString();  
                }
            }
        }
        
        /*
        ADD FIELD WITH NO SPACES FOR ID
        foreach($vouchers as $voucher)
        {
            $voucher->setAttribute('nospacename', str_replace(' ', '', $voucher->name));
        }*/
        return view('vouchers.index')->with('vouchers', $vouchers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('vouchers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $filename =  $request->file('image')->path();
        

		    $validated = $request->validate(Voucher::$rules);
		    $filename = $request->file('image')->store('voucherimages', 'public');
            $oldFilePath = storage_path().'/app/public/' . $filename;
            $newFilePath = public_path() . '/storage/' . $filename;
		
            $move = File::move($oldFilePath, $newFilePath);//->store('voucherimages', 'public'));

            
			$voucher = new Voucher;
            $voucher->name = $validated['name'];

            $voucher->image_location = $filename;
            $voucher->description = '';
            $voucher->save();
			
			return redirect()->route('vouchers.create');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(\Auth::check() && \Auth::user()->admin){
            $voucher = Voucher::find($id);
            return view('vouchers.show')->with('voucher', $voucher);
        }
        else
        {
            return redirect()->route('vouchers.index');
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
        
        if(\Auth::check() && \Auth::user()->admin){
            $voucher = Voucher::find($id);
            return view('vouchers.edit')->with('voucher', $voucher);
        }
        else
        {
            return redirect()->route('vouchers.index');
        }
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
        $voucher = Voucher::find($id);
        //dd(app_path()."/storage/app/".$voucher->image_location);
        File::delete(public_path()."/".$voucher->image_location);
        $voucher->delete();
        return redirect()->route('vouchers.index');
        //"/home/ubuntu/workspace/public/voucherimages/rtNHnVXrVMazF1Pkypo6u8IgEZNaUPfZS3yAMcyS.png"
        ///storage/app/voucherimages/0WHiZoHI6cnQatbV5H33kLRvOpNkvhP91foxXnZM.png

    }
    
    public function importpage(){
        return view('vouchers.importpage');
    }
    
    public function import(Request $request)
    {
        $input = $request->all();
        $images = array();
        if($files=$request->file('images')){
            foreach($files as $file){
                
                $voucher = new Voucher;
                $voucher->name=$file->getClientOriginalName();
                $voucher->image_location = $file->store('voucherimages');
                $voucher->description = '';
                $voucher->save();
            }
        }
        return redirect()->route('vouchers.index');
    }
    
    public function redeem(Request $request){

        $request->validate(Redeem::$rules);
        $redeem = new Redeem;
        $redeem->voucher_id = $request['voucher_id'];
        $redeem->user_id = $request['user_id'];
        $redeem->save();        
        $dateRedeemed = $redeem->created_at->toDayDateTimeString(); //Get Date Redeemed in readable format
        $dateAvailable = $redeem->created_at->addHours($redeem->voucher()->first()->timeout)->toDayDateTimeString(); //Get Date available for next redeem in readable format
        
        return response()->json(['dateRedeemed' => $dateRedeemed, 'dateAvailable' => $dateAvailable]);
        
        //return redirect()->route('vouchers.index');

    }
}
