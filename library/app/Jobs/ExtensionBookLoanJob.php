<?php

namespace App\Jobs;

use App\Models\BookLoans;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExtensionBookLoanJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // Retrieve all book loans
        $loans = BookLoans::all();

        foreach ($loans as $loan) {
            // Check if the extension is not approved and the due date has passed
            if (($loan->extended === 'rejected' && $loan->due_date < Carbon::now()->timestamp) || ($loan->due_date < Carbon::now()->timestamp && $loan->status === "borrowed")) {
                $overduePeriodInDays = Carbon::now()->diffInDays(Carbon::createFromTimestamp($loan->due_date));
                $penaltyAmount = ceil($overduePeriodInDays / 14) * 100;
                $loan->penalty_amount = $penaltyAmount;
                $loan->penalty_status = 'penalized';

                $loan->save();
            }

            if ($loan->status === 'returned' && $loan->penalty_status === 'penalized') {
                $loan->penalty_status = 'canceled';
                $loan->save();
            }
        }
    }
}
