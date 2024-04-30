<?php
$text = $_SESSION['text'];
if (isset($_SESSION['status'])) {
    if ($_SESSION['status'] == 'error') {
        echo "<script>
                Swal.fire({
                    icon: 'error',
                    text: 'Error: $text',
                });
              </script>";
    } else if ($_SESSION['status'] == 'Success') {
        echo "<script>
                Swal.fire({
                    icon: 'success',
                    text: 'Success: $text',
                });
              </script>";
    }
    unset($_SESSION['status']);
    unset($_SESSION['text']);
}
?>
