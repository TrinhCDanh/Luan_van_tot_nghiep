<div class="form-mail">
	<form action="{{ route('sendmail') }}" method="POST">
		{{ csrf_field() }}
		<input type="text" name="txtEmail" />
		<input type="submit" name="btnSubmit" value="Submit">
	</form>
</div>