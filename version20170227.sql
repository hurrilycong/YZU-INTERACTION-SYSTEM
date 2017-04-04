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
    `user_number` int(12) NOT NULL COMMENT '用户ID',
    ``
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


# 每日签到

# 警告：外键无法创建

DROP TABLE IF EXISTS `sign_up_everyday`;

CREATE TABLE `sign_up_everyday`(    
    `student_number` int(12) NOT NULL COMMENT '学号',
    `course_id` int(12) NOT NULL COMMENT '课程号',
    `is_signed_up` int DEFAULT 0 COMMENT '是否签到',
    `sign_date` int(11) DEFAULT NULL COMMENT '签到时间',
    primary key(`student_number`,`course_id`),
    CONSTRAINT `fk_sign_stu_info` FOREIGN KEY(`student_number`) REFERENCES `student_information`(`student_number`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_sign_tea_cour` FOREIGN KEY(`course_id`) REFERENCES `teacher_course`(`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=gbk;

LOCK TABLES `sign_up_everyday` WRITE;

UNLOCK TABLES;

# 笔记功能

DROP TABLE IF EXISTS `note`;

CREATE TABLE `note`(
    `note_id` int(12) NOT NULL AUTO_INCREMENT COMMENT '笔记ID',
    `note_title` varchar(255) NOT NULL COMMENT '笔记题目',
    `note_content` text NOT NULL COMMENT '笔记内容',
    `note_date` int(11) NOT NULL COMMENT '上传时间',
    `student_number` int(12) NOT NULL COMMENT '学号',
    primary key(`note_id`),
    CONSTRAINT `fk_note_stu_num` FOREIGN KEY(`student_number`) REFERENCES `student_information`(`student_number`) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `note` WRITE;

UNLOCK TABLES;

# 笔记文件

DROP TABLE IF EXISTS `note_file`;

CREATE TABLE `note_file`(
    `file_id` int(12) NOT NULL AUTO_INCREMENT COMMENT '笔记文件ID',
    `note_id` int(12) NOT NULL COMMENT '笔记ID',
    `file_name` varchar(255) NOT NULL,
    `file_extension` varchar(255) NOT NULL,
    `file_upload_time` int(11) NOT NULL,
    `file_hash` varchar(255) NOT NULL,
    `is_share` int NOT NULL DEFAULT 0 COMMENT '是否公开',
    primary key(`file_id`),
    CONSTRAINT `fk_note_file_note` FOREIGN KEY(`note_id`) REFERENCES `note`(`note_id`) ON UPDATE CASCADE ON DELETE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `note_file` WRITE;

UNLOCK TABLES;
