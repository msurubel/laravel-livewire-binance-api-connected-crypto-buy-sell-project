<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\locked_balances;

class EveryDay extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'everyday:updates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Day Data Update Job';

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
        $lockedbalances = locked_balances::wherestatus(1)->get();
        foreach($lockedbalances as $lockbalance){
            $getbalance = locked_balances::FindOrFail($lockbalance->id);
            $devidepercentag = $getbalance->locked_amount/100;
            $profitbalance = $devidepercentag*$set->locked_amount_profit;
            $finalprofit = $profitbalance/30;
            $getbalance->profit = $getbalance->profit+$finalprofit;
            $getbalance->save();
        }
    }
}
