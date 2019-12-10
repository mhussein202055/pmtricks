<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use App\ConfigX;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

//db
use App\Packages;
use App\UserPackages;
use App\Payments;

class PaymentController extends Controller
{
    
    public $Currency = 'USD';

    public function __construct()
    {
        
        $this->middleware('auth')->except([
            'price_details']);
 
        $paypal = \App\PaypalConfig::all()->first();
        $client_id = $paypal->client_id;
        $secret    = $paypal->secret;


        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $client_id,
            $secret)
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

        
    }

    public function payment_approve($approve_id){
        $approve = \App\PaymentApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        $payment = \App\Payments::find($approve->payment_id);
        $payment->complete = 1;
        $payment->save();

        $up = \App\UserPackages::where('package_id', '=', $approve->package_id)->where('user_id','=',$approve->user_id)->get();
        if($up->first()){
            return Redirect::to(route('payment.approve.index'))->with('error','The User Already have this Package !');
        }
        
        $up = new \App\UserPackages;
        $up->package_id = $approve->package_id;
        $up->user_id = $approve->user_id;
        $up->save();


        /** Store in history */
        $history = new \App\PaymentApproveHistory;
        $history->user_id = $approve->user_id;
        $history->package_id = $approve->package_id;
        $history->payment_id = $approve->payment_id;
        if($approve->img){
            $history->img = $approve->img;    
        }else{
            $history->img = null;
        }
        $history->save();

        $package = \App\Packages::find($approve->package_id);
        try{
            Mail::to($approve->user_id)->send(new \App\Mail\EnrollConfirmationMail($package->enroll_msg));
        }catch(\Exception $e){
            /**
             * do nothing !
             */
        }

    }

    public function price_details(Request $req){
        $coupon = \App\Coupon::where('code', $req->input('coupon_code'))->get()->first();
        $package = \App\Packages::find($req->input('package_id'));

        if(!$package){
            return 500;
        }
        
        if(!$coupon){
            return [
                'price' => $package->price,
                'discount' => 0,
            ];
        }

        if(\Carbon\Carbon::parse($coupon->expire_date)->gt(\Carbon\Carbon::now()) && ($coupon->no_use) > 0 && $coupon->package_id == $package->id){
            return [
                'price' => $package->price,
                'discount'  =>  $coupon->price,
            ];
        }else{
            return [
                'price' => $package->price,
                'discount' => 0,
            ];
        }
        

    }

    public function check(Request $req){
        $this->validate($req, [
            'img' => 'required|mimes:jpg,png,jpeg'
        ]);

        if ($req->hasFile('img')){
            // store the img
            $path = $req->file('img')->store('public/payment_check');

            $price = \App\Packages::find($req->input('package_id'))->price;

            $pd = new Payments;
            $pd->user_id            =  Auth::user()->id;
            $pd->buyerID            = '';
            $pd->paymentID          = '';
            $pd->cartID             = '';
            $pd->totalPaid          = $price;
            $pd->paypalEmail        = Auth::user()->email;
            $pd->city               = '';
            $pd->state              = '';
            $pd->postalCode         = '';
            $pd->countryCode        = '';
            $pd->address            = '';
            $pd->paymentMethod      = 'check';
            $pd->complete           = 0;                
            $pd->save();

            

            // update payment_approves table
            $approve = new \App\PaymentApprove;
            $approve->user_id = Auth::user()->id;
            $approve->package_id = $req->input('package_id');
            $approve->payment_id = $pd->id;
            $approve->img = $path;
            $approve->save();

            /**
             * updata notification table
             */
            
            $noti = new \App\Notification;
            $noti->description = 'New Check Payment from User: '.Auth::user()->name.', Of '.$price.'$ is accepted';
            $noti->save();


            $this->payment_approve($approve->id);

            
            return back()->with('success','Payment Completed Successfully please wait until payment approved');
        }else{
            return back()->with('error','Image field is required !');
        }
    }



    public function payV2(Request $req){
        $pd = new Payments;
        /**
        * orderID: data.orderID,
        * payer_id: details.payer.payer_id,
        * paypalEmail: details.payer.email_address,
        * countryCode: details.payer.address.country_code,
        * totalPaid: details.purchase_units[0].amount.value,
        * paymentID: details.purchase_units[0].payments.captures[0].id
         */


        $package = \App\Packages::find($req->input('package_id'));
        $pd->user_id            =  Auth::user()->id;
        $pd->buyerID            = $req->input('payer_id');
        $pd->paymentID          = $req->input('paymentID');
        $pd->cartID             = $req->input('orderID');
        $pd->totalPaid          = $req->input('totalPaid');
        if($req->input('paypalEmail') != ''){
            $pd->paypalEmail        = $req->input('paypalEmail');
        }else{
            $pd->paypalEmail        = Auth::user()->email;
        }        
        
        $pd->countryCode        = $req->input('countryCode');
        $pd->paymentMethod      = 'Paypal Checkout Express';
        $pd->complete           = 0;

        $coupon = \App\Coupon::where('code', '=', $req->input('coupon'))->get()->first();
        if($coupon){
            $pd->coupon_code        = $coupon->code;
        }

        $pd->save();

        

        // update payment_approves table
        $approve = new \App\PaymentApprove;
        $approve->user_id = Auth::user()->id;
        $approve->package_id = $req->input('package_id'); // package id from parameters
        $approve->payment_id = $pd->id;
        $approve->save();

        /**
         * updata notification table
         */
        
        $noti = new \App\Notification;
        $noti->description = 'Paypal Checkout Express: Requested by User: '.Auth::user()->name.'and Accepted, Package: '.\App\Packages::find($req->input('package_id'))->name;
        $noti->save();



        $coupon = \App\Coupon::where('code', '=', $req->input('coupon'))->get()->first();

        if($coupon){
            /**
             * check expiration
             */
            
            if(\Carbon\Carbon::parse($coupon->expire_date)->gt(\Carbon\Carbon::now()) && ($coupon->no_use) > 0 && $coupon->package_id == $package->id){
                /**
                 * not expired
                 */


                $coupon->no_use -= 1;
                $coupon->save();

            }
             
        }
    
        $this->payment_approve($approve->id);
        
        return 0;
    }
    
    public function pay($id , $code){


        


        // check if the package is exist
        $package =Packages::where('id', '=', $id)->get()->first();
        if(!$package){
            return back();
        
        }



        //check if the user have this package or not
        $user_package = UserPackages::where('user_id', '=', Auth::user()->id)->get();
        if($user_package->first()){
            foreach($user_package as $p){
                if($p->package_id == $id){
                    // redirect to my package page !
                    return back()->with('success', 'You already have this package !');
                }
            }
        }

        if(\App\PaymentApprove::where('package_id','=', $package->id)->where('user_id','=', Auth::user()->id)->get()->first())
        {
            return back()->with('error', 'you already have ordered this package befor and your order is in progress !');
        }

        $package_price_ = $package->price;
        $price_off_due_to_coupon = 0;
        $skip_payment_operation = 0;

        /**
         * check Coupon data
         */

        $coupon = \App\Coupon::where('code', '=', $code)->get()->first();

        if($coupon){
            /**
             * check expiration
             */
            
            if(\Carbon\Carbon::parse($coupon->expire_date)->gt(\Carbon\Carbon::now()) && ($coupon->no_use) > 0 && $coupon->package_id == $package->id){
                /**
                 * not expired
                 */

                $price_off_due_to_coupon = $coupon->price;

                if($price_off_due_to_coupon >= $package_price_){
                    /**
                     * # case One 
                     */
                    

                    $skip_payment_operation = 1;

                }elseif ($price_off_due_to_coupon < $package_price_){
                    /**
                     * # case Two
                     */
                    
                    

                    $package_price_ -= $price_off_due_to_coupon;

                }

                $coupon->no_use -= 1;
                $coupon->save();

            }else{
                return back()->with('error', ' Coupon Expired or unapplicable for this package !');
            }
             
        }else{
            if($code != 'ignore'){
                return back()->with('error', 'Wrong Coupon Code !');
            }
            
        }
        
          
        
       
    
        



        
        // process the payment

        if($package->price <= 0 || $skip_payment_operation == 1){
            $pd = new Payments;
            $pd->user_id            =  Auth::user()->id;
            $pd->buyerID            = '';
            $pd->paymentID          = '';
            $pd->cartID             = '';
            $pd->totalPaid          = 0;
            $pd->paypalEmail        = Auth::user()->email;
            $pd->city               = '';
            $pd->state              = '';
            $pd->postalCode         = '';
            $pd->countryCode        = '';
            $pd->address            = '';
            $pd->paymentMethod      = 'coupon';
            $pd->complete           = 0;                
            $pd->save();

            

            // update payment_approves table
            $approve = new \App\PaymentApprove;
            $approve->user_id = Auth::user()->id;
            $approve->package_id = $id; // package id from parameters
            $approve->payment_id = $pd->id;
            $approve->save();

            /**
             * updata notification table
             */
            
            $noti = new \App\Notification;
            $noti->description = 'Coupon: Free Package Requested by User: '.Auth::user()->name;
            $noti->save();

            $this->payment_approve($approve->id);
            
            return Redirect::to(route('public.package.view', $id))->with('success','please wait until request is approved');
        }







        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item_1 = new Item();
        $item_1->setName($package->name) /** item name **/
            ->setCurrency($this->Currency)
            ->setQuantity(1)
            ->setPrice($package_price_); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($this->Currency)
            ->setTotal($package_price_);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($package->description);
    
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('payment.status',['payment_status'=>'true', 'package_id'=>$id, 'coupon_code' => $code])) /** Specify return URL **/
            ->setCancelUrl(route('payment.status',['payment_status'=>'false', 'package_id'=>$id, 'coupon_code' => $code]));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/

        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] Some error occur, '.$ex->getMessage());
        } catch (\Exception $ex){
            return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] '.$ex->getMessage());
        }

        $approvalUrl = $payment->getApprovalLink();
        
        if (isset($approvalUrl)) {
            /** redirect to paypal **/
            return Redirect::away($approvalUrl);
        }

        return Redirect::to(route('home'))->with('error', 'Unknown error occurred');

        /**
         * ****************************
         * ****************************
         */

        
    }


    public function paymentStatus(Request $r ,$payment_status, $package_id, $coupon_code){
        

        

        if($payment_status == 'true'){


            // payment accepted ..
            $paymentId = $r->input('paymentId');
            $payerId = $r->input('PayerID');


            $payment = Payment::get($paymentId, $this->_api_context);
            
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            try{
                $result = $payment->execute($execution, $this->_api_context);
            }catch(\PayPal\Exception\PayPalConnectionException $ex){
                // echo $ex->getCode(); // Prints the Error Code
                // echo $ex->getData();
                // die($ex);
                return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] Some error occur, '.$ex->getMessage());
                
            }catch (\Exception $ex){
                return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] '.$ex->getMessage());
            }

            if($result->getState() == 'approved'){
                
                //store the payment data ..
                $pd = new Payments;
                $pd->user_id            =  Auth::user()->id;
                $pd->buyerID            = $payerId;
                $pd->paymentID          = $paymentId;
                $pd->cartID             = $payment->cart;
                $pd->totalPaid          = $payment->transactions[0]->amount->total;
                $pd->paypalEmail        = $payment->payer->payer_info->email;
                $pd->city               = $payment->payer->payer_info->shipping_address->city;
                $pd->state              = $payment->payer->payer_info->shipping_address->state;
                $pd->postalCode         = $payment->payer->payer_info->shipping_address->postal_code;
                $pd->countryCode        = $payment->payer->payer_info->shipping_address->country_code;
                $pd->address            = $payment->payer->payer_info->shipping_address->line1;
                $pd->paymentMethod      = $payment->payer->payment_method;
                if($coupon_code != 'ignore'){
                    $pd->coupon_code        = $coupon_code;
                }
                $pd->complete           = 0;                
                $pd->save();

                


                // update payment_approves table
                $approve = new \App\PaymentApprove;
                $approve->user_id = Auth::user()->id;
                $approve->package_id = $package_id;
                $approve->payment_id = $pd->id;
                $approve->img = null;
                $approve->save();

                


                /**
                 * updata notification table
                 */
                
                $noti = new \App\Notification;
                $noti->description = 'New Paypal Payment from User: '.Auth::user()->name.', Of '.$payment->transactions[0]->amount->total.'$ is accepted, Package: '.\App\Packages::find($package_id)->name;
                $noti->save();
            
                $this->payment_approve($approve->id);
                
                return back()->with('success','Payment Completed Successfully please wait until payment approved');
            }else{
                // coupon update 
                if($coupon_code != 'ignore'){
                    $coupon = \App\Coupon::where('code', '=', $code)->get()->first();
                    if($coupon){
                        $coupon->no_use += 1;
                        $coupon->save();
                    }
                }
                return Redirect::to(route('home'))->with('error','Payment Faild: Unknown error occurred');
            }
        }else{
            
            return Redirect::to(route('home'))->with('error','Payment Canceld !');
            //User Cancelled the Approval ..
        }
    }



    /*
        ********************************************
        ********************************************
        ********************************************
        **************** Extend ********************
        ********************************************
        ********************************************
        ********************************************
    */

    public function is_package_expired($package_id){

        $package = \App\Packages::find($package_id);
        if(!$package){
            return 1;
        }

        $user_package = \App\UserPackages::where('user_id', '=' ,Auth::user()->id)->where('package_id', '=', $package_id)->get()->first();
        if(!$user_package){
            return 1;
        }

        if(\Carbon\Carbon::parse($user_package->created_at)->addDays($package->expire_in_days)->gte(\Carbon\Carbon::now())){ // original package still not expired
            return 0;
        }else{
            $extension = \App\PackageExtension::where('user_id', '=', Auth::user()->id)->where('package_id', '=', $package_id)->orderBy('expire_at', 'desc')->first();
            if(!$extension){
                return  1;
            }else{
                if(\Carbon\Carbon::parse($extension->expire_at)->gte(\Carbon\Carbon::now())){
                    return 0;
                }else{
                    return 1;
                }
            }
        }

    }

    public function extension_payment_approve( $approve_id){
        $approve = \App\PaymentExtensionApprove::find($approve_id);
        if(!$approve){
            return Redirect::to(route('extension.payment.approve.index'))->with('error','Cant find such a Approve id !');
        }

        $package = \App\Packages::find($approve->package_id);
        if(!$package){
            return back()->with('error','package not found !');
        }

        
        $payment = \App\Payments::find($approve->payment_id);
        

        /**
         * update extension table
         */
        $expire_at = \Carbon\Carbon::now()->addDays($package->expire_in_days);

        $exten = new \App\PackageExtension;
        $exten->user_id = $approve->user_id;
        $exten->payment_id = $payment->id;
        $exten->package_id = $package->id;
        $exten->expire_at = $expire_at;
        $exten->save();


        $history = \App\ExtensionHistory::where('user_id','=', $approve->user_id)->where('package_id', '=', $package->id)->get()->first();
        if(!$history){
            $history = new \App\ExtensionHistory;
            $history->package_id = $package->id;
            $history->user_id = $approve->user_id;
            $history->extend_num = 0;
        }
        $history->extend_num += $package->extension_in_days;
        $history->save();

        $approve->delete();

        return back()->with('success', 'Payment Approved !');
    }  

    public function extend($package_id){
        $package = Packages::where('id', '=', $package_id)->get()->first();
        if(!$package){
            return back()->with('error', 'Error !');
        }

        /**
         * make sure package belongs to the user
         */
        $user_package = \App\UserPackages::where('user_id', '=', Auth::user()->id)->where('package_id', '=', $package_id)->get()->first();
        if(!$user_package){
            return back()->with('error', 'You may first pay the package !');
        }

        /**
         * make sure package is expired !
         */

        if(!$this->is_package_expired($package_id)){
            return back()->with('error', 'Package does not expired !');
        }

        /**
         * make sure payment extension approve table is empty
         */

        $approve = \App\PaymentExtensionApprove::where('package_id', '=', $package_id)->where('user_id', '=', Auth::user()->id)->get()->first();
        if($approve){
            return back()->with('error', 'You already have requested , and your request is processing !');
        }


        /** max extension */
        $history = \App\ExtensionHistory::where('user_id', '=', Auth::user()->id)->where('package_id', '=' , $package_id)->get()->first();
        if($history){
            if($history->extend_num >= $package->max_extension_in_days){
                return back()->with('error', 'you have exceed the max extension number of days !');       
            }
        }
        



        /**
         * consider the price !
         */
        if($package->extension_price <= 0){
            $pd = new Payments;
            $pd->user_id            =  Auth::user()->id;
            $pd->buyerID            = '';
            $pd->paymentID          = '';
            $pd->cartID             = '';
            $pd->totalPaid          = 0;
            $pd->paypalEmail        = Auth::user()->email;
            $pd->city               = '';
            $pd->state              = '';
            $pd->postalCode         = '';
            $pd->countryCode        = '';
            $pd->address            = '';
            $pd->paymentMethod      = 'freeExtension';
            $pd->complete           = 0;                
            $pd->save();

            

            /**
             * update payment extension approve table
             */

            $approve = new \App\PaymentExtensionApprove;
            $approve->user_id = Auth::user()->id;
            $approve->package_id = $package_id;
            $approve->payment_id = $pd->id;
            $approve->save();


            


            
            /**
             * updata notification table
             */
            
            $noti = new \App\Notification;
            $noti->description = 'Free Extension: Package Extended by User: '.Auth::user()->name;
            $noti->save();

            $this->extension_payment_approve($approve->id);
            
            return back()->with('success', 'Package Extended Free !');
        }


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");

        $item_1 = new Item();
        $item_1->setName('Extension: '.$package->name) /** item name **/
            ->setCurrency($this->Currency)
            ->setQuantity(1)
            ->setPrice($package->extension_price); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));
        $amount = new Amount();
        $amount->setCurrency($this->Currency)
            ->setTotal($package->extension_price);
        
        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Extend Package: '.$package->description);
    
        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(route('extend.status',['payment_status'=>'true', 'package_id'=>$package_id ])) /** Specify return URL **/
            ->setCancelUrl(route('extend.status',['payment_status'=>'false', 'package_id'=>$package_id]));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/

        
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PayPalConnectionException $ex) {
            return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] Some error occur, '.$ex->getMessage());
        } catch (\Exception $ex){
            return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] '.$ex->getMessage());
        }

        $approvalUrl = $payment->getApprovalLink();
        
        if (isset($approvalUrl)) {
            /** redirect to paypal **/
            return Redirect::away($approvalUrl);
        }

        return Redirect::to(route('home'))->with('error', 'Unknown error occurred');

        /**
         * ****************************
         * ****************************
         */

    }


    public function extendStatus(Request $r ,$payment_status, $package_id){

        $package = Packages::where('id', '=', $package_id)->get()->first();
        if(!$package){
            return Redirect::to(route('home'))->with('error', 'Error !');
        }

        

        if($payment_status == 'true'){


            // payment accepted ..
            $paymentId = $r->input('paymentId');
            $payerId = $r->input('PayerID');


            $payment = Payment::get($paymentId, $this->_api_context);
            
            $execution = new PaymentExecution();
            $execution->setPayerId($payerId);

            try{
                $result = $payment->execute($execution, $this->_api_context);
            }catch(\PayPal\Exception\PayPalConnectionException $ex){
                // echo $ex->getCode(); // Prints the Error Code
                // echo $ex->getData();
                // die($ex);
                return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] Some error occur, '.$ex->getMessage());
                
            }catch (\Exception $ex){
                return Redirect::to(route('home'))->with('error','['.$ex->getCode().'] '.$ex->getMessage());
            }

            if($result->getState() == 'approved'){
                
                $check = Payments::where('paymentID', $paymentId)->get()->first();
                if(!$check){
                    //store the payment data ..
                    $pd = new Payments;
                    $pd->user_id            =  Auth::user()->id;
                    $pd->buyerID            = $payerId;
                    $pd->paymentID          = $paymentId;
                    $pd->cartID             = $payment->cart;
                    $pd->totalPaid          = $payment->transactions[0]->amount->total;
                    $pd->paypalEmail        = $payment->payer->payer_info->email;
                    $pd->city               = $payment->payer->payer_info->shipping_address->city;
                    $pd->state              = $payment->payer->payer_info->shipping_address->state;
                    $pd->postalCode         = $payment->payer->payer_info->shipping_address->postal_code;
                    $pd->countryCode        = $payment->payer->payer_info->shipping_address->country_code;
                    $pd->address            = $payment->payer->payer_info->shipping_address->line1;
                    $pd->paymentMethod      = $payment->payer->payment_method;
                    $pd->complete           = 0;                
                    $pd->save();

                    


                    


                    /**
                     * update payment extension approve table
                     */

                    $approve = new \App\PaymentExtensionApprove;
                    $approve->user_id = Auth::user()->id;
                    $approve->package_id = $package_id;
                    $approve->payment_id = $pd->id;
                    $approve->save();


                    

                    

                    



                    /**
                     * updata notification table
                     */
                    
                    $noti = new \App\Notification;
                    $noti->description = 'Package Extension: New Paypal Payment from User: '.Auth::user()->name.', Of '.$payment->transactions[0]->amount->total.'$ is accepted';
                    $noti->save();


                    $this->extension_payment_approve($approve->id);
                
                    
                    
                    return back()->with('success','Payment Completed Successfully, please wait until payment approved.');
                }
                
            }else{
                
                return Redirect::to(route('home'))->with('error','Payment Faild: Unknown error occurred');
            }
        }else{
            
            return back()->with('error','Payment Canceld !');
            //User Cancelled the Approval ..
        }




    }
}