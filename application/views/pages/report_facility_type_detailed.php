	<div class="row">
	<div class="col-md-12">
 	<?php echo form_open('reports/facility_types',array('id'=>'select_month','role'=>'form'));?>
	<button class="btn btn-lg pull-right" type="submit" name="select_month">></button>
		<input type='hidden' value="<?php echo $projects[0]->facility_type_id; ?>" name="facility_type" />
	<select class="form-control pull-right" style="width:100px"  name="year" id="year">
	<option selected disabled>Year</option>
	<?php 
	$year=date("Y");
	for($i=2009;$i<=$year;$i++){
		echo "<option value='$i'>$i</option>";
	}
	?>
	</select>
	<select class="form-control pull-right" style="width:100px" name="month" id="month">
	<option selected disabled>Month</option>
	<?php 
	for($i=1;$i<=12;$i++){
		echo "<option value='".date("m", mktime(0, 0, 0, $i+1, 0, 0, 0))."'>".date("M", mktime(0, 0, 0, $i+1, 0, 0, 0))."</option>";
	}
	?>
	</select>
	<select name="district_id" id="district" style="width:150px"  class="form-control pull-right">
		<option value="">District</option>
		<?php
		for ($e = 0; $e < count($district); $e++)
		{
		  for ($ee = $e+1; $ee < count($district); $ee++)
		  {
			if ($district[$ee]->district_id==$district[$e]->district_id)
			{
			array_splice($district,$ee,1);
			$ee--;
			}
		  }
		}
		foreach($district as $d){
		
			echo "<option value='$d->district_id'>$d->district_name</option>";
		}
		?>
	</select>	
	</form>
	<h3><?php echo $projects[0]->facility_type;?> Works <?php if($this->input->post('district_id')) echo "in ".$projects[0]->district_name; ?> <small> Click on any one to view </small></h3>
	<table id="header-fixed"  class="table table-hover table-bordered"></table>
	<table class="table table-hover table-bordered" id="table-1">
	<thead>
	<th>S.No</th>
	<th>Project Name</th>
	<th>Facility</th>
	<th>Admin Sanction Amt (in Lakhs)</th>
	<th>Agreement Amt (in Lakhs)</th>
	<th>Expenditure upto <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month'),  0, 0)).", ".$this->input->post('year');?>
	<?php } else { echo date("M, Y",strtotime("last month"));} ?>
	</small> (in Lakhs)</th>
	
	
	<th>Expenditure during <?php if($this->input->post('month')&& $this->input->post('year')) { ?>
	<small><?php echo date("M", mktime(0, 0, 0, $this->input->post('month')+1,  0, 0)).", ".$this->input->post('year');?></small>
	<?php } else{ echo date("M, Y"); } ?> (in Lakhs)</th>
	<th>Cumilative Expenditure (in Lakhs)</th>
	<th>Expenditure Percentage</th>
	<th>Status</th><th>Work Type</th></thead>
	<tbody>

	<?php
	$i=1;
	foreach($projects as $project){
	if($project->expenses >= $project->agreement_amount * 80/100){
		$color="background-color:#C0FAC2;";
	}
	else if($project->expenses < $project->agreement_amount * 80 / 100 && $project->expenses >= $project->agreement_amount * 50 / 100){
		$color="background-color:#FCE4B1;";
	}
	else if($project->expenses < $project->agreement_amount * 50 / 100){
		$color="background-color:#FCBDBD;";
	}
	
	?>
	<?php echo form_open('reports/projects',array('id'=>'select_project_form_'.$project->project_id,'role'=>'form')); ?>
	
	<tr style="<?php echo $color; ?>" onclick="$('#select_project_form_<?php echo $project->project_id;?>').submit();">
		<td><?php echo $i++; ?></td>
		<td><?php echo $project->project_name; ?>
		<input type='hidden' value="<?php echo $project->project_id; ?>" name="project_id" />
		</form>
		</td>
		<td><?php echo $project->facility_name; ?></td>
		<td class="text-right"><?php echo number_format($project->admin_sanction_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->agreement_amount/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_upto_last_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expense_current_month/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/100000,2); ?></td>
		<td class="text-right"><?php echo number_format($project->expenses/$project->agreement_amount*100);echo "%" ?></td>
		<td><?php echo $project->status_type; ?></td>
		<td><?php if($project->work_type_id=='M') echo "Medical";
			else echo "Non-Medical"; 
			?></td>
	</tr>
	<?php
	}
	?>
	</tbody>
	</table>
	</div>
	</div>