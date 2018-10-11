<div id="idForm">
	<form action="#"  method="post" enctype="multipart/form-data">

		<h3>Введите числа и выберите операцию</h3>
		
			<div class="divSelect">
				<div>
					<input class="figures" type="text" name="figure1" value="{figure1}">
				</div>
				
				<div>
					<select class="figures" name="operation">
						<option value="+" checked="checked">+</option>
						<option value="-">-</option>
						<option value="*">*</option>
						<option value="/">/</option>
					</select>
				</div>
				
				<div>
					<input class="figures" type="text" name="figure2" value="{figure2}">
				</div>
				
				<div>=</div>
				
				<div>
					<input type="text" name="results" class="figures" value="{results}">
				</div>
				
			</div>
		<p><input type="submit" value="Применить"></p>


	</form>
</div>