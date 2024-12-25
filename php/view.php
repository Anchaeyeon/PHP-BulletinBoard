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

<!-- 내용 출력 -->
<h2><?php echo htmlspecialchars($row['title']); ?></h2>
<p><?php echo nl2br(htmlspecialchars($row['content'])); ?></p>
<img src="../uploads/<?php echo htmlspecialchars($row['file']); ?>" alt="file">