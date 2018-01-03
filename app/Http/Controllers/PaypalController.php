<?php

namespace App\Http\Controllers;

use PayPal\Api\Item;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Payment;
use PayPal\Api\ItemList;
use PayPal\Api\Transaction;
use PayPal\Rest\ApiContext;
use Illuminate\Http\Request;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Auth\OAuthTokenCredential;

class PaypalController extends Controller
{
	private $_api_context;

	public function __construct()
    {
    	// setup  paypal api context
    	$paypal_conf = \Config::get('paypal');
    	$this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
		$this->_api_context->setConfig($paypal_conf['settings']);
    }


    public function postPayment()
    {
    	$payer = new Payer();
    	$payer->setPaymentMethod('paypal');

    	$items = array();
    	$subtotal = 0;
    	$cart = \Session::get('cart');
    	$currency = 'USD';

    	foreach ($cart as $product) {
    		$item = new Item();
    		$item->setName($product->name)
    		->setCurrency($currency)
    		->setDescription($product->extract)
    		->setQuantity($product->quantity)
    		->setPrice($product->price);

    		$items[] = $item;
    		$subtotal += $product->quantity * $product->price;
    	}

    	$item_list = new ItemList();
    	$item_list->setItems($items);

    	//consto de envio 100
    	$details = new Details();
    	$details->setSubtotal($subtotal)
    		->setShipping(100);

    	$total = $subtotal + 100;
    	$amount = new Amount();
    	$amount->setCurrency($currency)
    		->setTotal($total)
    		->setDetails($details);

    	$transaction = new Transaction();
    	$transaction->setAmount($amount)
    		->setItemList($item_list)
    		->setDescription('Pedido de prueba con Laravel 5.5');

    	$redirect_urls = new RedirectUrls();
    	$redirect_urls->setReturnUrl(\URL::route('payment.status'))
    		->setCancelUrl(\URL::route('payment.status'));

    	$payment = new Payment();
    	$payment->setIntent('sale')
    		->setPayer($payer)
    		->setRedirectUrls($redirect_urls)
    		->setTransactions(array($transaction));

    	try {
    		$payment->create($this->_api_context);
    	} catch (\Paypal\Exception\PPConnectionException $e) {
    		if (\Config::get('app.debug')) {
    			echo  "Exception: ". $e->getMessage() . PHP_EOL;
    			$err_data = json_decode($e->getData(), true);
    			exit;
    		}else{
    			die('Ups: Algo salio mal');
    		}
    	}

    	foreach ($payment->getLinks() as $link) {
    		if ($link->getRel() == 'approval_url') {
    			$redirect_url = $link->getHref();
    			$break;
    		}	
    	}
		
    	//add Playment a Session
    	\Session::put('paypal_payment_id',$payment->id);

    	if (isset($redirect_url)) {
    		return \Redirect::away($redirect_url);
    	}

    	return \Redirect::route('cart-show')
    		->with('message', 'Ups! Error desconocido');
    }

    public function getPaymentStatus()
    {
    	//Get playment ID
    	$payment_id = \Session::get('paypal_payment_id');

    	//clear ssesion payment_id
    	

    	$payerId = \Input::get('PayerID');
		$token = \Input::get('token');

    	if (empty($payerId) || empty($token)) {
    		return \Redirect::route('cart-show')
    			->with('message', 'Hubo un error al intentar pagar con paypal');
    	}

    	$payment = Payment::get($payment_id, $this->_api_context);

    	$execution = new PaymentExecution();
    	$execution->setPayerId(\Input::get('PayerID'));

    	$result = $payment->execute($execution, $this->_api_context);

    	if ($result->getState() == 'approved') {
    		// Registrar el pedido --- ok
			// Registrar el Detalle del pedido  --- ok
			// Eliminar carrito 
			// Enviar correo a user
			// Enviar correo a admin
			// Redireccionar

    		return \Redirect::route('cart-show')
    			->with('message', 'Compra realizada correctamente');
    	}
    	return \Redirect::route('cart-show')
    			->with('message', 'La compra fue cancelada');
    }
}
