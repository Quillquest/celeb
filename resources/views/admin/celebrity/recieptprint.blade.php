

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
    <title>{{$settings->site_name}} | ENF-1000124</title>
	
	<!-- Define Charset -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<!-- Page Description and Author -->
	<meta name="description" content="               We are one of the leading company in service customer, internationally. We provide immediate and safe solutions to all our customers through the modality of shipping door to door, for several countries of the world, offering our clients a service of fast delivery and the best price of the market."/>
	<meta name="keywords" content=" {{$settings->site_name}} delivery, courier, delivery, shipping, box, package, delivery express, invoices" />
    <meta name="author" content="Remedy">	
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.4 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="css/print-invoice.min.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
	<script src="barcode.js"></script>
  </head>
  <body onload="window.print();">
    <div class="wrapper">

      <!-- Main content -->
      <section class="invoice">
        <!-- title row -->
        <div class="row">
          <div class="col-xs-12">
            <h2 class="page-header">
			  <span><img src="../logo-image/image_logo.php?id=1" width="150" height="39" ></span>
              <small class="pull-right">Wednesday 20 de September del 2023</small>
            </h2>
          </div><!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
          <div class="col-sm-4 invoice-col">
            SENDER            <address>
              <h4><strong>Eva Covac</strong></h4><br>

               <b>Phone:</b>  +15613180339<br/>
              <b>Address:</b> 42 Wartnaby Road, Acton Trussell,United Kingdom<br/>
			  <b>Country Origin:</b> United States<br/>
			 
			 
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
            RECIPIENT            <address>
              <h4><strong>Dalmadi Ilona katalin</strong></h4><br>
              
              <b>:</b> +36209993080<br/>
			  <b>Telephone 2:</b> <br/>
			  <b>Address:</b> jaszbereny Bartok bela <br/>
			  <b>Email:</b> k.I.d.holly@gmail.com<br/>
              <b>Destination Country:</b> Hungary<br/>
			 
			  
            </address>
          </div><!-- /.col -->
          <div class="col-sm-4 invoice-col">
		  <table>
				<tr>
					<td>
						<center>
							<img src="barcode/barcode.processor.php?encode=CODE39&bdata=ENF-1000124&height=50&scale=1&bgcolor=%23FFFFFF&color=%23000000&showData=1&file=&folder=&type=png&Genrate=Create+Barcode">						

						</center>
					</td>
					
				</tr>
			</table>
			<br/>           
            <b>Shipping Weight:</b>&nbsp;3&nbsp; Kg<br/>
			<b>Payment Method:</b> <small class="label label-danger"><i class="fa fa-money"></i>&nbsp;&nbsp;Transfer</small><br/> 
			<b>Shipping Insurance:</b>&nbsp;USD&nbsp;<br/>
          </div><!-- /.col -->		 
        </div><!-- /.row -->

        <!-- Table row -->
        <div class="row">
          <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Quantity</th>
                  <th>Product</th>
                  <th>State</th>
                  <th>Description</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Box</td>
                  <td><small class="label label-success">Approved </small></td>
                  <td></td>
                  <td>USD&nbsp;$0</td>
                </tr>               
              </tbody>
            </table>
          </div><!-- /.col -->
        </div><!-- /.row -->
		<br>
		<br>
        <div class="row">
          <!-- accepted payments column -->
          <div class="col-xs-6">
            <p class="lead">Methods of Payment:</p>
            <img src="../img/credit/securepayment.png" alt="Methods payments" />           
            <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
              For your convenience we have several reliable, fast and secure payments.            </p>
          </div><!-- /.col -->
          <div class="col-xs-6">
            <p class="lead">Amount</p>
            <div class="table-responsive">
              <table class="table">
                <tr>
                  <th style="width:50%">Subtotal:</th>
                  <td>USD&nbsp;$0</td>
                </tr>
                <tr>
                  <th>Total:</th>
                  <td>USD&nbsp;$0</td>
                </tr>
              </table>
            </div>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- ./wrapper -->

    <!-- AdminLTE App -->
    <script src="js/app.min.js" type="text/javascript"></script>
  </body>
</html>
