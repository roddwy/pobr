<!--BUSCADOR-->		        	
		<div class="modal fade" id="buscador" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">BUSCADOR!!!!!!</h4>
		        </div>
		        <div class="modal-body">
		          <header class="panel-heading">
		        		<input type="number" title="Introduzca solo numeros con 8 digitos" name="searchcell[]" class="form-control" id="searchcell" placeholder="Buscar por Nro Celular" required/>
		          </header>
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
  		</div>	 
<!--END BUSCADOR-->

<!--MODAL DE FORMULARIO CLIENTE-->
	  	<div class="modal fade" id="customer" role="dialog">
		    <div class="modal-dialog">		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">CONTACTO</h4>
		        </div>
		        <div class="modal-body">
		        	<div id="msj-error" class="alert alert-danger alert-dismissible" role="alert" style="display:none">
		        		<strong id="msj"></strong>
		        	</div>
		        	<!--BUSCADOR-->
		        	<!--<header class="panel-heading">
		        		<input type="text" name="searchcell[]" class="form-control" id="searchcell" placeholder="Buscar por Nro Celular">
		        	</header>-->
		        	<!--END BUSCADOR-->
		          <form action="../newCustomer" method="post" id="frmCustomer">
		          	<div class="row">
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Nombres</label>
		          				<input type="text" name="first_name" id="first_name" placeholder="Nombres" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Apellidos</label>
		          				<input type="text" name="last_name" id="last_name" placeholder="Apellidos" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Teléfono</label>
		          				<input type="tel" name="phone" title="Debe contener 7 digitos y el primer digito debe empezar por 2, 3 o 4" id="phone" placeholder="Teléfono" pattern="^[2|3|4][0-9]{6}" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>celular</label>
		          				<input type="tel" name="cell_phone" title="Debe contener 8 digitos y el primer digito debe empezar por 6 o 7" id="cell_phone" placeholder="Nro Celular" pattern="^[7|6][0-9]{7}" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Email</label>
		          				<input type="email" title="Ejemplo:  ejemplo@ejemplo.com"name="email" id="email" placeholder="Email" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<input type="text" name="property"  id="property" value="{{$property->id}}">
		          			</div>		          			
		          		</div>
		          	</div>		          	
		          	<div class="modal-footer">
		          		<input type="submit" value="Enviar" id="save" class="btn btn-primary">
		          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	</div>
		          </form>
		        </div>		        
		      </div>
		      
		    </div>
		</div>
<!--FIN MODAL FORMULARIO CLIENTE-->

<!--MODAL DE FORMULARIO CLIENTE EXISTENTE-->
	  	<div class="modal fade" id="existcustomer" role="dialog">
		    <div class="modal-dialog">		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">DATOS EXISTENTES</h4>
		        </div>
		        <div class="modal-body">
		        	<!--BUSCADOR-->
		        	<!--<header class="panel-heading">
		        		<input type="text" name="searchcell[]" class="form-control" id="searchcell" placeholder="Buscar por Nro Celular">
		        	</header>-->
		        	<!--END BUSCADOR-->
		          <form action="../editCustomer" method="post" id="frmEditCustomer">
		          	<div class="row">
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Id</label>
		          				<input type="text" name="id" id="existid" placeholder="Id" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Nombres</label>
		          				<input type="text" name="first_name" id="existfirst_name" placeholder="Nombres" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Apellidos</label>
		          				<input type="text" name="last_name" id="existlast_name" placeholder="Apellidos" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Teléfono</label>
		          				<input type="tel" title="Debe ser numeros de 7 digitos" name="phone" id="existphone" placeholder="Teléfono" pattern="[0-9]{7}" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>celular</label>
		          				<input type="tel" title="Debe ser numeros de 8 digitos" name="cell_phone" id="existcell_phone" placeholder="Nro Celular" pattern="[0-9]{8}" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<label>Email</label>
		          				<input type="email" name="email" id="existemail" placeholder="Email" required/>
		          			</div>		          			
		          		</div>
		          		<div class="col-lg-4 col-sm-4">
		          			<div class="form-group">
		          				<input type="text" name="property" id="property" value="{{$property->id}}">
		          			</div>		          			
		          		</div>
		          	</div>		          	
		          	<div class="modal-footer">
		          		<input type="submit" value="Enviar" id="save" class="btn btn-primary">
		          		<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        	</div>
		          </form>
		        </div>		        
		      </div>
		      
		    </div>
		</div>
<!--FIN MODAL FORMULARIO CLIENTE EXISTENTE-->

<!--MENSAJE MODAL-->
	  	<div class="modal fade" id="SuccessEncontrado" role="dialog">
		    <div class="modal-dialog">
		    
		      <!-- Modal content-->
		      <div class="modal-content">
		        <div class="modal-header">
		          <button type="button" class="close" data-dismiss="modal">&times;</button>
		          <h4 class="modal-title">Exito!!!!!!</h4>
		        </div>
		        <div class="modal-body">
		          <p>Usted ya se registro con los siguentes datos: </p>
		          <div class="form-group">
		          	<label>Nombres</label>
		          	<input type="text" name="first_name" id="first_name" placeholder="Nombres">
		          </div>	
		        </div>
		        <div class="modal-footer">
		          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		        </div>
		      </div>
		      
		    </div>
  		</div>	 
<!--END MENSAJE MODAL-->
		<script type="text/javascript">
	    	$('#searchcell').autocomplete({
	    		source	:  '{!! URL::route('buscadorCustomer') !!}',
	    		minlenght:1,
	    		autoFocus:true,
	    		select:function(e,ui){
	    			//alert(ui);
	    			if (ui.item.result == 'Encontrado') {
	    				console.log(ui.item.first_name);
	    				$('#buscador').modal('hide');
	    				$('#existcustomer').modal('show');
	    				//alert(content);
	    				$('#existid').val(ui.item.id);
	    				$('#existfirst_name').val(ui.item.first_name);
		    			$('#existlast_name').val(ui.item.last_name);
		    			$('#existphone').val(ui.item.phone);
		    			$('#existcell_phone').val(ui.item.cell_phone);
		    			$('#existemail').val(ui.item.email);
		    			//console.log('entro al if');	
	    			}else{
	    				$('#buscador').modal('hide');
	    				$('#customer').modal('show');
	    			}
	    			/*if(ui != ""){
	    				//var content = ui+'hola';
	    				$('#buscador').modal('hide');
	    				$('#customer').modal('show');
	    				//alert(content);
	    				$('#first_name').val(ui.item.first_name);
		    			$('#last_name').val(ui.item.last_name);
		    			$('#phone').val(ui.item.phone);
		    			$('#cell_phone').val(ui.item.cell_phone);
		    			$('#email').val(ui.item.email);
		    			console.log('entro al if');		    				
	    			}else{
	    				$('$customer').modal('show');
	    			}*/
	    		}
	    	});
	    </script>
	  	