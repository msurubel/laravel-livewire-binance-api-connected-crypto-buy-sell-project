<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\cryptos;
use App\Models\settings;
use App\Models\balances;
use App\Models\transections;
use App\Models\miningcryptos;

class EveryHours extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyhours:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update Online Live Data from API';

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
        $set = settings::findOrFail(1);
        $api = new \Binance\API("$set->api_key","$set->scrt_key");
        $api->useServerTime(); 

        $mininglists = miningcryptos::wherestatus(1)->get();
        foreach($mininglists as $lists){
            $miningcryptocoinsymbol = ''.$lists->symbol.'USDT';
            $miningprice = $api->price("$miningcryptocoinsymbol");

            $dayincomeincrypto = $lists->day_income/$miningprice;
            $redincome = $dayincomeincrypto;
            $redhourincom =  $redincome/24; 
            
            $readusd = $redhourincom*$miningprice;

            $miningupdate = miningcryptos::findOrFail($lists->id);
            $miningupdate->minig_balance = $miningupdate->minig_balance+$redhourincom;
            $miningupdate->minig_balance_usd = $miningupdate->minig_balance_usd+$readusd;
            $miningupdate->save();
        }
    }
}
