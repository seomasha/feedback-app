<?php include "inc/header.php"?>

<?php 

  $name = $email = $feedback = '';
  $nameError = $emailError = $feedbackError = '';

  //Form submit
  if(isset($_POST["submit"])) {
    //Validate name
    if(empty($_POST['name'])) {
      $nameError = 'Name is required.';
    }

    else {
      $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($_POST['email'])) {
      $emailError = 'Email is required.';
    }

    else {
      $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    }

    if(empty($_POST['body'])) {
      $feedbackError = 'Feedback is required.';
    }

    else {
      $feedback = filter_input(INPUT_POST, 'body', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    }

    if(empty($nameError) && empty($emailError) && empty($feedbackError)) {
      //Add to database.

      $sql = "INSERT INTO feedback (name, email, feedback) VALUES ('$name', '$email', '$feedback')";

      if(mysqli_query($connection, $sql)) {
        //Success

        header('Location: feedback.php');
      }
      else {
        //Error
        echo 'Error: ' . mysqli_error($connection);
      }
    }
  }
?>
    <img src="/php-crash/feedback/img/logo.png" class="w-25 mb-3" alt="">
    <h2>Feedback</h2>
    <p class="lead text-center">Leave feedback for Feedback app</p>
    <form action=<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?> method="POST" class="mt-4 w-75">
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control <?php echo $nameError ? 'is-invalid' : null ?>" id="name" name="name" placeholder="Enter your name">
        <div class="invalid-feedback">
          <?php echo $nameError ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control <?php echo $emailError ? 'is-invalid' : null ?>" id="email" name="email" placeholder="Enter your email">
        <div class="invalid-feedback">
          <?php echo $emailError ?>
        </div>
      </div>
      <div class="mb-3">
        <label for="body" class="form-label">Feedback</label>
        <textarea class="form-control <?php echo $feedbackError ? 'is-invalid' : null ?>" id="body" name="body" placeholder="Enter your feedback"></textarea>
        <div class="invalid-feedback">
          <?php echo $feedbackError ?>
        </div>
      </div>
      <div class="mb-3">
        <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
      </div>
    </form>
<?php include "inc/footer.php"?>