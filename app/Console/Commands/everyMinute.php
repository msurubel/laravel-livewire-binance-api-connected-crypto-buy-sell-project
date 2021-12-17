<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\transections;
use App\Models\miningcryptos;
use App\Models\locked_balances;


class everyMinute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyminute:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Online Live Data from Database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $cryptos = cryptos::whereStatus(1)->get();
        $set = settings::findOrFail(1);
        
                
        $blnc = balances::wherestatus(1)->get();
        foreach($blnc as $blncs){

            $cryptolist = Http::get('https://api3.binance.com/api/v3/ticker/price?symbol='.$blncs->symbol.'USDT')->json();
            $collection = collect($cryptolist);
            $getpricedata = $collection['price'];
            
            
            $totalblnc = $blncs->balance*$getpricedata;
            
            $blnupdate = balances::findOrFail($blncs->id);
            $blnupdate->balance_usd = $totalblnc;
            $blnupdate->save();            
            
        }

        

        $transections = transections::wheretype(2)->get();
        foreach($transections as $trxstatus){
            $orderid = "$trxstatus->orderId";
            $orderstatus = $api->orderStatus("$trxstatus->method_symbol", $orderid);

            $trxupdate = transections::FindOrFail($trxstatus->id);
            $trxupdate->status = $orderstatus['status'];
            $trxupdate->save();
        }
        

    }
}
