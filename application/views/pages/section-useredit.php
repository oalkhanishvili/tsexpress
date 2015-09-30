	<section>
	<div class="user-edit">
	<?php if ( validation_errors() == TRUE ): ?>
	<div class="error_message">
	<p><?php echo validation_errors(); ?></p>
	</div>
	<?php endif; ?>
	<form action="<?php echo site_url('user/useredit') ?>" method="post">
		<p><input type="text" name="username" placeholder="ნიკი" value="<?php echo $user_info['username']; ?>"/></p>
		<p><input type="password" name="password" placeholder="ახალი პაროლი" /></p>
		<p><input type="password" name="passconf" placeholder="გაიმეორეთ პაროლი" /></p>
		<p><input type="text" name="email" placeholder="ელ.მისამართი" value="<?php echo $user_info['email']; ?>"/></p><br>
		<p><input type="text" name="name_en" placeholder="სახელი და გვარი(ლათინურად)" value="<?php echo $user_info['name_en']; ?>"/></p>
		<p><input type="text" name="name_ge" placeholder="სახელი და გვარი(ქართულად)" onkeypress="return makeGeo(this,event)" value="<?php echo $user_info['name_ge']; ?>"/></p>
		<select name="day">
		<?php for ( $i=1; $i<=$day; $i++ ):
			if( $birthday[0][0] == $i){ ?>
		<option selected><?php echo $i; ?></option>
		<?php }else{ ?>
			<option><?php echo $i; ?></option>
		<?php }
		endfor; ?>
		</select>
		<select name="month">
		<?php foreach ( $month as $key =>$value ):
			if ( $birthday[0][1] == $value ){ ?>
		<option selected><?php echo $value; ?></option>
		<?php }else{ ?>
			<option><?php echo $value; ?></option>
		<?php }
		endforeach; ?>
		</select>
		<select name="year">
		<?php foreach ( $year as $value ):
			if ( $birthday[0][2] == $value ){ ?>
		<option selected><?php echo $value;?></option>
		<?php }else{ ?>
			<option><?php echo $value; ?></option>
		<?php }
		endforeach; ?>
		</select>
		<p><input type="text" name="mobile" placeholder="მობილური ტელეფონი" value="<?php echo $user_info['mobile']; ?>"/></p>
		<p><input type="text" name="personal_id" placeholder="პირადი ნომერი" value="<?php echo $user_info['personal_id']; ?>"/></p>
		<p><input type="text" name="city" placeholder="ქალაქი" onkeypress="return makeGeo(this,event)" value="<?php echo $user_info['city']; ?>"/></p>
		<p><input type="text" name="address" placeholder="მისამართი" onkeypress="return makeGeo(this,event)" value="<?php echo $user_info['address']; ?>"/></p>
		<p><input id="show-me" type="text" name="company_id" placeholder="კომპანიის საიდენტიფიკაციო კოდი" style="display:none"/></p>

		<button type="submit">რედაქტირება</button>
	</form>
	</div>
	</section>