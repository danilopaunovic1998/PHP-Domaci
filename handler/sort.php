<?php
require "../dbBroker.php";
require "../model/product.php";
require "../model/type.php";
$output = '';
$i = 0;
if (isset($_POST['param'])) {
  $search = $_POST['param'];
  $stm = $conn->prepare("SELECT * FROM product WHERE title LIKE CONCAT('%',?,'%')");
  $stm->bind_param("s", $search);
} else {
  $stm = $conn->prepare("SELECT * FROM product");
}
$stm->execute();
$result = $stm->get_result();


if ($result->num_rows > 0) {
  $output = '<thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Title</th>
        <th scope="col">Category</th>
        <th scope="col">Description</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>

      </tr>
  </thead>
  <tbody>';
  while ($red = $result->fetch_assoc()) {
    $pom = Type::getById($conn, $red["typeid"]);
    $output .= '
      <tr>
      <td>' . ++$i . '</td>
      <td>' . $red["title"] . '</td>
      <td>' . $pom[0]["name"] . '</td>
      <td>' . $red["description"] . '</td>
      <td>' . $red["price"] . '</td>
      <td>
          <button onclick="popuniModal( ' . $red['productid'] . ')" type="button" class="btn btn-primary dugme-izmeni data-bs-toggle="modal" data-bs-target="#IzmeniModal">Izmeni</button>
          <button onclick="deleteFunc(' . $red['productid'] . ')" class="btn btn-danger dugmeObrisi">Delete</button>
      </td>
      </tr>
    ';
  }
  $output .= "</tbody>";
  echo $output;
} else {
  echo '<h3 style="color: white;"> No Records Found!</h3>';
}
