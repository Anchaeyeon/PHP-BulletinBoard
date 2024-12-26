<?php
$conn = mysqli_connect('localhost', 'root', '111111', 'mysql');

$id = $_GET['id'];

$sql = "select * from board where id = $id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if (!$row) {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}

// POST 요청이 있을 때만
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pw = $_POST['password'];

    if ($pw == $row['password']) {
        $sql_delete = "delete from board where id = $id";
        $result_delete = mysqli_query($conn, $sql_delete);

        if ($result_delete) {
            echo "<script>alert('게시글이 삭제되었습니다!');</script>";
            echo("<script>location.href='index.php';</script>");
        }
        else {
            echo "<script>alert('게시글 삭제 중 오류가 발생했습니다.');</script>";
        }
    }
    else {
        echo "<script>alert('비밀번호가 일치하지 않습니다.');</script>";
        echo("<script>location.href='delete.php?id=$id';</script>");
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 삭제</title>
    <link rel="stylesheet" href="../css/delete.css"/>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <td class="label">제목</td>
                <td class="content"><?php echo htmlspecialchars($row['title']); ?></td>
            </tr>
            <tr>
                <td class="label">내용</td>
                <td class="content"><?php echo nl2br(htmlspecialchars($row['content'])); ?></td>
            </tr>
            <tr>
                <td class="label">작성자</td>
                <td class="content"><?php echo htmlspecialchars($row['name']); ?></td>
            </tr>
            <tr>
                <td class="label">작성시간</td>
                <td class="content"><?php echo htmlspecialchars($row['regDate']); ?></td>
            </tr>
            <tr>
                <td class="label">사진</td>
                <td class="content"><img src="../uploads/<?php echo htmlspecialchars($row['file']); ?>" alt="file"></td>
            </tr>
            <form method="POST" action="">
                <tr>
                    <td class="label">비밀번호</td>
                    <td class="content">
                        <input type="password" name="password" placeholder="비밀번호를 입력해주세요" required>
                    </td>
                </tr>
                <input type="submit" value="삭제하기">
            </form>
        </table>
    </div>
</body>
</html>
