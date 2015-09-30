<!doctype html>

<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Sample Invoice</title>
    <link rel="stylesheet" href="<?php echo base_url('css/bootstrap.css'); ?>">
    <style>
      @import url(http://fonts.googleapis.com/css?family=Bree+Serif);
      body, h1, h2, h3, h4, h5, h6{
      font-family: 'Bree Serif', serif;
      }
    </style>
  </head>
  
  <body>
  <script type="text/javascript">$(document).ready(function() {
 $('ul#tools').prepend('<li class="print"><a href="#print">Click me to print</a></li>');
 $('ul#tools li.print a').click(function() {
  window.print();
  return false;
 });
}); 
</script>
  <a href="#" onclick="window.print(); return false;">ამობეჭდვა</a> 
    <div class="container">
      <div class="row">
        <div class="col-xs-6">
          <h1>
            <img src="<?php echo base_url('images/tsexpress.png');?>" width="120">
          </h1>
        </div>
        <div class="col-xs-6 text-right">
          <h1>INVOICE</h1>
          <h1><small>ინვოისის #<?php echo $invoice->amanati; ?></small></h1>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>შპს კომპანია</h4>
            </div>
            <div class="panel-body">
              <p>
                საქართველო, ქალაქი თბილისი, ქავთარაძის ქ. N27 <br>
                info@tsexpress.ge <br>
                (032) 219 22 42  <br>
                www.tsexpress.ge  <br>
              </p>
            </div>
          </div>
        </div>
        <div class="col-xs-5 col-xs-offset-2 text-right">
          <div class="panel panel-default">
            <div class="panel-heading">
              <h4>მიმღები:<?php echo $invoice->is_company==0 ? $invoice->name_ge:$invoice->company_name ?></h4>
            </div>
            <div class="panel-body">
              <p>
                <?php echo $invoice->is_company==0 ? $invoice->personal_id:$invoice->company_id ?> <br>
                <?php echo $invoice->address; ?> <br>
                <?php echo $invoice->mobile; ?> <br>
                <?php echo $invoice->email; ?> <br>
              </p>
            </div>
          </div>
        </div>
      </div>
      <!-- / end client details section -->
      <table class="table table-bordered">
        <thead>
          <tr>
            <th>
              <h4>ამანათის ნომერი</h4>
            </th>
            <th>
              <h4>წონა</h4>
            </th>
            <th>
              <h4>ფასი</h4>
            </th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td><?php echo $invoice->amanati; ?></td>
            <td class="text-right"><?php echo $invoice->weight; ?> კგ</td>
            <td class="text-right"><?php echo $invoice->price; ?> ლარი</td>
          </tr>
        </tbody>
      </table>
      <div class="row text-right">
        <div class="col-xs-2 col-xs-offset-8">
          <p>
            <strong>
            სულ : <br>
            </strong>
          </p>
        </div>
        <div class="col-xs-2">
          <strong>
          <?php echo $invoice->price; ?> ლარი <br>
          </strong>
        </div>
      </div>
      <div class="row">
        <div class="col-xs-5">
          <div class="panel panel-info">
            <div class="panel-heading">
              <h4>საბანკო რეკვიზიტები</h4>
            </div>
            <div class="panel-body">
              <p>შპს კომპანია:ტრანსპორტ სერვის ჯგუფი</p>
              <p>ბანკის კოდი</p>
              <p>ანგარიშის ნომერი</p>
              <p>დანიშნულება:თანხის დარიცხვისას მიუთითეთ ოთახის ნომერი <?php echo 'TSG'.str_pad($invoice->kodi,5,'0',STR_PAD_LEFT); ?></p>
              <p></p>
            </div>
          </div>
        </div>
        <div class="col-xs-7">
          <div class="span7">
            <div class="panel panel-info">
              <div class="panel-heading">
                <h4>საკონტაქტო ინფორმაცია</h4>
              </div>
              <div class="panel-body">
                <p>
                  ელ.მისამართი : info@tsexpress.ge <br><br>
                  ტელეფონი : (032) 219 22 42  <br> <br>
                  სოც.ქსელი : <a href="https://facebook.com/tsexpress.ge" target="_blank">fb.com/tsexpress.ge</a>
                </p>
                <h4>გადახდა უნდა განხორციელდეს საბანკო გადმორიცხვით</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>