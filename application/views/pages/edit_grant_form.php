
<link rel="stylesheet" href="<?php echo base_url();?>assets/css/metallic.css" >

<script type="text/javascript" src="<?php echo base_url();?>assets/js/zebra_datepicker.js"></script>
<script type="text/javascript">
$(function(){
    $("#date").Zebra_DatePicker({
       
    });
});
</script>


	<?php if(isset($mode)&& $mode=="select"){ ?>
	<center>	<h3><u>Edit Grant</u></h3></center><br>
	<?php echo validation_errors();	 echo form_open('masters/edit/grant',array('role'=>'form')); ?>

	
	<div class="form-group">
		<label for="grant_name" class="col-md-4">Grant Name</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="Grant Name" id="grant_name" name="grant_name" 
		<?php if(isset($grants)){
			echo "value='".$grants[0]->grant_name."' ";
			}
		?>
		/>
		<?php if(isset($grants)){ ?>
		<input type="hidden" value="<?php echo $grants[0]->grant_id;?>" name="grant_id" />
		
		<?php } ?>
		</div>
	</div>
		<div class="form-group">
	<label for="date" class="col-md-4">Date</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="date" id="date" name="date" 
		<?php if(isset($grants)){
			echo "value='".$grants[0]->date."' ";
			}
		?>
		/>
		</div>
	</div>
	<div class="form-group">
		<label for="phase_name" class="col-md-4" > Grant Phase Name</label>
		<div  class="col-md-8">
		<select name="phase_name" id="phase_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($grant_phases as $g){
			echo "<option value='$g->grant_id'";
			if(isset($grants) && $grants[0]->phase_id==$g->phase_id)
				echo " SELECTED ";
			echo ">$g->phase_name</option>";
		}
		?>
		</select>
		</div>
	</div>	
	
	<!--
	<div class="form-group">
		<label for="phase_name" class="col-md-4" >Grant Phase Name</label>
		<div  class="col-md-8">
		<select name="phase_name" id="phase_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($grant_phases as $g){
			echo "<option value='$g->phase_name'";
			if(isset($grants) && $grants[0]->grant_id==$g->grant_id)
				echo "SELECTED";
			echo ">$g->division</option>";
		}
		?>
		</select>
		</div>
	</div>-->	

	<div class="form-group">
		<label for="phase_name" class="col-md-4" >Grant Sources</label>
		<div  class="col-md-8">
		<select name="grant_sources" id="phase_name" class="form-control">
		<option value="">--SELECT--</option>
		<?php foreach($grant_sources as $g){
			echo "<option value='$g->grant_source_id'";
			if(isset($grants) && $grants[0]->grant_source_id==$g->grant_source_id)
				echo " SELECTED ";
			echo ">$g->grant_source</option>";
		}
		?>
		</select>
		</div>
	</div>	
	<!--
	<div class="form-group">
	<label for="grant_source" class="col-md-4">Grant Sources</label>
		<div  class="col-md-8">
		<input type="text" class="form-control" placeholder="grant_source" id="grant_source" name="grant_source" 
		<?php if(isset($grants)){
			echo "value='".$grants[0]->grant_source."' ";
		}
		?>
		/>
		</div>
	</div>
-->
	
   	<div class="col-md-3 col-md-offset-4">
	<input class="btn btn-lg btn-primary btn-block" type="submit" value="Update" name="update">
	</div>
	</form>
	<?php } ?>
	<h3><?php if(isset($msg)) echo $msg;?></h3>	
	<div class="col-md-12">
	<?php echo form_open('masters/edit/grant',array('role'=>'form','class'=>'form-inline','name'=>'search_grant_name'));?>
	<h3> Search Grants </h3>
	<table class="table-bordered col-md-12">
	<tbody>
	<tr><td>
		<input type="text" class="form-control" placeholder="Grant Name" id="grant_source" name="search_grant_name" >
	<td>
		
		
		<td><input class="btn btn-lg btn-primary btn-block" name="search" value="Search" type="submit" /></td></tr>
	</tbody>
	</table>
	</form>
	
	<?php if(isset($mode) && $mode=="search"){ ?>

	<h3 class="col-md-12">List of Grants</h3>
	<div class="col-md-12 "><strong>
	
	<?php if($this->input->post('search_grant_name')) echo "Grant name starting with : ".$this->input->post('search_grant_name'); ?>

	</strong>
	</div>	
	<table class="table-hover table-bordered table-striped col-md-10">
	<thead>
	<th>S.No</th><th>Grant Name </th><th>Date</th>
	</thead>
	<tbody>
	<?php 
	$i=1;
	foreach($grants  as $g){ ?>
	<?php echo form_open('masters/edit/grant',array('id'=>'select_grant_form_'.$g->grant_id,'role'=>'form')); ?>
	<tr onclick="$('#select_grant_form_<?php echo $g->grant_id;?>').submit();" >
		<td><?php echo $i++; ?></td>
		<td><?php echo $g->grant_name; ?>
		<input type="hidden" value="<?php echo $g->grant_id; ?>" name="grant_id" />
		<input type="hidden" value="select" name="select" />
		</td>
		<td><?php echo $g->date; ?></td>
		<!--<td><?php echo $g->phase_name; ?></td>
		<td><?php echo $g->grant_source; ?></td>
-->
	</tr>
	</form>
	<?php } ?>
	</tbody>
	</table>
	<?php } ?>
	</div>