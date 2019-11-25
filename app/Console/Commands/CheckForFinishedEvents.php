<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Notifications\EventEndedNotification;
use App\Event;
use App\User;


class CheckForFinishedEvents extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:endEvents';

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
        $events = Event::where('admin_notified', 0)
            ->where('ends_at', '<', date("Y-m-d H:i:s", time()) )
            ->get();
        if (count($events) > 0) {
            foreach ($events as $event) {
               $this->mail_admin($event);
            }
        }
    }

    public function mail_admin($event)
    {
        if (count($event->auctionItems) > 0) {
            $content = [];
            foreach ($event->auctionItems as $auctionItem) {
                $content[] = $auctionItem->item->title . ' ... ' . ((count($auctionItem->bids) > 0) ? 'sold' : ' not sold');
            }

            $admins = User::leftjoin('user_role', 'user_id', '=', 'users.id')
                ->where('role_id', 1)
                ->get();
            if (count($admins) > 0) {
                foreach ($admins as $admin) {
                    $admin->notify(new EventEndedNotification($content, $event));
                }
            }
        }

        $event->admin_notified = true;
        $event->save();
    }
}
