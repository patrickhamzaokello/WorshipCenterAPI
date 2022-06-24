<?php
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Questions</title>
</head>
<body>
<div class="container">
 <div class="row">
   <div class="col-sm-12">
       <h1 style="padding: 2em;">Questions</h1>
    <?php echo $deleteMsg??''; ?>
    <div class="table-responsive">
      <table class="table table-bordered">
       <thead>
         <th>#</th>
         <th>Name</th>
          <th>Question</th>
         <th>Date</th>
    </thead>
    <tbody>
  <?php
      if(is_array($fetchData)){      
      $sn=1;
      foreach($fetchData as $data){
    ?>
      <tr>
      
      <td><?php echo $data['id']??''; ?></td>
          <td><?php echo $data['name']??''; ?></td>
      <td><?php echo $data['question']??''; ?></td>
          <td><?php echo date('d M Y h:i A',strtotime($data['created_date'])) ??''; ?></td>
      </tr>
     <?php
      $sn++;}}else{ ?>
      <tr>
        <td colspan="8">
    <?php echo $fetchData; ?>
  </td>
    <tr>
    <?php
    }?>
    </tbody>
     </table>
   </div>
</div>
</div>
</div>
</body>
</html>