	<section>
	<?php if (!$this->session->flashdata('message') == null): ?>
    <div class="alert alert-success" role="alert">
        <a href="#" class="alert-link"><?php echo $_SESSION['message']; ?></a>
    </div>
<?php endif; ?>
	<div class="registration">
	<?php if ( validation_errors() == TRUE ): ?>
	<div class="error_message">
	<p><?php echo validation_errors(); ?></p>
	</div>
	<?php endif; ?>
	<form action="<?php echo site_url('user/registration') ?>" method="post">
		<p>
			<input type="radio" name="is_company" value="0" required title="მონიშვნა აუცილებელია">ფიზიკური პირი</input>
			<input type="radio" name="is_company" value="1" required title="მონიშვნა აუცილებელია">იურიდიული პირი</input>
		</p>
		<p><input type="text" name="username" placeholder="ნიკი" value="<?php echo set_value('username'); ?>" required title="შემოიტანეთ ნიკი"/></p>
		<p><input type="password" name="password" placeholder="პაროლი" required title="შემოიტანეთ პაროლი"/></p>
		<p><input type="password" name="passconf" placeholder="გაიმეორეთ პაროლი" /></p>
		<p><input type="text" name="email" placeholder="ელ.მისამართი" value="<?php echo set_value('email'); ?>" required title="შემოიტანეთ ელ.მისამართი"/></p><br>
		<p><input type="text" name="name_en" placeholder="სახელი და გვარი(ლათინურად)" value="<?php echo set_value('name_en'); ?>" required title="შემოიტანეთ სახელი და გვარი(ლათ)"/></p>
		<p><input type="text" name="name_ge" placeholder="სახელი და გვარი(ქართულად)" value="<?php echo set_value('name_ge'); ?>" onkeypress="return makeGeo(this,event)" required title="შემოიტანეთ სახელი და გვარი(ქართ)"/></p>
		<select name="day">
		<?php for ( $i=1; $i<=$day; $i++ ): ?>
		<option><?php echo $i; ?></option>
		<?php endfor; ?>
		</select>
		<select name="month">
		<?php foreach ( $month as $key => $value ): ?>
		<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
		<?php endforeach; ?>
		</select>
		<select name="year">
		<?php foreach ( $year as $value ): ?>
		<option><?php echo $value;?></option>
		<?php endforeach; ?>
		</select>
		<p><input type="text" name="mobile" placeholder="მობილური ტელეფონი" value="<?php echo set_value('mobile'); ?>" required title="შემოიტანეთ მობილური"/></p>
		<p><input type="text" name="personal_id" placeholder="პირადი ნომერი" value="<?php echo set_value('personal_id'); ?>" required title="შემოიტანეთ პირადი ნომერი"/></p>
		<p><input type="text" name="city" placeholder="ქალაქი" value="<?php echo set_value('city'); ?>" onkeypress="return makeGeo(this,event)" required title="შემოიტანეთ ქალაქი"/></p>
		<p><input type="text" name="address" placeholder="მისამართი" value="<?php echo set_value('address'); ?>" onkeypress="return makeGeo(this,event)" required title="შემოიტანეთ მისამართი"/></p>
		<p><input class="show-me" type="text" name="company_id" value="<?php echo set_value('company_id'); ?>" placeholder="კომპანიის საიდენტიფიკაციო კოდი" style="display:none"/></p>
		<p><input class="show-me" type="text" name="company_name" value="<?php echo set_value('company_name'); ?>" placeholder="იურიდიული სახელწოდება" style="display:none"/></p>
		<p><button typ="submit">რეგისტრაცია</button></p>
		
	</form>
	</div>
	</section>