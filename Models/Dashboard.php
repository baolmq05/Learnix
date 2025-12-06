<?php
require_once 'Database.php';
class Dashboard
{
    private $_conn;
    private $_table = 'users';
    private $_courseTable = 'courses';
    private $_enrollCourseTable = 'enroll_courses';
    public function __construct()
    {
        $database = new Database();
        $this->_conn = $database->getConnect();
    }

    // lấy số học viên theo năm
    public function getStudentInYear(int $role = 1, ?int $year = null)
    {
        try {
        if ($year === null) {
            $year = date('Y');
        }
        $sql = "SELECT DATE_FORMAT(created_at, '%m') as month, COUNT(*) AS Total_students
                FROM {$this->_table} 
                WHERE role = :role AND YEAR(created_at) = :year
                GROUP BY month 
                ORDER BY month"; // sắp xếp tăng dần
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['role' => $role, 'year' => $year]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy số người dùng theo vai trò
    public function getUser(int $role)
    {
        try {
        $sql = "SELECT COUNT(*) as total FROM {$this->_table} WHERE role = :role";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['role' => $role]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy số khóa học và trạng thái kháo học
    public function getTotalCourse($status)
    {
        try{
        if ($status == "") {
            $sql = "SELECT COUNT(*) as total FROM {$this->_courseTable}";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute();
        } else {
            $sql = "SELECT COUNT(*) as total FROM {$this->_courseTable} WHERE status = :status";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['status' => $status]);
        }

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'] ?? 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy số học viên mới trong tuần
    public function getNewStudentsInWeek()
    {
        try {
        $monday = new Datetime('monday this week');
        $monday->setTime(0, 0, 0);

        $nextMonday = new Datetime('monday next week');
        $nextMonday->setTime(0, 0, 0);

        $sql = "SELECT COUNT(*) as Total 
        FROM {$this->_table}
        WHERE created_at >= :start 
        AND created_at < :end
        AND role = :role";

        $stmt = $this->_conn->prepare($sql);
        $stmt->execute([
            'start' => $monday->format('Y-m-d H:i:s'),
            'end' => $nextMonday->format('Y-m-d H:i:s'),
            'role' => 1
        ]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['Total'] ?? 0;
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }

    }
    // lấy số hv đã hoàn thành 100%
    public function countCompletedCourses()
    {
        try {
        $sql = "SELECT COUNT(user_id) as total FROM {$this->_enrollCourseTable} WHERE status = :status";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['status' => 1]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($result['total'] ?? 0);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy tổng hv đã tham gia
    public function countTotalParticipants()
    {
        try {
        $sql = "SELECT COUNT(user_id) as total FROM {$this->_enrollCourseTable}";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int) ($result['total'] ?? 0);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // tính ra tỉ lệ %
    public function getCompletionRate()
    {
        try {
        $completed = $this->countCompletedCourses();
        $total = $this->countTotalParticipants();

        if ($total == 0)
            return 0; // tránh chia 0
        return round(($completed / $total) * 100, 2);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // lấy top 10 khóa học
    public function getTop10EnrollCourses()
    {
        try {
        $sql = "SELECT t1.course_id, t2.course_name, COUNT(t1.course_id) as total FROM {$this->_enrollCourseTable} t1 INNER JOIN {$this->_courseTable} t2 ON t1.course_id = t2.id
        GROUP BY t1.course_id,t2.course_name 
        ORDER BY total DESC 
        LIMIT 10";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // Client dashboard teacher////////////////////////////////////////////////////

    // Tổng số khóa học của 1 giảng viên
    public function getTotalCoursesByTeacher($status,$teacherId){
        try{
            $sql = "SELECT COUNT(*) as total 
            FROM $this->_courseTable 
            WHERE teacher_id = :teacher_id AND status = :status";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['teacher_id' => $teacherId, 'status' => $status]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // tổng số học viên đã đăng ký các khóa học của giảng viên
    public function getTotalStudentByTeacher($teacherId){
       try{
         $sql = "SELECT COUNT(DISTINCT e.user_id) as total
        FROM $this->_enrollCourseTable e
        INNER JOIN $this->_courseTable c ON e.course_id = c.id
        WHERE c.teacher_id = :teacher_id";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
       }catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // Số khóa học mới trong 30 ngày
    public function getTotalNewCoursesIn30Days($teacherId , $status){
        try{
            $sql = "SELECT COUNT(*) as total
            FROM $this->_courseTable
            WHERE teacher_id = :teacher_id AND status = :status
            AND created_at >=DATE_SUB(NOW(), INTERVAL 30 DAY)";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['teacher_id' => $teacherId, 'status' => $status]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // số học viên mới trong 30 ngày
     public function getTotalNewStudentIn30Days($teacherId){
       try{
         $sql = "SELECT COUNT(DISTINCT e.user_id) as total 
        FROM $this->_enrollCourseTable e
        INNER JOIN $this->_courseTable c ON e.course_id = c.id
        WHERE c.teacher_id = :teacher_id
        AND e.created_at >=DATE_SUB(NOW(), INTERVAL 30 DAY)";
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['teacher_id' => $teacherId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
       }catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // Tổng doanh thu từ các khóa học của giảng viên
    public function getTotalRevenueByTeacher($teacherId){
        try{
            $sql = "SELECT SUM(e.price * 0.9) as total_revenue
            FROM $this->_enrollCourseTable e
            INNER JOIN $this->_courseTable c ON e.course_id = c.id
            WHERE c.teacher_id = :teacher_id";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['teacher_id' => $teacherId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }


    
    // Tổng doanh thu từ các khóa học của giảng viên trong 30 ngày
    public function getTotalRevenueByTeacherIn30Days($teacherId){
        try{
            $sql = "SELECT SUM(e.price * 0.9) as total_revenue
            FROM $this->_enrollCourseTable e
            INNER JOIN $this->_courseTable c ON e.course_id = c.id
            WHERE c.teacher_id = :teacher_id 
            AND e.created_at >=DATE_SUB(NOW(), INTERVAL 30 DAY)";
            $stmt = $this->_conn->prepare($sql);
            $stmt->execute(['teacher_id' => $teacherId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }

    // chart doanh thu theo tháng trong năm nay
       public function getRevenueInYear($teacherId, ?int $year = null)
    {
        try {
        if ($year === null) {
            $year = date('Y');
        }
        $sql = "SELECT DATE_FORMAT(e.created_at, '%m') as month, SUM(e.price*0.9) AS Total_revenue
                FROM $this->_enrollCourseTable e
                INNER JOIN $this->_courseTable c ON e.course_id = c.id
                WHERE c.teacher_id = :teacher_id 
                AND YEAR(e.created_at) = :year
                GROUP BY month 
                ORDER BY month"; // sắp xếp tăng dần
        $stmt = $this->_conn->prepare($sql);
        $stmt->execute(['year' => $year, 'teacher_id' => $teacherId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            $log_mess = '[' . date('Y-m-d H:i:s') . ']' . $e->getMessage() . PHP_EOL;
            error_log($log_mess, 3, "./Logs/Dashboard.log");
        }
    }
}
?>