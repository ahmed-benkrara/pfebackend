<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Http\Resources\OrderResource;
use App\Http\Requests\OrderRequest;
use App\Traits\HttpResponses;

class OrderController extends Controller
{
    use HttpResponses;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return OrderResource::collection(
            Order::all()
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $request->validated();
        $order = Order::create([
            'user_id' => $request->user_id,
            'status' => $request->status,
            'orderdate' => $request->orderdate,
            'shipdate' => $request->shipdate
        ]);
        return new OrderResource($order);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        if($order){
            return $this->success(new OrderResource($order));
        }else{
            return $this->error(null, 'Order Not Found', 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        if($order){
            $order->update($request->all());
            return $this->success(new OrderResource($order), "Updated successfully", 200);
        }else{
            return $this->error(null, "Order not found", 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        if($order != null){
            $order->delete();
            return $this->success(null, 'Deleted successfully', 204);
        }else{
            return $this->error(null,'Order not found', 404);
        }
    }
}
