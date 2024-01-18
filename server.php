<?php 
  $conn = mysqli_connect('localhost', 'root', '', 'ajax_crud');
  if (!$conn) {
    die('Connection failed ' . mysqli_error($conn));
  }
  if (isset($_POST['save'])) {
    $name = $_POST['name'];
        $comment = $_POST['comment'];
        $sql = "INSERT INTO tbl_crud_ajax (name, comment) VALUES ('{$name}', '{$comment}')";
        if (mysqli_query($conn, $sql)) {
          $id = mysqli_insert_id($conn);
      $saved_comment = '<div class="comment_box">
                <span class="delete" data-id="' . $id . '" >delete</span>
                <span class="edit" data-id="' . $id . '">edit</span>
                <div class="display_name">'. $name .'</div>
                <div class="comment_text">'. $comment .'</div>
        </div>';
          echo $saved_comment;
        }else {
          echo "Error: ". mysqli_error($conn);
        }
        exit();
  }
  // delete comment fromd database
  if (isset($_GET['delete'])) {
        $id = $_GET['id'];
        $sql = "DELETE FROM tbl_crud_ajax WHERE id=" . $id;
        mysqli_query($conn, $sql);
        exit();
  }
  if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $comment = $_POST['comment'];
        $sql = "UPDATE tbl_crud_ajax SET name='{$name}', comment='{$comment}' WHERE id=".$id;
        if (mysqli_query($conn, $sql)) {
                $id = mysqli_insert_id($conn);
                $saved_comment = '<div class="comment_box">
                  <span class="delete" data-id="' . $id . '" >delete</span>
                  <span class="edit" data-id="' . $id . '">edit</span>
                  <div class="display_name">'. $name .'</div>
                  <div class="comment_text">'. $comment .'</div>
          </div>';
          echo $saved_comment;
        }else {
          echo "Error: ". mysqli_error($conn);
        }
        exit();
  }

  // Retrieve comments from database
  $sql = "SELECT * FROM tbl_crud_ajax";
  $result = mysqli_query($conn, $sql);
  $comments = '<div id="display_area">'; 
  while ($row = mysqli_fetch_array($result)) {
        $comments .= '<div class="comment_box">
                  <span class="delete" data-id="' . $row['id'] . '" >delete</span>
                  <span class="edit" data-id="' . $row['id'] . '">edit</span>
                  <div class="display_name">'. $row['name'] .'</div>
                  <div class="comment_text">'. $row['comment'] .'</div>
          </div>';
  }
  $comments .= '</div>';
?>