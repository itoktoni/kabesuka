<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Modules\Finance\Dao\Models\Payment;
use Modules\Sales\Emails\CreateOrderEmail;
use Modules\Sales\Emails\TestingOrderEmail;
use Modules\Sales\Emails\CreateLanggananEmail;
use Modules\Finance\Emails\ApprovePaymentEmail;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Modules\Finance\Emails\ConfirmationPaymentEmail;
use Modules\Finance\Dao\Repositories\PaymentRepository;
use Modules\Item\Dao\Models\Notifikasi;
use Modules\Sales\Dao\Repositories\SubscribeRepository;
use Modules\Procurement\Dao\Repositories\PurchasePrepareRepository;
use Modules\Procurement\Emails\CreateOrderEmail as EmailsCreateOrderEmail;
use Modules\System\Plugins\Helper;
use PHPUnit\TextUI\Help;

class SendWa extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:promo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To Sending Email';

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

        $notifikasi = Notifikasi::whereNull('notifikasi_end')->get();
        foreach($notifikasi as $send){
            Helper::sendWa($send->notifikasi_content, $send->notifikasi_phone, $send->notifikasi_image);
        }

        $this->info('The system has been sent successfully!');
    }
}
