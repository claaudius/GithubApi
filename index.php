<?php require 'github.php'; ?>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="description" content="Github Api" />
  <title>Github Api</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>

<?php if (count($data) == 0){ ?>
  <h2>Sorry, there is no data.</h2>
<?php } else { ?>
  <table class="table">
    <thead class="thead-dark">
      <tr>
        <th scope="col">#</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Pushed Date</th>
        <th scope="col">Comments</th>
        <th scope="col">Commit URL</th>
      </tr>
    </thead>  
    <tbody>
      <?php $i = 1; ?>
      <?php foreach ($data as $commit){ ?>        
        <tr>
          <th scope="row"><?=$i?></th>
          <td><?=$commit->node->author->name?></td>
          <td><?=$commit->node->author->email?></td>
          <td><?=date('M d Y, h:i a',strtotime($commit->node->pushedDate));?></td>
          <td><? echo nl2br($commit->node->message); ?></td>
          <td><a href="<?=$commit->node->commitUrl?>" target="_blank"><?=$commit->node->commitUrl?></a></td>
        </tr>      
        <?php $i++; ?>
      <?php } ?>
    </tbody>
  </table>
<?php } ?>

</body>
</html>