<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Notifications\AuctionWonNotification;
use App\AuctionItem;

class CheckForFinishedAuctions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:endAuctions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $auctionItems = AuctionItem::where('winner_notified', 0)
            ->where('ends_at', '<', date("Y-m-d H:i:s", time()) )
            ->get();
        if (count($auctionItems) > 0) {
            foreach ($auctionItems as $auctionItem) {
                $this->mail_winner($auctionItem);
            }
        }
    }

    public function mail_winner($auctionItem)
    {
        //$auctionItem = AuctionItem::with('bids', 'bids.user')->findOrFail($auctionItem_id);
        $highestBid = null;

        if (count($auctionItem->bids) > 0) {
            foreach ($auctionItem->bids as $bid) {
                if ($highestBid == null || $highestBid->price < $bid->price) {
                    $highestBid = $bid;
                }
            }
            $user = $highestBid->user;
            $user->notify(new AuctionWonNotification($auctionItem, $highestBid));
        }

        $auctionItem->winner_notified = true;
        $auctionItem->save();
    }
}
