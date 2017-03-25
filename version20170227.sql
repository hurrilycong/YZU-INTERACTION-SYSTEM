/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  zhangxile
 * Created: 2017-2-27
 */

# Host 127.0.0.1
# Database:teacher_student

# 2017年2月26日
# 开始编写


# 管理员信息
DROP TABLE IF EXISTS `admin_information`;

CREATE TABLE `admin_information`(
    'user_number' int(12) NOT NULL COMMENT '用户ID',
    ''
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# 平时作业成绩

DROP TABLE IF EXISTS `student_course_score`

CREATE TABLE `student_work_score`(
    `student_number` int(11) NOT NULL,
    `course_number`
)