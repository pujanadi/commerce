<html>
	<head>
	</head>
	
	</body>
        <?php echo form_open('../Ecommerce/checkout');?>
		<a href="<?php echo base_url();?>"><input type="button" value="Back"/></a>

		<table>
			<tr>
				<td colspan="3">My Cart</td>
			</tr>

			<tr>
				<td>Item</td>
				<td>Qty</td>
				<td>Price</td>
                <td></td>
			</tr>
            <?php
            $subtotal = 0;
            if(isset($items)){
                foreach($items as $item){
                    $subtotal += $item->harga;
            ?>
			<tr>
				<td><?php echo $item->nama_barang;?></td>
				<td><?php echo $item->jumlah;?></td>
                <td><?php echo $item->harga;?></td>

                <input type="hidden" name="items_id[]" value="<?php echo $item->id;?>" />
                <input type="hidden" name="items_qty[]" value="<?php echo $item->jumlah;?>" />
			
				<td><a href="<?php echo base_url() . "/Ecommerce/removeFromCart/$item->id";?>"><input type="button" value="Remove from cart"/></a></td>
			</tr>
            <?php
                }
            }
            ?>
            <tr>
                <td>Total</td>
                <td></td>
                <td><?php echo $subtotal; ?></td>

            </tr>


			<tr>
				<td colspan="4">
					<a href="<?php echo base_url() . "/Ecommerce/checkout";?>"></a>

                    <input type="submit" value="Checkout now!"/>
				</td>
			</tr>
		</table>
	</body>

</html>