<!-- begin content -->
<div id="content">
	<?php if(!$list):?>
	<!-- search box -->
	<h1 style="margin: 0px 0px 5px;padding: 15px 0px 5px;">Please specify your interest</h1>
	<div class="blank20"></div>
	<form method="GET" action="<?php echo base_url("/browser"); ?>" id="browser_form" class="form_settings" onsubmit="if($('#type').val()==''){ alert('Please select a type');return false;}else if($('#enriched_by').attr('data')=='required' && $('#enriched_by').val()==''){ alert('Please select an enrichment method');return false; }else if($('#tissue').val()==''){ alert('Please select a tissue');return false;};">
		<p style="display:none;">
			<span>Species</span> 
			<select id="species" name="species" data="required">
				<option value="">Select...</option>
				<?php foreach($options_species as $k=>$v):?>
				<option value="<?php echo $k;?>" selected><?php echo $v;?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<span>Type</span>
			<select id="type" name="type" data="required" style="width:100px;">
				<option value="">Select...</option>
				<?php foreach($options_type as $k=>$v):?>
				<option value="<?php echo $k;?>" <?php echo $type==$k ? 'selected' : '';?>><?php echo $v;?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p id="holder_enriched_by" <?php if(empty($enriched_by)):?>style="display:none;"<?php endif;?>>
			<span>Enriched by</span>
			<select id="enriched_by" name="enriched_by" <?php if(!empty($enriched_by)):?>data="required" <?php else:?>disabled<?php endif;?> style="width:200px;">
				<option value="">Select...</option>
				<?php foreach($options_enriched_by as $k=>$v):?>
				<option value="<?php echo $k;?>" <?php echo $enriched_by==$k ? 'selected' : '';?>><?php echo $v;?></option>
				<?php endforeach;?>
			</select>
		</p>
		<p>
			<span>Inflammation to cancer in</span>
			<select id="tissue" name="tissue" data="required" style="width:100px;">
				<option value="">Select...</option>
				<?php foreach($options_tissue as $k=>$v):?>
				<option value="<?php echo $k;?>" <?php echo $tissue==$k ? 'selected' : '';?>><?php echo $v;?></option>
				<?php endforeach;?>
			</select>
		</p>

		<p style="padding-top: 15px">
			<span>&nbsp;</span>
			<input class="submit" type="submit" value="Go"/>
		</p>
	</form>

	<div class="blank20"></div>

	<?php if(!$initial):?>
	<!-- not found -->
 	<div style="width: 620px;">
    <div class="titl">Not found...</div>
    <div class="titl_br"></div>
    <div class="titl_con">
    	<p>Sorry, but we found nothing matched your search. Please try to identify your gene/GO/pathway with a different symbol/ID/synonym that you might know.</p>
    </div>
  </div>
  <?php endif;?>
  <?php else:?>
  <!-- Show the list here -->
	<div>
		<h1><?php echo $ninca_title;?></h1>
		<h2 style="padding:0;margin:0 0 5px;"><?php echo $options_type[$type];?> list</h4>
		<?php if($type!=1):?><h5>Enriched by <strong><?php echo $options_enriched_by[$enriched_by];?></strong></h5><?php endif;?>
		<div class="blank20"></div>
		<!-- Gene list -->
		<?php if($type==1):?>
			<table style="width:100%; borfer-spacing:0;">
				<tr>
					<th>Rank by<br />conversion score</th>
					<th>Approved symbol</th>
					<th>Balance score</th>
				</tr>
				<?php foreach($list as $l):?>
					<tr>
						<td><?php echo $l['c_score_rank'];?></td>
						<td><a href="<?php echo base_url('/gene/'.$l['symbol'].'?ninca='.$ninca)?>"><?php echo $l['symbol'];?></a></td>
						<td><?php echo round($l['b_score'], 6);?></td>
					</tr>
				<?php endforeach;?>
			</table>
		<!-- GO list -->
		<?php elseif($type==2):?>
			<table style="width:100%; borfer-spacing:0;">
				<tr>
					<th>ID</th>
					<th style="width:50%;">Title</th>
					<th>Count</th>
					<th>%</th>
					<th>Adjusted<br/>p-value</th>
				</tr>
				<?php foreach($list as $l):?>
					<tr>
						<td><a href="<?php echo base_url('/go/'.$l['go_id'].'?ninca='.$ninca)?>">GO:<?php echo $l['go_id'];?></a></td>
						<td><?php echo $l['title'];?></td>
						<td><?php echo $l['count'];?></td>
						<td><?php echo $l['percents'];?></td>
						<td><?php echo sprintf("%.3e", $l['adj_p_value']);?></td>
					</tr>
				<?php endforeach;?>
			</table>
		<!-- Pathway list -->
		<?php else:?>
			<table style="width:100%; borfer-spacing:0;">
				<tr>
					<th>ID</th>
					<th style="width:50%;">Title</th>
					<th>Count</th>
					<th>%</th>
					<th>Adjusted<br/>p-value</th>
				</tr>
				<?php foreach($list as $l):?>
					<tr>
						<td><a href="<?php echo base_url('/pathway/'.$l['pathway_id'].'?ninca='.$ninca)?>">hsa:<?php echo $l['pathway_id'];?></a></td>
						<td><?php echo $l['title'];?></td>
						<td><?php echo $l['count'];?></td>
						<td><?php echo $l['percents'];?></td>
						<td><?php echo sprintf("%.3e", $l['adj_p_value']);?></td>
					</tr>
				<?php endforeach;?>
			</table>
		<?php endif;?>

		<div id="page" class="cass_page">
				<p>
					<?php echo $pagestr;?>
				</p>
		</div>
	</div>
	<?php endif;?>
</div>
<!-- end content -->

<script type="text/javascript">
<!--
$(document).ready(function(){
	function onTypeChange() {
		var holder = $('#holder_enriched_by');
		var select = $('#enriched_by');
		if($("#type").val() == 2 || $("#type").val() == 3){
			holder.show();
			select.attr('data', 'required');
			select.attr('disabled', false);
		}
		else{
			holder.hide();
			select.attr('data', '');
			select.val('');
			select.attr('disabled', true);
		}
	}

	$("#type").change(onTypeChange);
	onTypeChange();
});
//-->
</script>

