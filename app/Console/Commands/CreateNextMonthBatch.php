<?php

namespace App\Console\Commands;

use App\Models\Month;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CreateNextMonthBatch extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:CreateNextMonth';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '毎月1日に翌月の年月を登録する';

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
        $nextMonth = Carbon::now()->addMonth();
        try {
            DB::beginTransaction();
            Month::create([
                'year' => $nextMonth->year,
                'month' => $nextMonth->month
            ]);
            $this->info($nextMonth->year.'年'.$nextMonth->month.'月を登録しました。');
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th);
            DB::rollBack();
        }
    }
}
