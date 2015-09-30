
	
<!-- 	<div class="jumbotron">
  <h1>მოგესალმებით!</h1>
  <p>ავიაგადაზიდვების ყველაზე მოსახერხებელი სერვისი</p>
  <p><a class="btn btn-primary btn-lg" href="#" role="button">გაიგე მეტი</a></p>
</div> -->
<section>
  <div class="section-address">
   <ul class="address">
   <span>მისამართი ჩინეთში (ჩინურად)</span>
     <li>FULL NAME:<span>
     <?php if ( empty($user) ): ?>
     -SAXELI GVARI-
 	<?php else:
 	echo $user['name_en'];
 	endif; ?>
     </span></li>
     <li>ADDRESS:<span>广东省深圳市宝安区福永街道新和社区东八巷18栋 首层，翟涛 转 格鲁吉亚 
     <?php if ( empty($user) ): ?>
     TSG*****
 	<?php else:
     echo 'TSG'.str_pad($user['id'],5,'0',STR_PAD_LEFT);
     endif; ?>
     </span></li>
     <li>CITY:<span>深圳市 罗湖区</span></li>
     <li>PROVINCE:<span>广东</span></li>
     <li>DISTRICT:<span>Bao'an District</span></li>
     <li>POSTAL CODE:<span>518002</span></li>
     <li>PHONE:<span>13510575029</span></li>
     <li>OFFICE:<span>86-0755-36630647</span></li>
   </ul>
     <ul class="address">
    <span>მისამართი ჩინეთში (ინგლისურად)</span>
     <li>FULL NAME:<span>
     	 <?php if ( empty($user) ): ?>
     -SAXELI GVARI-
 	<?php else:
 	echo $user['name_en'];
 	endif; ?>
     </span></li>
     <li>ADDRESS:<span>1 Floor, B18 building,8 Alley East of Xinhe , Fuyong,Baoan 
	 <?php if ( empty($user) ): ?>
     TSG*****
 	<?php else:
     echo 'TSG'.str_pad($user['id'],5,'0',STR_PAD_LEFT);
     endif; ?>
     </span></li>
     <li>CITY:<span>Shenzhen</span></li>
     <li>PROVINCE:<span>Guangdong</span></li>
     <li>DISTRICT:<span>Bao'an District</span></li>
     <li>POSTAL CODE:<span>518002</span></li>
     <li>PHONE:<span>13510575029</span></li>
     <li>OFFICE:<span>86-0755-36630647</span></li>
   </ul>
  </div>
  <div class="section_price">
    <p>თუ ვერ ახერხებთ ნივთის დამოუკიდებლად გამოწერას ან არ გაქვთ ბარათი მაშინ შეავსეთ შემდეგი ფორმა და ჩვენ გამოგიწერთ! <a href="https://docs.google.com/forms/d/1enc206nutJnLSpP65NO-u6fyz0jSKI7vqyrFRbjyo-A/viewform?c=0&w=1" style="color:red;">გადადი ფორმაზე</a></p>
  </div>
  <div class="section_price">
    <p>1კგ ტვირთის ტრანსპორტირება ფიზ.პირი:7.9$</p>
    <p>1კგ ტვირთის ტრანსპორტირება იურ.პირი:7.0$</p>
  </div>
<div class="left-section">
  <div class="convertacia">
  <p>ვალუტის კონვერტაცია</p>
	<form name="currency" method="post">
    <p><img src="<?php echo base_url('images/yuan.svg'); ?>" height="15" width="15"/>&nbsp<input name="c0" onkeyup="currency_convert(0)" type="text"></p>
    <p><img src="<?php echo base_url('images/lari.svg.png'); ?>" height="15" width="15"/>&nbsp<input name="c1" onkeyup="currency_convert(1)" type="text"></p>
  </form>
  </div>
  <div class="wona">
  <form method=post name=mnishvneloba>
  <p>მოცულობით წონის კალკულატორი</p>
    <input class=vconas onkeyup=vcona() name=length size="10">&nbspსიგანე(სმ)<br>
    <input class=vconas onkeyup=vcona() name=width size="10">&nbspსიგრძე(სმ)<br>
    <input  class=vconas onkeyup=vcona() name=height size="10">&nbspსიმაღლე(სმ)<br>
    <input readOnly name=price class=gamot size="25" style="appearance:none;">
    </form>
	</div>
</div>
	<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo base_url('images/truck.png'); ?>" alt="...">
      <div class="caption">
        <h3>სახმელეთო</h3>
        <p>სახმელეთო ტრანსპორტირება ჩინეთიდან</p>
        <p><a href="http://tsgeoline.com/" class="btn btn-primary" role="button" target="_blank">გადასვლა</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo base_url('images/cargo.png'); ?>" alt="...">
      <div class="caption">
        <h3>საზღვაო</h3>
        <p>საზღვაო ტრანსპორტირება ჩინეთიდან</p>
        <p><a href="http://tsgeoline.com/" class="btn btn-primary" role="button" target="_blank">გადასვლა</a>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <img src="<?php echo base_url('images/air.png'); ?>" alt="...">
      <div class="caption">
        <h3>საჰაერო</h3>
        <p>საჰაერო ტვირთების ჩამოტანა ჩინეთიდან ყველაზე იაფად</p>
        <p><a href="http://tsgeoline.com/" class="btn btn-primary" role="button" target="_blank">გადასვლა</a> 
      </div>
    </div>
  </div>
</div>


</section>
