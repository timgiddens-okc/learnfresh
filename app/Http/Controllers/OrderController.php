<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ShippingList;
use App\KitOrder;

class OrderController extends Controller
{
    public function createNew()
    {
	    return view("orders.create-new");
    }
    
    public function kit()
	{
		$orders = KitOrder::orderBy('created_at','desc')->get();
		
		return view("admin.kit-orders", [
			'orders' => $orders
		]);
	}
    
    public function pending()
	{
		$orders = ShippingList::where('archived',0)->orderBy('created_at','desc')->get();
		
		return view("admin.shipping", [
			'orders' => $orders
		]);
	}
	
	public function addOrder(Request $request){
		$lastOrder = ShippingList::orderby('created_at','desc')->first();
		$orderNumber = \Carbon\Carbon::now()->format("Ymd") . "001";	
		if($lastOrder){
			if($orderNumber <= $lastOrder->order_number){
				$orderNumber = $lastOrder->order_number + 1;
			}
		}
		$shipStation = new \LaravelShipStation\ShipStation(getenv('SS_KEY'), getenv('SS_SECRET'));
		$order = new \LaravelShipStation\Models\Order();
		
		$address = new \LaravelShipStation\Models\Address();		
		$address->name = $request->input('recipient');
	    $address->street1 = $request->input('address_1');
	    $address->city = $request->input('city');
	    $address->state = $request->input('state');
	    $address->postalCode = $request->input('post_code');
	    $address->country = "US";
	    $address->phone = $request->input('phone');	
	
		if($request->input('game-quantity')){

		    $item = new \LaravelShipStation\Models\OrderItem();

		    $item->lineItemKey = '1';
		    $item->sku = 48720;
		    $item->name = "Game";
		    $item->quantity = $request->input('game-quantity');
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;		

			ShippingList::create([
			    "order_number" => $orderNumber,
			    "item" => 48720,
			    "quantity" => $request->input('game-quantity'),
			    "recipient" => $request->input('recipient'),
			    "company" => $request->input('company'),
			    "address_1" => $request->input('address_1'),
			    "address_2" => $request->input('address_2'),
			    "city" => $request->input('city'),
			    "state" => $request->input('state'),
			    "post_code" => $request->input('post_code'),
			    "country" => $request->input('country'),
			    "phone" => $request->input('phone'),
			    "ship_method" => $request->input('ship_method'),
			    "sender_email" => $request->input('sender_email'),
			    "sender_email_2" => $request->input('sender_email_2'),
			    "notes" => $request->input('notes'),
			    "submitted_by" => 1
		    ]);

		  }
		    
		  if($request->input('cards-quantity')){
			$item = new \LaravelShipStation\Models\OrderItem();

		    $item->lineItemKey = '2';
		    $item->sku = 48826;
		    $item->name = "Cards";
		    $item->quantity = $request->input('cards-quantity');
		    $item->unitPrice = "0.00";
		    
		    $order->items[] = $item;
			  
		    ShippingList::create([
			    "order_number" => $orderNumber,
			    "item" => 48826,
			    "quantity" => $request->input('cards-quantity'),
			    "recipient" => $request->input('recipient'),
			    "company" => $request->input('company'),
			    "address_1" => $request->input('address_1'),
			    "address_2" => $request->input('address_2'),
			    "city" => $request->input('city'),
			    "state" => $request->input('state'),
			    "post_code" => $request->input('post_code'),
			    "country" => $request->input('country'),
			    "phone" => $request->input('phone'),
			    "ship_method" => $request->input('ship_method'),
			    "sender_email" => $request->input('sender_email'),
			    "sender_email_2" => $request->input('sender_email_2'),
			    "notes" => $request->input('notes'),
			    "submitted_by" => 1
		    ]);
		  }
		  
		$order->orderNumber = $orderNumber;
	    $order->orderDate = \Carbon\Carbon::now()->toDateString();
	    $order->orderStatus = 'awaiting_shipment';
	    $order->amountPaid = '0.00';
	    $order->taxAmount = '0.00';
	    $order->shippingAmount = '0.00';
	    $order->internalNotes = $request->input('notes');
	    $order->billTo = $address;
	    $order->shipTo = $address;
		
		$shipStation->orders->post($order, 'createorder');
		
		\Session::flash('alert-success', 'The order has been added!');
		return back();
	}
	
	public function editOrder(ShippingList $shippingList)
	{
		return view("admin.edit-shipping", [
			"order" => $shippingList
		]);
	}
	
	public function updateOrder(Request $request, ShippingList $shippingList)
	{
		$shippingList->update($request->all());
		$orderNumber = $shippingList->order_number;
		$items = ShippingList::where('order_number', $orderNumber)->get();
		foreach($items as $item){
			$item->recipient = $request->input('recipient');
			$item->company = $request->input('company');
			$item->address_1 = $request->input('address_1');
			$item->address_2 = $request->input('address_2');
			$item->city = $request->input('city');
			$item->state = $request->input('state');
			$item->post_code = $request->input('post_code');
			$item->country = $request->input('country');
			$item->phone = $request->input('phone');
			$item->ship_method = $request->input('ship_method');
			$item->recipient_email = $request->input('recipient_email');
			$item->sender_email = $request->input('sender_email');
			$item->sender_email_2 = $request->input('sender_email_2');
			$item->save();
		}
		\Session::flash('alert-success', "The order has been updated!");
		return redirect("/admin/orders/pending");
	}
	
	public function sortShipping(Request $request)
	{
	  $allorders = ShippingList::where('archived',0)->get();
	  
	  $orderNumber = $request->input('order_number');
	  
	  if($orderNumber == ""){
		  $orderNumber = null;
	  }
	  
	  $sorting = array();
	  
	  if($request->input('recipient') != 'null')
	  	$sorting[] = ["recipient", "=", $request->input('recipient')];
	  	
	  if($orderNumber != null)
	  	$sorting[] = ["order_number", "=", $orderNumber];
	  	
	  if($request->input('state') != 'null')
	  	$sorting[] = ["state", "=", $request->input('state')];
	  	
	  if($request->input('post_code') != 'null')
	  	$sorting[] = ["post_code", "=", $request->input('post_code')];
	  
	  if($request->input('country') != 'null')
	  	$sorting[] = ["country", "=", (int)$request->input('country')];
	  	
	  $sorting[] = ["archived","=",0];
	  	
	  $orders = ShippingList::where($sorting)->get();
	  
	  return view('admin.shipping-sorted', [
		  "orders" => $orders,
	    "allorders" => $allorders
	  ]);
	}
	
	public function deleteOrder(ShippingList $shippingList){
		$shippingList->delete();
		\Session::flash('alert-success', 'The order has been deleted!');
		return back();
	}
	
	public function past()
	{
		$orders = ShippingList::where("archived", 1)->orderBy("created_at","desc")->paginate(15);
		
		return view("orders.all", [
			"orders" => $orders
		]);
	}
	
	public function searchOrders(Request $request)
	{
		$orders = ShippingList::where('order_number','like', '%'.$request->input('query').'%')->orWhere('item','like', '%'.$request->input('query').'%')->orWhere('recipient','like', '%'.$request->input('query').'%')->orWhere('company','like', '%'.$request->input('query').'%')->orWhere('address_1','like', '%'.$request->input('query').'%')->orWhere('address_2','like', '%'.$request->input('query').'%')->orWhere('city','like', '%'.$request->input('query').'%')->orWhere('state','like', '%'.$request->input('query').'%')->orWhere('post_code','like', '%'.$request->input('query').'%')->orWhere('country','like', '%'.$request->input('query').'%')->orWhere('phone','like', '%'.$request->input('query').'%')->orWhere('ship_method','like', '%'.$request->input('query').'%')->orWhere('recipient_email','like', '%'.$request->input('query').'%')->orderby('created_at','desc')->get();
		
		return view("orders.list", [
			"orders" => $orders
		]);
	}
	
	public function allOrders()
	{
		$orders = ShippingList::where('archived',0)->orderBy('created_at','desc')->get();
		
		return view("orders.list", [
			'orders' => $orders
		]);
	}
	
	public function pastOrders()
	{
		$orders = ShippingList::where('archived',1)->orderBy('created_at','desc')->get();
		
		return view("orders.list", [
			'orders' => $orders
		]);
	}
	
	public function incentives()
	{
		return view("orders.incentives");
	}
	
	public function catalog()
	{
		return view("orders.warehouse.catalog");
	}
	
	public function inventoryOnHand()
	{
		return view("orders.warehouse.inventory-on-hand");
	}
	
	public function updateInventory()
	{
		return view("orders.warehouse.update-inventory");
	}
	
	public function pastInventory()
	{
		return view("orders.warehouse.past-inventory");
	}
}
