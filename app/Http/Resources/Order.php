<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Order extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'OrderId' => $this->id,
            'OrderCode' => date_format($this->created_at, 'Y-m-') . $this->id,
            'OrderDate' => date_format($this->created_at, 'Y-m-d'),
            'TotalAmountWithoutDiscount' => $this->totalAmount(),
            'TotalAmountWithDiscount' => $this->totalAmount() - $this->totalDiscount()
        ];
    }
}
