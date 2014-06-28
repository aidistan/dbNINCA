<!DOCTYPE HTML>
<html>

<head>
  <title>dbNINCA: Network from INflammation to CAncer</title>
  <meta name="description" content="" />
  <meta name="keywords" content="bioinformatics, database" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="<?php echo base_url('style/style.css')?>" />
  <script src="<?php echo base_url('script/jquery-1.10.2.min.js')?>"></script>
</head>

<body>
  <div id="main">
    <div id="content">
      <form id="form" style="padding-top:10px;" action="<?php echo base_url('/tool/');?>">
        <h1 style="display:inline;">Symbol to query </h1>
        <input name="term" id="term" style="width:100px;height:1.5em;padding-left: 5px;" type="text" value="<?php echo $term;?>">
        <input type="submit" class="submit" value="Go">
        <div style="clear:both;"></div>
      </form>
      <div class="blank20"></div>
<?php if($term):?>
  <?php if($result):?>
      <table>
        <tr>
          <th>Symbol</th>
          <th>Approved symbol</th>
        </tr>
    <?php foreach($result as $row):?>
        <tr>
          <td><?php echo $row->symbol;?></td>
          <td><?php echo $row->approved;?></td>
        </tr>
    <?php endforeach;?>
      </table>
    <?php if($pagestr):?>
      <?php echo $pagestr;?>
    <?php endif;?>
  <?php else:?>
      <h2>Not found</h2>
  <?php endif;?>
<?php endif;?>
    </div>
	</div>
</body>
</html>