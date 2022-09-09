<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\product;
use App\Models\SubscriptionItem;
use App\Models\Subscription;

class SubscriptionController extends Controller
{

    public function create(Request $request, product $product)
    {
        $validator = Validator::make($request->all(), [
            'name'     =>  'required|regex:/^[a-zA-Z]+$/u',
            'card'     =>  'required|numeric:max(16)',
            'cvv'      =>  'required|numeric:max(3)',
            'month'    =>  'required|numeric',
            'year'     =>  'required|numeric',
        ]);

        if($validator->fails()) {
            $error = $validator->errors(); 
            $myArray = json_decode($error, true);

            $error_names = ['name','card','cvv','month','year'];

            $error = $validator->errors(); 
            $myArray = json_decode($error, true);

            foreach($error_names as $val){
                if(array_key_exists($val,$myArray))
                {
                    $errors[$val] = $myArray[$val][0];
                }else
                {
                    $errors[$val] = ' ';
                }
            }

            $product = product::where('name',$request->product)->first();
            return view('products.show', compact('product','errors'));
           
        }else{
            $product_name = $request->product;
            $card = $request->card;
            $cvv = $request->cvv;
            $name = $request->name;
            $month = $request->month;
            $year = $request->year;

             //Stripe Payment gateway
               
            \Stripe\Stripe::setApiKey(env('STRIPE_PUBLIC_KEY'));
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));

            try{

                               
                //Create Token Form Card details
                $token = \Stripe\Token::create([      
                                            'card' => [
                                                    'number'          => $card,
                                                    'exp_month'       => $month,
                                                    'exp_year'        => $year,
                                                    'cvc'             => $cvv,
                                                    'name'            => $name,
                                                    ]
                                        ]);
                                        
                                                            
                $product = product::where('name',$request->product)->first();
               
                // Create a Customer
                $customer =\Stripe\Customer::create([
                    'name'  => $name,
                    "source" => $token->id,
                ]);
                                                          
               

                if($token){

                    \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
                    $payment =\Stripe\Charge::create([
                                'source'   => 'tok_amex',
                                'currency' => 'inr',
                                'amount'   => $product->price,
                                'description' => 'Rennetwork Test Payment',
                                "metadata" => ["name" =>  $name]
                            ]);

                    $subscription_add = new Subscription;

                    $subscription_add->user_id = rand(10,100);
                    $subscription_add->name    = $name;
                    $subscription_add->stripe_id = rand(10,100);
                    $subscription_add->stripe_status  = true;
                    $subscription_add->stripe_price  = $product->price;
                    $subscription_add->quantity  = 1;    
                   
                    $subscription_add->save();

                    $value =  'Your product has been purchesed successfully';
                    $status = true;
                    return view('home', compact('status','value')); 
                   
                       
                }else{
                    
                    $value =  'Your Card Number is Invalid';
                    $status = false;
                    return view('home', compact('status','value'));  
                }

            }catch (\Stripe\Exception\CardException $e) {
               
                $value =  $e->getError()->message.' failed to proceed payment Please try again later';
                $status = false;
                return view('home', compact('status','value'));  
            }
            
        }
        
    }

    public function createProduct()
    {
        $errors = null;
        return view('products.create',compact('errors'));
    }

    public function storeProduct(Request $request)
    { 
        
        $validator = Validator::make($request->all(), [
            'name'        =>  'required|regex:/^[a-zA-Z]+$/u',
            'price'       =>  'required|numeric',
            'description' =>  'required',
        ]);

        if ($validator->fails()) {

            $error_names = ['name','price','description'];

            $error = $validator->errors(); 
            $myArray = json_decode($error, true);

            foreach($error_names as $val){
                if(array_key_exists($val,$myArray))
                {
                    $errors[$val] = $myArray[$val][0];
                }else
                {
                    $errors[$val] = ' ';
                }
            }
            return view('products.create', compact('errors'));
           
        } else {
        
            $data['name'] = strtolower($request->name);
            $data['price'] = $request->price;
            $data['description'] = $request->description;
        
                
            \Stripe\Stripe::setApiKey(env('STRIPE_PUBLIC_KEY'));
            \Stripe\Stripe::setApiKey(env('STRIPE_SECRET_KEY'));
            
            //Add Product Name
            $product = \Stripe\Product::create([
                'name' => $request->name,
                'description' => $request->description,
            ]);
        
            //Set Plan for Product
            $plan =\Stripe\Plan::create([
                'active'      => true,
                'amount'      => $request->price*100,
                'currency'    => 'inr',
                'interval'    => 'month',
                "product"     => ["name" => $product->name],    
            ]);
                                
            //Set Product Plan and Price
            $price = \Stripe\Price::create([
                'unit_amount' => $plan->amount,
                'currency'    => $plan->currency,
                'recurring'   => ['interval' => $plan->interval],
                'product'     => $product->id,
            ]);  
                                        
                
            $random = rand(10,100);

            $add_item =  new SubscriptionItem();
            $add_item->subscription_id = $random;
            $add_item->stripe_id = $random;
            $add_item->stripe_product = $request->name;
            $add_item->stripe_price = $request->price;
            $add_item->quantity = 1;
            $add_item->save();

            product::create($data);

            $value =  'product has been created succeefully';
            $status = true;
            return view('home', compact('status','value')); 
        }
    }
}   
