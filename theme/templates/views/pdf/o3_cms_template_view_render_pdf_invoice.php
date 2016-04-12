<!DOCTYPE html>
<head>
	<meta charset="utf-8" />
	<title><?php echo $this->title(); ?></title>

	<style type="text/css">

		body, html {
			font-family: Montserrat, sans-serif;
			color: #000;
			font-size: 16px; 			
		}

		.pdf-content {
			width: 635px;
			padding: 0px;
			margin: 30px auto 30px auto;  
			position: relative; 
		}

		h1 {
			color: #000;
			font-size: 35px;
		}

		p, h1, h2, h3, h4, h5, h6 {
			padding: 0px;
			margin: 0px;
		}

		a {
			color: rgb(169, 207, 84);
			text-decoration: none;
		}

		.left {
			text-align: left;
		}

		.right {
			text-align: right;
		}

		.header {
			display: table; 
			width: 100%;
		}

		.header > div {
			display: table-row;
		}

		.header > div > div {
			display: table-cell;
			vertical-align: middle;
		}

		.data {
			display: table; 
			width: 50%;
		}

		.data > div {
			display: table-row;
		}

		.data > div > div {
			display: table-cell;
			vertical-align: middle;
		}

		.products {
			display: table; 	
			width: 100%;
		}

		.products > div {
			display: table-row;
		}

		.products > div > div {
			display: table-cell;
			vertical-align: top;
			padding: 5px;
		}

		.products .th {
			background: #dddddd;
		}

		.products .price {
			text-align: right;
			width: 15%;
		}

		footer {
			position: absolute;
			width: 100%;
			text-align: center;
			bottom: 0px; 
		}

	</style>
</head>
<body>
	<div class="pdf-content">		
		
		<div class="header">
			<div>
				<div class="left">
					<h1>Invoice #<?php echo o3_html($this->payment->get('id')); ?></h1>
					<p>Date of invoice: <?php echo $this->payment->display_date(); ?></p>
				</div>
				<div class="right">
					<img src="<?php echo o3_get_host(); ?>/res/header-logo.png" height="40" alt="" />
				</div>
			</div>
		</div>

		<hr>

		<p><br></p>
		<p><br></p>
	
		<div class="data">
			<div>
				<div class="left">
					Account billed:
				</div>
				<div class="left">
					<?php echo o3_html($this->payment->get('username')); ?>
				</div>
			</div>
		</div>

		<p><br></p>

		<h3>Address:</h3>
		<p>
			<?php echo $this->address(); ?>			
		</p>

		<p><br></p>
		<p><br></p>
		<p><br></p>
		<p><br></p>
		<p><br></p>
		<p><br></p>
		<p><br></p>
		<p><br></p>

		<div class="products">
			<div>
				<div class="th product">
					Product
				</div>
				<div class="th price">
					Price
				</div>
			</div>
			<div>
				<div class="cell product">
					<?php echo o3_html($this->payment->get('product')); ?>
				</div>
				<div class="cell price">
					<?php echo o3_html($this->payment->display_price( $this->payment->get('total_excl_vat') ) ); ?>
				</div>
			</div>
		</div>

		<hr>

		<div class="products">
			<div>
				<div class="cell product right">
					Subtotal
				</div>
				<div class="cell price">
					<?php echo o3_html($this->payment->display_price( $this->payment->get('total_excl_vat') ) ); ?>
				</div>
			</div>
			<div>
				<div class="cell product right">
					VAT
				</div>
				<div class="cell price">
					<?php echo o3_html($this->payment->display_price( $this->payment->get('total_vat') ) ); ?>
				</div>
			</div>
		</div>
		
		<hr>

		<div class="products">
			<div>
				<div class="cell product right">
					<big>Total</big>
				</div>
				<div class="cell price">
					<big><?php echo o3_html($this->payment->display_price( $this->payment->get('total_incl_vat') ) ); ?></big>
				</div>
			</div>
		</div>

		<footer>
			snafer.co - <a href="mailto:contact@snafer.co">contact@snafer.co</a>
		</footer>

	</div>
</body>
</html>	