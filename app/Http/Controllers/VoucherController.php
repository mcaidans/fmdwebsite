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
        $vouchers = Voucher::orderBy('order')->paginate(12);
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
        if($this->checkAdmin()){
            return view('vouchers.create');
        }
        else
        {
            return redirect()->route('vouchers.index');
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($this->checkAdmin()){
            $filename1 =  $request->file('image')->path();

    	    $validated = $request->validate(Voucher::$rules);
    	    $filename = $request->file('image')->store('voucherimages', 'public');
    		    
                
            $oldFilePath = base_path().'/public/storage/' . $filename;
            $newFilePath = storage_path() . '/' . $filename;
            $move = File::move($oldFilePath, $newFilePath);
            
            
    		$voucher = new Voucher;
            $voucher->name = $validated['name'];
    
            $voucher->image_location = $filename;
            $voucher->description = '';
            $voucher->save();
    		
    		return redirect()->route('vouchers.create');
        }
        else
        {
            return redirect()->route('vouchers.index');
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
        if($this->checkAdmin()){
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
        
        if($this->checkAdmin()){
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
        if($this->checkAdmin()){
            $voucher = Voucher::find($id);
            File::delete(public_path()."/".$voucher->image_location);
            $voucher->delete();
            return redirect()->route('vouchers.index');
        }
        else
        {
            return redirect()->route('vouchers.index');
        }
        

    }
    
    public function importpage(){
        if($this->checkAdmin())
            return view('vouchers.importpage');
        else
            return redirect()->route('vouchers.index');
        
    }
    
    public function import(Request $request)
    {
        if($this->checkAdmin()){
            $input = $request->all();
            $images = array();
            if($files=$request->file('images')){
                foreach($files as $file){
                    $filename = $file->store('voucherimages', 'public');
    	            $oldFilePath = base_path().'/public/storage/' . $filename;
    	            $newFilePath = storage_path() . '/' . $filename;
    	            $move = File::move($oldFilePath, $newFilePath);
                    $voucher = new Voucher;
                    $voucher->name=$file->getClientOriginalName();
                    $voucher->image_location = $filename;//->store('voucherimages');
                    $voucher->description = '';
                    $voucher->save();
                }
            }
            return redirect()->route('vouchers.index');
        }
        else{
            return redirect()->route('vouchers.index');
        }
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
    
     public function updateOrder(){
        if($this->checkAdmin()){
            $vouchers = Voucher::all()->sortBy('order');
            return view('vouchers.updateorder')->with('vouchers', $vouchers);;
        }
        else{
            return redirect()->route('vouchers.index');
        }
    }

    public function saveOrder(Request $request){
        if($this->checkAdmin()){
            $orderCount = 0;
            foreach ($request['orderArray'] as $order){
                $voucher = Voucher::find($order);
                //$voucher->order = 2;
               $voucher->order = $orderCount;
                $voucher->save();
                $orderCount = $orderCount + 1;
            }
            return $request['orderArray'];
        }
        else{
            return redirect()->route('vouchers.index');
        }
        
    }
    
    function checkAdmin(){
        if(\Auth::check() && \Auth::user()->admin)
            return true;
        else
            return false;            
    }
    
    function subwayNorth(){
        $vouchers = Voucher::where('id', '>', 758)->paginate(10);
        return view('vouchers.index')->with('vouchers', $vouchers);
    }
        
}
