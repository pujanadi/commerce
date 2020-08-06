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
		<a href="<?php echo base_url();?>"><input type="button" value="Back"/></a>

		<table>
			<tr>
				<td colspan="3">Checkout</td>
			</tr>

			<tr>
				<td colspan="3"><b>Alamat</b></td>
			</tr>
            <tr>
                <td><?php echo $user->alamat;?></td>
            </tr>
            <tr>
                <td colspan="3"><b>Item</b></td>
            </tr>
            <?php
                foreach ($items as $item)
            {
            ?>
            <tr>
                <td><?php echo $item->nama_barang;?></td>
                <td><?php echo $item->jumlah . 'x';?></td>
                <td>Rp. <?php echo $item->harga;?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="2">Subtotal</td>
                <td>Rp.
                    <?php
                    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::DECIMAL );
                    echo $fmt->format($totalTransactionAmount);
                    ?>
                </td>
            </tr>

            <tr>
                <td><b>Ekspedisi</b></td>
            </tr>
            <tr>
                <td>JNE</td>
            </tr>
            <tr>
                <td><b>Catatan</b></td>
            </tr>
            <tr>
                <td>-</td>
            </tr>
            <tr>
                <td><b>Metode Pembayaran</b></td>
            </tr>
            <tr>
                <td>Virtual Account</td>
            </tr>
            <tr>
                <td><b>Total Pembayaran</b></td>
            </tr>
            <tr>
                <td>Rp.
                    <?php
                    $fmt = new NumberFormatter( 'de_DE', NumberFormatter::DECIMAL );
                    echo $fmt->format($totalTransactionAmount);
                    ?>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="<?php echo base_url() . '/Ecommerce/bayar'?>">
                        <input type="button" value="Bayar" />
                    </a>
                </td>
            </tr>

		</table>
	</body>

</html>