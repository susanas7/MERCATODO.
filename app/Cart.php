<?php

namespace App;

class Cart
{
    public $items = null;
    public $unitPrice = 0;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if ($oldCart) {
            $this->items = $oldCart->items;
            $this->unitPrice = $oldCart->unitPrice;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /**
     * Add an item to cart.
     *
     * @param object $item
     * @param int $id
     */
    public function add(object $item, int $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if ($this->items) {
            if (array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->unitPrice = $storedItem['price'];
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }

    /**
     * Reduce by one to cart.
     *
     * @param int $id
     */
    public function reduceByOne(int $id)
    {
        $this->items[$id]['qty']--;
        $this->items[$id]['price'] -= $this->items[$id]['item']['price'];
        $this->totalQty--;
        $this->totalPrice -= $this->items[$id]['item']['price'];

        if ($this->items[$id]['qty'] <= 0) {
            unset($this->items[$id]);
        }
    }

    /**
     * Add by one to cart.
     *
     * @param int $id
     */
    public function addByOne(int $id)
    {
        $this->items[$id]['qty']++;
        $this->items[$id]['price'] += $this->items[$id]['item']['price'];
        $this->totalQty++;
        $this->totalPrice += $this->items[$id]['item']['price'];
    }

    /**
     * Remove all the item to cart.
     *
     * @param int $id
     */
    public function removeItem(int $id)
    {
        $this->totalQty -= $this->items[$id]['qty'];
        $this->totalPrice -= $this->items[$id]['price'];
        unset($this->items[$id]);
    }
}
