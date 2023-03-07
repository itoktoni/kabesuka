<?php

namespace App\Console\Commands;

use App\Models\User;
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
use Modules\Item\Dao\Models\Template;
use Modules\Sales\Dao\Repositories\SubscribeRepository;
use Modules\Procurement\Dao\Repositories\PurchasePrepareRepository;
use Modules\Procurement\Emails\CreateOrderEmail as EmailsCreateOrderEmail;
use Modules\System\Plugins\Helper;
use PHPUnit\TextUI\Help;

class BirthdayWa extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:birthday';

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

        $birthday = User::whereMonth('birth', date('m'))
        ->whereDay('birth', date('d'))
        ->get();

        if($birthday){
            foreach($birthday as $user){

                $template = Template::find(1);

                $content = str_replace('@name', $user, $template->template_description);
                $gambar = Helper::files('template/'.$template->template_image);

                $check = Helper::sendWa($content, Helper::convertPhone($user->phone), $template->template_type, $gambar);

            }
        }

        $this->info($check);
    }
}
