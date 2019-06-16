
header('Content-Type: application/json');
require_once "../../config/connection.php";
include "functionsPosts.php";
if (isset($_POST['catId'])) {

    $id = $_POST['catId'];
    $rezultat = getCategoryPosts($id);
    echo json_encode($rezultat);
} else {

    $rezultat2 = executeQuery(getCategoryPostsAll());
    echo json_encode($rezultat2);
}
