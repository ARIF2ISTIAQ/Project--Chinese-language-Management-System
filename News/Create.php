<script>
function successful() {
    alert("News Successfully Created"); // this is the message in ""
    window.location = "ManageNews.php";
}
</script>
<?php

$name = $_FILES['image']['name'];
$target_dir = "uploads/";
$target_file = $target_dir . $name;

// Select file type
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Valid file extensions
$extensions_arr = array("jpg", "jpeg", "png", "gif");

if (isset($_POST['createbtn'])) {

   $link = mysqli_connect("localhost", "root", "");
   if (!$link) {
      echo ('Error connecting to the database ');
      exit();
   }
   $db = mysqli_select_db($link, 'adproject');
   if (!$db) {
      echo ('Error selecting database');
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
         $query = "INSERT INTO info_news(news_title, news_short_description, news_full_content, news_image, news_author, news_published_on) VALUES ('$title', '$description', '$content', '$image', '$author', NOW())";
         $result = mysqli_query($link, $query);

         // Upload file
         move_uploaded_file($_FILES['image']['tmp_name'], $target_file);
      } else {
         $query = "INSERT INTO info_news(news_title, news_short_description, news_full_content, news_author, news_published_on) VALUES ('$title', '$description', '$content', '$author', NOW())";
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