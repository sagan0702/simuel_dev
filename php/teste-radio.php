                        <div class="form-group"> <!--- ADD RADIO --->
							<label><h6>Em garantia?</label></h6>
						
							<div class="form-check">
							<input class="form-check-input" type="radio" name="garantia" value="SIM" id="radio_garantia_sim" checked>
							<label class="form-check-label" for="flexRadioDefault1">
								Sim
							</label>
							</div>
							<div class="form-check">
							<input class="form-check-input" type="radio" name="garantia" value="NÃO" id="radio_garantia_nao" >
							<label class="form-check-label" for="flexRadioDefault2">
								Não
							</label> 
							</div>
							<br>
						<div class="form-group col-md-6">



                        <div class="form-group col-sm-4"> <!--- EDIT RADIO --->
							<label>Em garantia?</label></br>
							<input type="radio" name="em_garantia" <?=$row[0]['em_garantia']=="SIM" ? "checked" : ""?> value="SIM">Sim </br>
							<input type="radio" name="em_garantia" <?=$row[0]['em_garantia']=="NÃO" ? "checked" : ""?> value="NÃO">Não
						</div>
						</p>