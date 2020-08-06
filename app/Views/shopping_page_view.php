<html>
	<head>
	</head>
	
	</body>
        <?php
        ini_set('display_errors', 1);

        $session = \Config\Services::Session();

            if($session->dataLogin){
                $user = (object) $session->dataLogin;
                echo 'Hi, ' . $user->name;
            } else {
                redirect(base_url());
            }
        ?>

		<a href="<?php echo base_url() . "/Ecommerce/showCart";?>"><input type="button" value="My Cart"/></a>
	
		<?php 
			echo isset($addToCartStatus) ? "Add to cart success" : "";
			//unset($addToCartStatus);
		?>
		<table>
			<?php 
				foreach ($barang as $tmp){
				$object = (object) $tmp
			?>
			<tr>
				<td colspan="2"><?php echo $object->nama_barang;?></td>
			</tr>
			<tr>
				<td colspan="2">
				<?php 
					$fmt = new NumberFormatter( 'de_DE', NumberFormatter::DECIMAL );
					echo $fmt->format($object->harga);
				?></td>
			</tr>
			<tr>
				<td><a href="<?php echo base_url() . "/Ecommerce/addToCart/$object->id";?>"><input type="button" value="Add to cart"/></a></td>
				<td><input type="button" value="Buy"/></td>
			</tr>
			<?php }?>
		</table>
	</body>

</html>