<?php
$conn = mysqli_connect('localhost', 'root', '111111', 'mysql');

// GET으로 전달된 id 값 받기
$id = $_GET['id'];

$sql = "select * from board where id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    date_default_timezone_set("Asia/Seoul");
    $regDate = date("Y-m-d H:i:s"); // 현재 시간을 작성시간으로 설정

    $pw = $_POST['password'];

    if ($pw == $row['password']) {
        $sql_update = "update board set title='$title', content='$content', regDate='$regDate' WHERE id=$id";
        $result_update = mysqli_query($conn, $sql_update);

        if ($result_update) {
            echo "<script>alert('게시글이 수정되었습니다!');</script>";
            echo("<script>location.href='index.php';</script>");
        } else {
            echo "<script>alert('게시글 수정 중 오류가 발생했습니다.');</script>";
        }
    } else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
    }
}

mysqli_close($conn);
?>
