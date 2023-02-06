<?php

use Gloudemans\Shoppingcart\Facades\Cart;

function cart(){
    $cart=Cart::content();
    return $cart;
}