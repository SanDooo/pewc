<?php
/*
 * Filter cart items count to remove composite products from total
 */
if ( ! function_exists( 'filter_woocommerce_cart_contents_count' ) ) {
	/**
	 * Get number of items in the cart.
	 *
   * @param   int $count  Number of items in the cart.
	 * @return  int
	 */
  function filter_woocommerce_cart_contents_count( $count ) {

    $cart = WC()->cart->get_cart();
    // Count composite products children
    $children = count(
      array_filter( $cart, function( $item ) {
        return ! empty( $item['product_extras']['products']['child_field'] );
      } )
    );

    // Remove child products from total
    return $count - $children;
  }
}
add_filter( 'woocommerce_cart_contents_count', 'filter_woocommerce_cart_contents_count' );