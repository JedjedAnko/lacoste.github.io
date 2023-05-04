<?php

?>
<form method="post" action="buy.php">
    <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
    <input type="hidden" name="quantity" value="<?php echo $quantity; ?>">
    <input type="submit" name="buy_now" value="Buy Now">
</form>