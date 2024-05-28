<script>
function successful() {
    alert("News Successfully Edited and Saved"); // this is the message in ""
    window.location = "EditNews.php";
}
</script>
<?php
$id_article = $_POST['id'];
$name = $_FILES['image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . $name;

// Select file type
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");


if (isset($_POST['savebtn'])) {

   $link = mysqli_connect("localhost", "root", "");
   if (!$link) {
      echo ('Error connecting to the database ');
      exit();
   }
   $db = mysqli_select_db($link, 'adproject');
   if (!$db) {
      echo ('Error selecting database ');
      exit();
   }

   $title = mysqli_real_escape_string($link, $_POST['title']);
   $content = mysqli_real_escape_string($link, $_POST['content']);
   $author = mysqli_real_escape_string($link, $_POST['author']);
   $description = mysqli_real_escape_string($link, $_POST['description']);

   // Check extension
   if (in_array($imageFileType, $extensions_arr) || ($name == "")) {

      // Convert to base64

      if ($name != "") {
         $image_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
         $image = 'data:image/' . $imageFileType . ';base64,' . $image_base64;

         // Insert record
         $query = "UPDATE info_news SET news_title = '$title', news_short_description = '$description', news_full_content = '$content', news_image = '$image', news_author = '$author' WHERE news_id = '$id_article'";
         $result = mysqli_query($link, $query);

         // Upload file
         move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
      } else {
         $query = "UPDATE info_news SET news_title = '$title', news_short_description = '$description', news_full_content = '$content', news_author = '$author' WHERE news_id = '$id_article'";
         $result = mysqli_query($link, $query);
      }
   }
   if (!$result) {
      echo ('Error saving news ');
      exit();
   } else {
      mysqli_close($link);
      echo '<script type="text/javascript">',
         'successful();',
         '</script>';
   }
}
?>