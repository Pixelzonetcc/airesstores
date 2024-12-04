<?php

include 'config.php';



session_start();
if (( ! isset($_SESSION['user_type']) )||( $_SESSION['user_type'] != 'admin' )){
    header('location:login.php');
    exit();
}

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   mysqli_query($conn, "DELETE FROM `message` WHERE id = '$delete_id'") or die('Erro na query');
   header('location:admin_contatos.php');
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="images/favicon.png" type="image/png">
   
   <title>Mensagens</title>

   <!-- Link para Font Awesome -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- Link para arquivo CSS personalizado -->
   <link rel="stylesheet" href="css/admin_style.css">

</head>
<body>
   
<?php include 'admin_header.php'; ?>

<section class="messages">

   <h1 class="title">Mensagens</h1>

   <div class="box-container">
   <?php
      $select_message = mysqli_query($conn, "SELECT * FROM `message`") or die('Erro na query');
      if(mysqli_num_rows($select_message) > 0){
         while($fetch_message = mysqli_fetch_assoc($select_message)){
   ?>
   <div class="box">
      <p> ID do usuário: <span><?php echo $fetch_message['user_id']; ?></span> </p>
      <p> Nome: <span><?php echo $fetch_message['name']; ?></span> </p>
      <p> Número: <span><?php echo $fetch_message['number']; ?></span> </p>
      <p> Email: <span><?php echo $fetch_message['email']; ?></span> </p>
      <p> Mensagem: <span><?php echo $fetch_message['message']; ?></span> </p>
      <a href="admin_contatos.php?delete=<?php echo $fetch_message['id']; ?>" onclick="return confirm('Apagar esta mensagem?');" class="delete-btn">Apagar mensagem</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">Sem novas mensagens!</p>';
      }
   ?>
   </div>

</section>

<!-- Link para arquivo JS personalizado -->
<script src="js/admin_script.js"></script>

</body>
</html>