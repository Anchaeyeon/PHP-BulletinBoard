<?php
$conn = mysqli_connect('localhost', 'root', '111111', 'mysql');

// URL에서 id 값을 가져옴
$id = $_GET['id'];

// 게시글 정보 가져오기
$sql = "select * from board where id=$id";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

// 게시글이 존재하지 않으면 오류 메시지 출력
if (!$row) {
    echo "게시글을 찾을 수 없습니다.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 보기</title>
    <link rel="stylesheet" href="../css/view.css"/>
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
        </table>
        <div class="button-container">
            <a href="index.php" class="back">뒤로가기</a>
            <a href="../html/board.html" class="write">새글 작성</a>
            <a href="delete.php?id=<?php echo $id; ?>" class="delete">글 삭제</a>
            <a href="edit.php?id=<?php echo $id; ?>" class="edit">글 수정</a>
        </div>
    </div>
</body>
</html>
