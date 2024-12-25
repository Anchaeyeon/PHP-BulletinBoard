<!DOCTYPE html>
<html lang="ko">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>게시판</title>
    <link rel="stylesheet" href="../css/index.css"/>
</head>

<body>
    <div class="container">
        <h1>게시판</h1>
        <table>
            <tr>
                <th>번호</th>
                <th>제목</th>
                <th>작성자</th>
                <th>작성날짜</th>
                <div class="write-button">
                    <a href="../html/board.html" class="write" name="write">글 작성하기</a>
                </div>
            </tr>
            
            <?php
            // PHP와 MySQL 연결
            $conn = mysqli_connect('localhost', 'root', '111111', 'mysql');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $name = $_POST['name'];
                $title = $_POST['title'];
                $grade = $_POST['grade'];
                $phone = $_POST['phone'];
                $content = $_POST['content'];
                $password = $_POST['password'];
                $file = $_POST['file'];

                $f_name = $_FILES['file']['name'];
                $f_tmp = $_FILES['file']['tmp_name'];

                $uploads = '../uploads/';

                // 파일 업로드
                if (!is_dir($uploads)) {
                    mkdir($uploads);
                }
                $upload_file = $uploads . $f_name;
                move_uploaded_file($f_tmp, $upload_file);

                // 데이터 삽입
                $insertSql = "insert into board (name, title, grade, phone, content, password, file) values ('$name', '$title', '$grade', '$phone', '$content', '$password', '$f_name')";
                mysqli_query($conn, $insertSql);
            }
            // 데이터 가져오기
            $sql = "select * from board order BY id desc";
            $result = mysqli_query($conn, $sql);
            $cnt = mysqli_num_rows($result);

            for ($i = 0; $i < $cnt; $i++) {
                $a = mysqli_fetch_row($result);
                echo "<tr><td>$a[0]</td><td><a href='view.php?id=$a[0]' class='edit' name='edit'>$a[2]</a></td><td>$a[1]</td><td>$a[8]</td></tr>";
            }

            // 연결 닫기
            mysqli_close($conn);
            ?>
        </table>
    </div>
</body>

</html>