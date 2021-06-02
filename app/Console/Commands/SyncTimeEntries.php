<?php

namespace App\Console\Commands;

use App\Models\TimeEntry;
use App\Models\variable;
use App\Services\GoogleSheet;
use Illuminate\Console\Command;

class SyncTimeEntries extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:entries';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will sync the new entries in the DB with the Google Sheet';

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
    public function handle(GoogleSheet $googleSheet)
    {

        //check the last id that was synced
        $variable = variable::query()
            ->where('name', 'LastSyncedId')
            ->first();
        // query to the database to check now entries
        $rows = TimeEntry::query()
            ->where('id','>',$variable->value)
            ->orderBy('id')
            ->limit(100)
            ->get();
        // entry to db if we have new entries
        if($rows->count() === 0){
            return true;
        }
        //save datafrm db in collect
        $finalData = collect();
        $lastId = 0;
        foreach($rows as $row){
            $finalData->push([
                $row->id,
                $row->username,
                $row->project,
                $row->date,
                $row->time
            ]);

            $lastId = $row->id;
        }
        // save collect in sheetData Google
        $sheetData = $googleSheet->saveDataToSheet($finalData->toArray());
        //update limit row add
        $variable->value = $lastId;

        $variable->save();

        return true;
    }
}
