<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시글 수정</title>
</head>
<body>
<?php
    // 데이터베이스 연결
    $conn = mysqli_connect('localhost', 'root', '111111', 'mysql');

    // GET 요청에서 게시글 ID 가져오기
    $id = $_GET['id'];

    // 게시글 데이터 가져오기
    $sql = "SELECT * FROM board WHERE id = $id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if (!$row) {
        echo "게시글을 찾을 수 없습니다.";
        exit;
    }

    // 기존 게시글 정보를 폼에 표시
?>
<form action="update_process.php" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>">
    <table>
        <tr>
            <th>제목</th>
            <td><input type="text" name="title" value="<?php echo htmlspecialchars($row['title']); ?>" required></td>
        </tr>
        <tr>
            <th>내용</th>
            <td><textarea name="content" required><?php echo htmlspecialchars($row['content']); ?></textarea></td>
        </tr>
        <tr>
            <th>작성자</th>
            <td><input type="text" name="name" value="<?php echo htmlspecialchars($row['name']); ?>" readonly></td>
        </tr>
        <tr>
            <th>작성시간</th>
            <td><input type="text" name="regDate" value="<?php echo htmlspecialchars($row['regDate']); ?>" readonly></td>
        </tr>
        <tr>
            <th>사진</th>
            <td class="content"><img src="../uploads/<?php echo htmlspecialchars($row['file']); ?>" alt="file"></td>
        </tr>
        <tr>
            <th>비밀번호</th>
            <td><input type="password" name="password" required></td>
        </tr>
        <tr>
            <td colspan="2"><button type="submit">수정하기</button></td>
        </tr>
    </table>
</form>
<?php
    // 연결 종료
    mysqli_close($conn);
?>
</body>
</html>
