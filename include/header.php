<div class="header">
  <?php echo $pageheader; ?>
</div>
<div class="nav">
  <ul>
    <li><a class="<?=($navPage==1)?'active':'';?>" href="index.php">首頁</a></li>
    <li><a class="<?=($navPage==2)?'active':'';?>" href="list.php">發票列表</a></li>
    <li><a class="<?=($navPage==3)?'active':'';?>" href="award.php">對獎頁</a></li>
    <li><a class="<?=($navPage==4)?'active':'';?>" href="invoice.php">輸入獎號頁</a></li>
    <li><a class="<?=($navPage==5)?'active':'';?>" href="query.php">查詢獎號頁</a></li>
  </ul>
</div>