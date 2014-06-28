    </div>
    <!--end site_content. The start tag is in header.php-->
    <div id="content_footer"></div>
    <div id="footer">
      <p>
        <a href="<?php echo base_url("/"); ?>">Home / Search</a> |
        <a href="<?php echo base_url("/browser"); ?>">Browse</a> |
        <a href="<?php echo base_url("/statistics"); ?>">Statistics</a> |
        <a href="<?php echo base_url("/download"); ?>">Download</a> |
        <a href="<?php echo base_url("/help"); ?>">Help</a>
      </p>
      
      <p>Bioinformatics Division, TNLIST and Department of Automation, Tsinghua University </p>
    </div>
  </div>
  <!-- end main. The start tag is in header.php -->

<?php if(isset($selected)):?>
<script>

// Set selected menu item
$(function(){
  document.getElementById("menu").getElementsByTagName("li")[<?php echo $selected ?>].className = "selected";
})();

</script>
<?php endif;?>

</body>
</html>