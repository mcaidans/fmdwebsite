<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Voucher;
use File;

class VoucherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vouchers = Voucher::all();
        $t = Voucher::find(47);
        /*
        ADD FIELD WITH NO SPACES FOR ID
        foreach($vouchers as $voucher)
        {
            $voucher->setAttribute('nospacename', str_replace(' ', '', $voucher->name));
        }*/

        return view('vouchers.index')->with('vouchers', $vouchers)->with('t', $t);
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
		    $validated = $request->validate(Voucher::$rules);

			$voucher = new Voucher;
            $voucher->name = $validated['name'];
            $voucher->image_location = $request->file('image')->store('voucherimages');
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
}
