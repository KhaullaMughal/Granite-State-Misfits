<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    
    $name = $_POST['productName'];
    $price = $_POST['productPrice'];
    $description = $_POST['productDescription'];
    $category = $_POST['category'];
    $image = $_FILES['image'];
    $fileName = $image['name'];
    $uploadPath = '../BlockSync-Admin-panel-main/Uploads/'. $fileName;
    move_uploaded_file($image['tmp_name'], $uploadPath);
    $query = "INSERT INTO products (PRODUCT_NAME, PRODUCT_PRICE, CATEGORY, DESCRIPTION, IMAGE) 
              VALUES ('$name', '$price', '$category', '$description', '$fileName')";
    // Execute the query
    mysqli_query($conn, $query);
    // Check if the query was successful
    if (mysqli_affected_rows($conn) > 0) {
        echo "
        <script>
        alert('Product inserted successfully');
        window.location.href = 'home.php';
        </script>
        ";
    } else {
        echo "
        <script>
        alert('Error inserting product: " . mysqli_error($conn) . "');
        window.location.href = 'insertProduct.php';
        </script>
        ";
    }
    
   
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    <title>Insert Product</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Insert New Product</h2>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="productName" name="productName" required>
            </div>
            <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input type="number" class="form-control" id="productPrice" name="productPrice" required>
            </div>      
            <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea class="form-control" id="productDescription" name="productDescription" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
            </div>
            <div class="mb-3">
                <label for="productCategory" class="form-label">Product Category</label>
                <select name="category" id="category">
                    <option value="Laptop">Laptop</option>
                    <option value="Mobile">Mobile</option>
                    <option value="Headsets">Headsets</option>
                    <option value="Hardware">Hardware</option>
                    <option value="Tablets">Tablets</option>
                    <option value="furniture">Furniture</option>
                    <option value="Accessories">Accessories</option>
                    <option value="electronics">Electronics</option>
                    
                </select>
            </div>
            
            <button type="submit" class="btn btn-primary" name="submit">Insert Product</button>
            <a href="home.php" class="btn btn-secondary">Back to Dashboard</a>
    </form>



    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>